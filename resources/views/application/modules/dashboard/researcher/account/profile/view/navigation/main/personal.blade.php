{{-- Check Employee Profile --}}
@if(isset($data['employee']['profile']))

<style>
.label.label-info {
    background-color: #ee5b5b !important; /* Adjust this color as needed */
    color: #fff !important; /* Ensure text is visible */
    padding: 4px 8px; /* Add top/bottom and left/right padding */
    border-radius: 4px; /* Optional: Keep the border radius */
}

.bootstrap-tagsinput .tag {
    margin-right: 0 !important; /* Removes the space between tags */
}

.tt-menu {
    display: block; /* Always show the menu */
}

.tt-suggestion {
    padding: 8px; /* Add padding for better click targets */
    cursor: pointer; /* Indicate it's clickable */
}

.tt-suggestion:hover {
    background-color: #f0f0f0; /* Highlight on hover */
}
</style>

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
                    <div class="form-group">
                      <label for="salutation_id">Salutation</label>
                      <select class="form-control select2" id="salutation_id" name="salutation_id[]" multiple>
                        <option value="">--Please Select--</option>
                        {{-- Check if Country exist --}}
                        @if(count($data['general']['salutation']) > 0)

                        @php
                          // Explode Country from the main data (comma-separated string)
                          $selected_salutation = explode(',',$data['employee']['salutation_id']);
                        @endphp

                          {{-- Iterate through available Country --}}
                          @foreach($data['general']['salutation'] as $key=>$value)
                            <option value="{{ $value->salutation_id }}"
                              {{-- Check if this value was previously selected --}}
                              {{ in_array($value->salutation_id,$selected_salutation) ? 'selected' : '' }}>
                              {{ $value->name }}
                            </option>
                          @endforeach

                        @endif
                      </select>

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

      <!-- form control -->
      <div class="row text-end pt-3">

        <!-- control -->
        <div class="col-md-12">

          <input type="hidden" name="tab_category" value="personal">
          <input type="hidden" name="form_token" value="{{ $form_token['update'] }}">
          <button type="submit" class="btn btn-danger text-white"><i class="mdi mdi-plus"></i>Update</button>

        </div>
        <!-- end control -->

      </div>
      <!-- end form control -->


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

  const $input = $('.tt-input');
 const $dropdown = $('.tt-menu');

 $input.on('focus', function() {
     $dropdown.show();
 }).on('blur', function() {
     $dropdown.hide();
 });

 $dropdown.on('click', '.tt-suggestion', function() {
     $input.val($(this).text());
     $dropdown.hide();
 });

  /**************************************************************************************
    Document On Key Up
  **************************************************************************************/
  $(document).on('keyup keypress','form input[type="text"]',function(e){
    if(e.keyCode == 13) {
      e.preventDefault();
      return false;
    }
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
