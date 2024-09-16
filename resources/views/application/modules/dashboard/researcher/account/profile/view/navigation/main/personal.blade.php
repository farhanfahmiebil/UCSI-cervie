{{-- Check Employee Profile --}}
@if(isset($data['employee']['profile']))

  <!-- tab pane -->
  <div class="tab-pane fade {{ ((request()->tab_category == 'personal')?'show active':'') }}" id="personal" role="tabpanel">

    <!-- form -->
    <form action="{{ route($hyperlink['page']['update'],['tab'=>'tab','tab_category'=>'personal']) }}" method="POST">
      {{csrf_field()}}

      <!-- card -->
      <div class="card">

        <!-- card header -->
        <div class="card-header">
          <h3>General Information</h3>
        </div>
        <!-- end card header -->

        <!-- card body -->
        <div class="card-body">

          <!-- row -->
          <div class="row gx-3">

            <!-- col -->
            <div class="col-sm-12 col-12">

              <!-- row -->
              <div class="row gx-3">

                <!-- col -->
                <div class="col-6">

                  <!-- salutation -->
                  <div class="mb-3">
                    <label for="salutation_id" class="form-label">Salutation</label>
                    <input type="text" class="form-control" id="salutation_id" name="salutation_id" placeholder="" value="" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end salutation -->

                  <!-- first name -->
                  <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $data['employee']['profile']->first_name }}" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end first name -->

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col-6">

                  <!-- fullname -->
                  <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control"  id="full_name" name="full_name" placeholder="Full Name" value="{{ $data['employee']['profile']->full_name }}" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end fullname -->

                  <!-- middle name -->
                  <div class="mb-3">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control"  id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ $data['employee']['profile']->middle_name }}" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end middle name -->

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col-6">

                  <!-- last name -->
                  <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control"  id="last_name" name="last_name" placeholder="Last Name" value="{{ $data['employee']['profile']->last_name }}" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end last name -->

                  <!-- birthday -->
                  <div class="mb-3">
                    <label for="birthDay" class="form-label">Birthday</label>
                    <div class="input-group">
                      <input type="date" class="form-control datepicker-opens-left" id="dob" name="dob" placeholder="DD/MM/YYYY" value="{{ $data['employee']['profile']->dob }}" {{ $data['input']['status'] }}/>
                      <span class="input-group-text">
                        <i class="bi bi-calendar4"></i>
                      </span>
                    </div>
                  </div>
                  <!-- end birthday -->

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col-6">

                  <!-- nickname -->
                  <div class="mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" class="form-control" id="nickname" name="nickname" placeholder="nickname" value="{{ $data['employee']['profile']->nickname }}" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end nickname -->

                  <!-- age -->
                  <div class="mb-3">
                    <label for="nickname" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="Age" placeholder="age" value="" {{ $data['input']['status'] }}>
                  </div>
                  <!-- end age -->

                </div>
                <!-- end col -->

              </div>
              <!-- end row -->

            </div>
            <!-- end col -->

          </div>
          <!-- end row -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

      <!-- control -->
      <div class="d-flex gap-2 justify-content-end">
        <input type="hidden" name="tab_category" value="personal">

        {{-- Check Authorization User Status Stop Submit --}}
        @if(!in_array(Auth::user()->employee->status->name,array('pending')))
          <button type="submit" class="btn btn-primary">Save</button>
        @endif
        {{-- End Check Authorization User Status Stop Submit --}}

      </div>
      <!-- end control -->

    </form>
    <!-- end form -->

  </div>
  <!-- end tab pane -->

{{-- Tags Input --}}
@include($hyperlink['navigation']['layout']['dashboard']['employee']['plugin']['tags_input'])

<script type="text/javascript">

/**************************************************************************************
  Document On Load
**************************************************************************************/
$(document).ready(function($){

  /**************************************************************************************
    Document On Key Up
  **************************************************************************************/
  $(document).on('keyup keypress','form input[type="text"]',function(e){
    if(e.keyCode == 13) {
      e.preventDefault();
      return false;
    }
  });

  /*  Set Salutation Tags Input
  **************************************************************************************/
  var salutation = {!! ($data['general']['salutation']) !!};

  var salutation_source = new Bloodhound({
   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
   queryTokenizer: Bloodhound.tokenizers.whitespace,
   local:salutation
  });

  //Disabled
  $('#salutation_id').prop('readonly',false);
// console.log(32);
  salutation_source.initialize();

  $('#salutation_id').tagsinput({
    'maxChars':50,
    'maxTags':10,
    'trimValue':true,
    'cancelConfirmKeysOnEmpty':true,
    'itemValue':'salutation_id',
    'itemText':'name',
    'typeaheadjs': {
      'name':'salutation',
      'displayKey':'name',
      'source':salutation_source.ttAdapter()
    }
  });

  // $("#salutation_id").prop('disabled', true);

  salutation_exist = '{{ $data['employee']['salutation_id'] }}';
  salutation_split = salutation_exist.split(',');
  console.log(salutation_exist);

  $.each(salutation,function(index,value){

    $.each(salutation_split,function(i,v){

      if(v == value.salutation_id){
        $('#salutation_id').tagsinput('add', {'salutation_id': value.salutation_id,'name': value.name });
      }

    });
    //console.log( index + ": " + value.salutation_id );
    // $('#salutation_id').tagsinput('add', { "salutation_id": 'MR' , "name": "Mister"   });
  });

  /*  Set Age on Date of Birth
  **************************************************************************************/
  @if(isset($data['employee']['profile']) && !empty($data['employee']['profile']->dob))

     getAge({!! json_encode($data['employee']['profile']->dob) !!})
    // console.log("Age:", age);
  @endif

  /*  DOB on Change
  **************************************************************************************/
  $('#dob').on('change',function(){

    getAge($(this).val());

  });

  /*  Set Age On DOB
  **************************************************************************************/
  function getAge(data){

    var dob = data;
    var date_dob = new Date(dob);
    var date_today = new Date();

    // Calculate the age
    var age = date_today.getFullYear() - date_dob.getFullYear();

    //Set Age
    $('#age').val(age);

  }

});

</script>

@endif
{{-- End Check Employee Profile --}}
