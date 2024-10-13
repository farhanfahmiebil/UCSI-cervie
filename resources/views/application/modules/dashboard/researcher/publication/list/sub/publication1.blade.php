<!-- col -->
<div class="col-sm-12 grid-margin d-flex stretch-card">

  <!-- card -->
  <div class="card">

    <!-- card body -->
    <div class="card-body">

      <!-- header -->
      <div class="d-flex align-items-center justify-content-between">

        <!-- title -->
				<h4 class="card-title mb-2">Publication</h4>
        <!-- end title -->

        <!-- dropdown -->
				<div class="dropdown">
          <a href="{{ route($hyperlink['page']['new']) }}" class="btn btn-light px-1">
            <i class="mdi mdi-plus text-dark"></i>
            New Publication
          </a>
				</div>
        <!-- end dropdown -->

			</div>
      <!-- end header -->

      {{-- Check Publication Type Exist --}}
      @if(count($data['general']['publication']['type']) > 0)

        @php

          //Set Category Status
          $check['category'] = false;

        @endphp


        {{-- Get Publication Type Data --}}
        @foreach($data['general']['publication']['type'] as $key=>$value)

          {{-- Check Researcher Publication Exist --}}
          @if(count($data['main']['cervie']['researcher']['publication'][$value->publication_type_id]) > 0)

            @php

              //Set Category Status
              $check['category'] = true;

            @endphp

            {{-- Get Researcher Publication Data --}}
            @foreach($data['main']['cervie']['researcher']['publication'][$value->publication_type_id] as $k=>$v)

              {{-- Check General Publication Type Matched With Researcher Publication Type --}}
              @if($value->publication_type_id == $v->publication_type_id)

                <!-- header sub title -->
                <div class="row pt-5 pb-1">

                  <!-- title -->
                  <h4 class="card-title mb-2">{{ $value->name }}</h4>
                  <!-- end title -->

                </div>
                <!-- end header sub title -->

                <hr>

                <!-- table responsive -->
                <div class="table-responsive">

                  <!-- table -->
                  <table class="table table-bordered">

                    <!-- thead -->
                    <thead>

                      @php

                        //Set Checkbox Status
                        $checkbox['status'] = false;

                      @endphp

                      {{-- Check Table Column Exist --}}
                      @if(isset($data['table']['column']['cervie']['researcher']['publication'][$value->publication_type_id]) && count($data['table']['column']['cervie']['researcher']['publication'][$value->publication_type_id]) >= 1)

                        {{-- Get Table Column Data --}}
                        @foreach($data['table']['column']['cervie']['researcher']['publication'][$value->publication_type_id] as $k=>$v)

                            {{-- Check if the column is of category 'checkbox' --}}
                            @if(isset($v['category']) && $v['category'] == 'checkbox')

                              @php

                                //Set Checkbox Status
                                $checkbox['status'] = true;

                              @endphp

                              <td>{!! $v['checkbox'] !!}</td>

                            @else

                              {{-- Check if 'class' is set and apply it --}}
                              @if(isset($v['class']) && !empty($v['class']))
                                <td class="{{ $v['class'] }}">
                              @else
                                <td>
                              @endif

                                {{-- Output the icon and name --}}
                                {!! isset($v['icon']) ? $v['icon'] : '' !!}
                                {{ isset($v['name']) ? $v['name'] : '' }}

                              </td>

                            @endif
                            {{-- End Check if the column is of category 'checkbox' --}}

                        @endforeach
                        {{-- End Get Table Column Data --}}

                      @else
                        <th>Column Not Defined</th>
                      @endif
                      {{-- End Check Table Column Data Exist --}}

                    </thead>
                    <!-- end thead -->

                    <!-- tbody -->
                    <tbody>

                      {{-- Check Researcher Publication Exist --}}
                      @if(count($data['main']['cervie']['researcher']['publication'][$value->publication_type_id]) > 0)

                        {{-- Get Researcher Publication Data --}}
                        @foreach($data['main']['cervie']['researcher']['publication'][$value->publication_type_id] as $k=>$v)

                          @if($value->publication_type_id == $v->publication_type_id)

                            @php
                              $counter = 0
                            @endphp
                            <tr id="{{ $v->publication_id }}">

                              {{-- Check if Checkbox Status True --}}
                              @if($checkbox['status'])
                                <td>
                                  <div class="form-check-label">
                                    <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $v->publication_id }}"/>
              										</div>
                                </td>
                              @endif
                              {{-- End Check if Checkbox Status True --}}

                              <td>{{ ($k+1) }}</td>
                              <td>{{ $v->title }}</td>
                              <td>{{ $v->name }}</td>
                              <td>
                                  {!! (($v->page_no)?'Page:'.$v->page_no:'') !!}
                                  {!! (($v->chapter_no)?'<br>Chapter No:'.$v->chapter_no:'') !!}
                              </td>
                              <td>{{ $v->sustainable_development_goal }}</td>
                              <td><span class="badge bg-{{ (($v->need_verification)?'warning':'success') }}">{{ (($v->need_verification)?'Pending':'Verified') }}</span></td>
                              <td>

                                <a href="{{ route($hyperlink['page']['view'],['id'=>$v->publication_id]) }}" class="btn btn-sm btn-secondary">
                                  <i class="mdi mdi-pencil"></i>
                                </a>

                                <a data-href="{{ route($hyperlink['page']['delete']['main']) }}" class="btn-delete-publication btn-sm btn btn-danger">
                                  <i class="mdi mdi-trash-can text-white"></i>
                                </a>

                              </td>
                            </tr>
                          @endif

                        @endforeach
                        {{-- End Get Researcher Publication Data --}}

                      @else

                        <tr class="text-center">
                          <td colspan="{{ count($data['table']['column']['cervie']['researcher']['publication'][$v->publication_type_id]) }}">No Data</td>
                        </tr>

                      @endif
                      {{-- End Check Researcher Publication Exist --}}

                    </tbody>
                    <!-- end tbody -->

                  </table>
                  <!-- end table -->

                </div>
                <!-- end table responsive -->

              @endif
              {{-- End Check General Publication Type Matched With Researcher Publication Type --}}

            @endforeach
            {{-- End Get Researcher Publication Data --}}

          @endif
          {{-- End Check Researcher Publication Exist --}}

        @endforeach
        {{-- End Get Publication Type Data --}}

        @if(!$check['category'])

        <!-- header sub title -->
        <div class="row pt-5 text-center">

          <!-- title -->
          <h4 class="card-title mb-2">There is No Record Added, You may Add by Clicking New Publication Above</h4>
          <!-- end title -->

        </div>
        <!-- end header sub title -->

        @endif

      @endif
      {{-- End Check Publication Type Exist --}}


    </div>
    <!-- end card body -->

  </div>
  <!-- end card -->

</div>
<!-- end col -->

<script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function($){

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-publication"]').on('click',function(event){

      //Set Parent Row
      var parent_row = $(this).closest('tr').attr('id');

      //Set Form Token
      var form_token = '{{ $form_token["delete"] }}';

      //Set Hyperlink
      var hyperlink  = $(this).data('href');
          hyperlink += '?id='+parent_row;
          hyperlink += '&form_token='+form_token;

      //Set Alert
      Swal.fire({
        title:'Are you sure you want to Delete? Once deleted, it cannot be recovered.',
        showDenyButton:true,
        confirmButtonText:'Yes',
        denyButtonText:'Cancel',
        icon:'error'
      }).then((result) => {

        //If Confirmed
        if(result.isConfirmed){

          //Redirect
          window.location.href = hyperlink;

        }else

        //If Denied
        if(result.isDenied){

          //Alert Message
          Swal.fire('Cancel','','');
        }

      });
    });

  });
</script>
