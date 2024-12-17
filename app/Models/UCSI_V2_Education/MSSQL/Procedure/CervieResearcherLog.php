<?php

namespace app\Models\UCSI_V2_Education\MSSQL\Procedure;

//Get Database
use DB;

//Get Model
use Illuminate\Database\Eloquent\Model;

use Illuminate\Pagination\LengthAwarePaginator;

//Get Model Setting
use App\Models\UCSI_V2_General\MSSQL\View\Setting;

//Get Model Log
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherEvidence AS CervieResearcherEvidenceProcedure;
use App\Models\UCSI_V2_Education\MSSQL\Procedure\CervieResearcherTeamMember AS CervieResearcherTeamMemberProcedure;

//Get Class
class CervieResearcherLog extends Model{

  /**
   * The database connection that should be used by the model.
   *
   * @var string
   */
  protected $connection = 'sqlsrv_ucsi_v2_education';

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = '';

  /**************************************************************************************
    Get Pagination
  **************************************************************************************/
  public function getPagination($data = null){

    $model['setting'] = new Setting();

    if(isset($data['manual']) && $data['manual'] != false){
      return $this->default['pagination']['size'];
    }

    return $model['setting']->getPagination();

  }


  /**************************************************************************************
    Create
  **************************************************************************************/
  public function createRecord($data){

    //Set Table
    $this->table = 'create_cervie_researcher_log';

    //Set Query
    $this->query = 'DECLARE @id INT;
              EXEC '.$this->table.' ?,?,?,?,?,?,?, @id OUTPUT;
              SELECT @id AS id;';

    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['table_name'],
        $data['column']['event'],
        $data['column']['auditable_id'],
        $data['column']['old_value'],
        $data['column']['new_value'],
        $data['column']['created_by']
      ]
    );

    //Check Result Success
    if(!empty($result)){

      //Return Data
      return (object)[
        'status'=>true,
        'last_insert_id'=>$result[0]->id ?? 0
      ];

    }

    //If Result Failed
    return (object)[
      'status'=>false
    ];

  }

  /**************************************************************************************
      Read
  **************************************************************************************/
  public function readRecord($data)
  {
      // Check for the 'main' category first
      if ($data['column']['category'] == 'main') {

          // Set Table for main category
          $table = 'read_cervie_researcher_log';
// dd($data);
          // Set Query for main category
          $this->query = 'EXEC '.$table.' ?,?,?;';

          // Get Result for main category
          $result = DB::connection($this->connection)->select($this->query, [
              $data['column']['employee_id'],
              $data['column']['table_name'],
              $data['column']['auditable_id']
          ]);

          // Decode Values (Just for the sake of this example)
          $old_value = json_decode($result[0]->old_value);
          $new_value = json_decode($result[0]->new_value);

          // Convert to Collections
          $collection_old_value = collect($old_value);
          $collection_new_value = collect($new_value);

          // Compare the collections and find differences using filter
          $differences = $collection_old_value->filter(function ($oldValue, $key) use ($collection_new_value) {
              // Check if the key exists in the new collection or if the value is different
              return !$collection_new_value->has($key) || $collection_new_value->get($key) !== $oldValue;
          });

          // Convert the differences collection to an array
          $differencesArray = $differences->toArray();

          // Convert the array to an object
          $result = (object) $differencesArray;

          // dd($collection_old_value, $collection_new_value);

      } else if (in_array($data['column']['category'], ['evidence', 'team_member'])) {

          // Set Table for evidence and team_member categories (common table name)
          $table = 'read_cervie_researcher_log_evidence';

          // Set Query for evidence and team_member
          $this->query = 'EXEC '.$table.' ?,?,?,?,?;';

          // Get Result for evidence and team_member
          $collection = DB::connection($this->connection)->select($this->query, [
              $data['column']['employee_id'],
              $data['column']['table_name'],
              $data['column']['main_table_name'],
              $data['column']['auditable_id'],
              $data['column']['event']
          ]);

          $log = []; // Initialize the result array before the loop

          foreach ($collection as $value) {
              // Get the first result
              $log[] = json_decode($value->new_value); // You can apply any condition here if needed
          }

          // Switch case for handling 'evidence' and 'team_member' categories
          switch ($data['column']['category']) {
              case 'evidence':
                  // Set Model for 'evidence'
                  $model['cervie']['researcher']['evidence'] = new CervieResearcherEvidenceProcedure();

                  // Get Evidence Data
                  $evidence = $model['cervie']['researcher']['evidence']->readRecordByResearcherTable([
                      'column' => [
                          'employee_id' => $data['column']['employee_id'],
                          'table_name' => $data['column']['main_table_name'],
                          'table_id' => $data['column']['auditable_id']
                      ]
                  ]);

                  $intersectField = 'evidence_id'; // Specific field for 'evidence'

                  break;

              case 'team_member':
                  // Set Model for 'team_member'
                  $model['cervie']['researcher']['team']['member'] = new CervieResearcherTeamMemberProcedure();

                  // Get Team Member Data
                  $evidence = $model['cervie']['researcher']['team']['member']->readRecordByResearcherTable([
                      'column' => [
                          'employee_id' => $data['column']['employee_id'],
                          'table_name' => $data['column']['main_table_name'],
                          'table_id' => $data['column']['auditable_id']
                      ]
                  ]);

                  $intersectField = 'team_member_id'; // Specific field for 'team_member'
                  break;

              default:
                  $result = null;
                  return $result;
          }

          // Convert both $log and $evidence to collections
          $array_log = collect($log);  // Collection of stdClass objects
          $array_evidence = collect($evidence);  // Another collection of stdClass objects

          // Ensure that the intersected field is the same type in both collections
          $logIds = $array_evidence->pluck($intersectField)
              ->map(fn($item) => (string) $item)  // Convert to string (or (int) if using integers)
              ->unique();

          $evidenceIds = $array_log->pluck($intersectField)
              ->map(fn($item) => (string) $item)  // Convert to string
              ->unique();

          // Find the IDs that are in both $log and $evidence (i.e., the intersection)
          $intersectIds = $logIds->intersect($evidenceIds);

          // Now filter the original $array_evidence collection to return the full objects where the ID is in $intersectIds
          $result = $array_evidence->filter(function ($item) use ($intersectIds, $intersectField) {
              // Check if the current item's ID exists in the intersected IDs collection
              return $intersectIds->contains((string) $item->{$intersectField});  // Ensure matching types
          });

          // Now filter $result to include only the items where 'need_verification' is "1" (string)
          $result = $result->filter(function ($item) {
              return isset($item->need_verification) && $item->need_verification === "1";
          });
// dd($array_log,$array_evidence,$result);

// dd($result->pluck('need_verification')->contains(true));
          // Get the first result if necessary
          // $result = (($result) ? json_decode($result[0]->old_value) : null);

          // Set the result
          $result = $result;

      } else {
          // If category is not 'main', 'evidence', or 'team_member', return null
          $result = null;
      }

      // Return Result
      return $result;
  }


  /**************************************************************************************
    Update
  **************************************************************************************/
  public function updateRecord($data){

    //Set Table
    $this->table = 'read_cervie_researcher_evidence';

    //Set Query
    $this->query = 'EXEC '.$this->table.' ?,?;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['evidence_id'],
        $data['column']['employee_id'],
      ]
    );

    //Get the first result
    $result = $result[0] ?? null;

    // dd($result);

    //Return Result
    return $result;


  }

  /**************************************************************************************
    Read Record Verification
  **************************************************************************************/
  public function readRecordVerification($data){

    //Set Table
    $this->table = 'read_cervie_researcher_table_verification';

    //Set Query
    $this->query = 'EXEC '.$this->table.' ?,?;';
    //Get Result
    $result = DB::connection($this->connection)->select($this->query,[
        $data['column']['employee_id'],
        $data['column']['need_verification']
      ]
    );


    // Paginate manually if it's an array
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = $this->getPagination();

    // Create a paginator instance
    $paginatedResult = new LengthAwarePaginator(
        array_slice($result, ($currentPage - 1) * $perPage, $perPage), // Slice the array
        count($result), // Total count of items
        $perPage, // Items per page
        $currentPage, // Current page number
        ['path' => LengthAwarePaginator::resolveCurrentPath()] // Ensure the paginator URL is correctly set
    );

    $paginatedResult->appends(request()->query());

    //Return Result
    return $paginatedResult;


  }



}
