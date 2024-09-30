@extends(Config::get('routing.application.modules.dashboard.researcher.layout').'.structure.index')

@section('main-content')

<!-- card -->
<div class="card">
  <!-- card body -->
  <div class="card-body">
      <!-- card title -->
      <h4 class="card-title">Edit Linkage</h4>
      <hr>

      <!-- error -->
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <!-- end error -->

      <!-- form -->
      <form class="forms-sample" method="POST" action="{{route($hyperlink['page']['update'],['employee_id' => request()->route('employee_id')])}}" enctype="multipart/form-data">
        {{csrf_field()}}

          <!-- row start -->
          <div class="row">

            <!-- col-md-12 start -->
            <div class="col-md-12">

              <!-- form-group hide start -->
              <div class="form-group hide">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Synergy in Action: The Apple and IBM Collaboration" required>
              </div>
              <!-- form-group hide end -->

            </div>
            <!-- col-md-12 end -->

            <!-- col-md-6 start -->
            <div class="col-md-6">

              <!-- form-group hide start -->
              <div class="form-group hide">
                  <label for="organization">Organization</label>
                  <input type="text" class="form-control" name="organization" id="organization" placeholder="Apple Inc. and IBM" required>
              </div>
              <!-- form-group hide end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="agreement_level_id">Agreement Level</label>
                  <select id="agreement_level_id" name="agreement_level_id" class="select2 form-select form-control-sm js-example-basic-single form-control" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                      <option value="">-Please Select Agreement Level-</option>
                      @if(count($data['general']['agreement']['level']) >= 1)
                        @foreach($data['general']['agreement']['level'] as $key=>$value)
                          <option value="{{$value->agreement_level_id}}">{{$value->name}}</option>
                        @endforeach
                      @endif
                  </select>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="qualification_name">Amount</label>
                  <input type="number" class="form-control" name="amount" id="amount" placeholder="" required>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="date_start">Date Start</label>
                  <input type="date" class="form-control" name="date_start" id="date_start" placeholder="DD/MM/YYYY" required>
              </div>
              <!-- form-group end -->

            </div>
            <!-- col-md-6 end -->

            <!-- col-md-6 start -->
            <div class="col-md-6">

              <!-- form-group start -->
              <div class="form-group">
                  <label for="linkage_category_id">Category</label>
                  <select id="linkage_category_id" name="linkage_category_id" class="select2 form-select form-control-sm js-example-basic-single form-control" data-select2-id="2" tabindex="-1" aria-hidden="true" required>
                      <option value="">-Please Select Category-</option>
                      @if(count($data['general']['linkage']['category']) >= 1)
                        @foreach($data['general']['linkage']['category'] as $key=>$value)
                          <option value="{{$value->linkage_category_id}}">{{$value->name . ' (' . $value->abbreviation . ')'}}</option>
                        @endforeach
                      @endif
                  </select>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="agreement_type_id">Agreement Type</label>
                  <select id="agreement_type_id" name="agreement_type_id" class="select2 form-select form-control-sm js-example-basic-single form-control" data-select2-id="3" tabindex="-1" aria-hidden="true" required>
                      <option value="">-Please Select Agreement Type-</option>
                      @if(count($data['general']['agreement']['type']) >= 1)
                        @foreach($data['general']['agreement']['type'] as $key=>$value)
                          <option value="{{$value->agreement_type_id}}">{{$value->name . ' (' . $value->abbreviation . ')'}}</option>
                        @endforeach
                      @endif
                  </select>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="country_id">Country</label>
                  <select id="country_id" name="country_id" class="select2 form-select form-control-sm js-example-basic-single form-control" data-select2-id="4" tabindex="-1" aria-hidden="true" required>
                      <option value="">-Please Select Country-</option>
                      @if(count($data['general']['country']) >= 1)
                        @foreach($data['general']['country'] as $key=>$value)
                          <option value="{{$value->country_id}}">{{$value->name}}</option>
                        @endforeach
                      @endif
                  </select>
              </div>
              <!-- form-group end -->

              <!-- form-group start -->
              <div class="form-group">
                  <label for="date_end">Date End</label>
                  <input type="date" class="form-control" name="date_end" id="date_end" placeholder="DD/MM/YYYY" required>
              </div>
              <!-- form-group end -->

            </div>
            <!-- col-md-6 end -->
          </div>
          <!-- row end -->

          <!-- Linkage Table -->
          <h4 class="card-title">Linkage Evidence</h4>
          <hr>

          <!-- table responsive -->
          <div class="table-responsive">

            <!-- table -->
            <table class="table table-hover">

              <!-- thead -->
              <thead>
                <tr>
                  <th>#</th>
                  <th>Organization</th>
                  <th>Project Title</th>
                  <th>Duration (Month (s))</th>
                </tr>
              </thead>
              <!-- end thead -->

              <!-- tbody -->
              <tbody>
                @if(count($data['main']) >= 1)
                  @foreach($data['main'] as $key=>$value)
                    <tr class="table_row_data" data-id="{{$value->linkage_id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$value->organization}}</td>
                      <td>{{$value->title}}</td>
                      <td>{{\Carbon\Carbon::parse($value->date_start)->diffInMonths(\Carbon\Carbon::parse($value->date_end))}}</td>
                      <td>
                        @if($access['editable'] && Auth::user())
                          <a href="{{route($hyperlink['page']['view'],['id' => $value->linkage_id, 'employee_id' => request()->route('employee_id')])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="mdi mdi-pencil"></i></a>
                          <i data-toggle="tooltip" data-placement="top" title="Delete" data-id="{{$value->linkage_id}}" class="delete mdi mdi-trash-can"></i>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                @else
                  <td class="text-center" colspan="7">No Data</td>
                @endif
              </tbody>
              <!-- end tbody -->

            </table>
            <!-- end table -->

          </div>
          <!-- end table responsive -->


          <table class="table table-bordered table-danger" id="linkageTable">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Description</th>
                      <th>File</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class="row-number">1</td>
                      <td class="col-md-7"><input type="text" class="form-control" name="description[]" placeholder="Enter Description" required></td>
                      <td class="col-md-5"><input type="file" class="form-control" name="file[]" placeholder="Upload file" required></td>
                      <td>
                        <button type="button" class="btn btn-danger remove-row"><i class="mdi mdi-trash-can"></i></button>
                      </td>
                  </tr>
              </tbody>
          </table>
          <button type="button" class="btn btn-danger mt-4" id="addRow">Add New Evidence</button>

          <!-- button group start -->
          <div class="text-center">
              <hr>
              <a href="{{route($hyperlink['page']['list'],['employee_id' => request()->route('employee_id')])}}" class="btn btn-light">Back</a>
              <button type="submit" class="btn btn-danger me-2">Submit</button>
          </div>
          <!-- button group end -->
      </form>
      <!-- form end -->
  </div>
  <!-- card body end -->
</div>
<!-- end card -->

<script>
$(document).ready(function() {
    let rowCount = 1; // Initialize row count

    // Clone the row
    $(document).on('click', '.clone-row', function() {
        var $row = $(this).closest('tr');
        var $clone = $row.clone();
        $clone.find('input').val(''); // Clear input fields in the cloned row
        $row.after($clone); // Insert the cloned row after the original
        updateRowNumbers(); // Update row numbers
    });

    // Remove the row
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        updateRowNumbers(); // Update row numbers after removal
    });

    // Add a new empty row
    $('#addRow').click(function() {
        rowCount++; // Increment row count
        var $newRow = `<tr>
            <td class="row-number">${rowCount}</td>
            <td><input type="text" class="form-control" name="description[]" placeholder="Enter Description" required></td>
            <td><input type="file" class="form-control" name="file[]" placeholder="Upload file" required></td>
            <td>
                <button type="button" class="btn btn-danger remove-row"><i class="mdi mdi-trash-can"></i></button>
            </td>
        </tr>`;
        $('#linkageTable tbody').append($newRow);
    });

    // Update row numbers
    function updateRowNumbers() {
        $('#linkageTable tbody tr').each(function(index) {
            $(this).find('.row-number').text(index + 1);
        });
    }
});
</script>

@endsection
