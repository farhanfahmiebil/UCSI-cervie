<!-- card -->
<div class="card">

  <!-- card header -->
  <div class="card-header">

    <!-- header -->
    <div class="d-flex align-items-center justify-content-between">

      <!-- title -->
      <h4 class="card-title mb-2">Publication</h4>
      <!-- end title -->

    </div>
    <!-- end header -->

  </div>
  <!-- end card header -->

  <!-- card header -->
  <div class="card-header row filter-info">

    <!-- your search -->
    <div class="card col-md-4">
      <div class="card-body">
        <div class="d-flex flex-row">
          <i class="bi bi-search pe-2"></i>
          <div class="ml-3">
            <h6>Your Search</h6>
            <p class="mt-2 text-muted card-text">{{ (request()->input('search')?request()->input('search'):'-') }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- end your search -->

    <!-- filter by -->
    <div class="card col-md-4">
      <div class="card-body">
        <div class="d-flex flex-row">
          <i class="bi bi bi-sliders pe-2"></i>
          <div class="ml-3">
            <h6>Filter By</h6>
            <p class="mt-2 text-muted card-text">

              {{-- Check Need Verification Status --}}
              @if(request()->has('need_verification'))

                Need Verification (Status) :
                <span class="badge bg-{{
                    (
                      (request()->input('need_verification') === '0')?'success':
                      (
                        (request()->input('need_verification') === '1')?'warning':'info'
                      )
                    ) }}">

                    {{ ((request()->input('need_verification'))?'Pending':'Verified') }}

                </span>

                <br>

              @endif
              {{-- End Check Need Verification Status --}}

            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end filter by -->

    <!-- sorted by -->
    <div class="card col-md-4">
      <div class="card-body">
        <div class="d-flex flex-row">
          <i class="bi bi-filter pe-2"></i>
          <div class="ml-3">
            <h6>Sorted By</h6>
            <p class="mt-2 text-muted card-text">
              {{
                ((empty(request()->input('sorting_display')))?'-':request()->input('sorting_display').' ('.ucfirst(request()->input('sorting')).')')
              }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end sorted by -->

    <!-- search box -->
    <div class="col-lg-12 search-box">

      <!-- card -->
      <div class="card">

        <!-- card body -->
        <div class="card-body">

          <!-- box header -->
          <div class="box-header">
            <h3 class="box-title">What Are You Looking For ?</h3>
          </div>
          <!-- box header -->

          <!-- box body -->
          <div class="box-body">

            <!-- form search -->
            <form id="form-checklist" action="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" method="GET">

              <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" placeholder="Search by Name"/>
                {!! ((!empty(request()->input('search')))?'<input type="hidden" name="status" value="'.request()->input('search').'"/>':'') !!}
                {!! ((!empty(request()->input('need_verification')))?'<input type="hidden" name="need_verification" value="'.request()->input('need_verification').'"/>':'') !!}
                {!! ((!empty(request()->input('sorting_display')))?'<input type="hidden" name="status" value="'.request()->input('sorting_display').'"/>':'') !!}
                {!! ((!empty(request()->input('sorting')))?'<input type="hidden" name="status" value="'.request()->input('sorting').'"/>':'') !!}
                <span class="input-group-btn bg-transparent">
                  <input type="hidden" name="form_token" value="{{ $form_token['search'] }}"/>
                  <button type="submit" class="btn btn-custom"/>
                    <i class="bi bi-search text-white"></i>
                  </button>
                </span>
              </div>

            </form>
            <!-- end form search -->

          </div>
          <!-- end box body -->

        </div>
        <!-- end card body -->

      </div>
      <!-- end card -->

    </div>
    <!-- end search box -->

  </div>
  <!-- end card header -->

  <!-- card header -->
  <div class="card-header">

    <!-- button new -->
    <a href="{{ route($hyperlink['page']['new'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Add">
      <i class="bi bi-plus-lg"></i>
    </a>
    <!-- end button new -->

    <!-- button search -->
    <a id="search-box" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Search">
			<i class="bi bi-search"></i>
		</a>
    <!-- button search -->

    <!-- button refresh -->
		<a href="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Refresh">
			<i class="bi bi-bootstrap-reboot"></i>
		</a>
    <!-- end button refresh -->

    <!-- button filter -->
    <span data-bs-toggle="modal" data-bs-target="#modal-filter">
      <button type="button" class="btn btn-icons btn-custom" data-toggle="tooltip" data-placement="top" title="Filter">
        <i class="bi bi-sliders"></i>
      </button>
    </span>
    <!-- end button filter -->

    <!-- button sort -->
    <div class="btn-group">
      <button type="button" class="btn btn-icons btn-custom dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-placement="top" title="Sort">
        <i class="bi bi-filter"></i>
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item sort-item" href="#" data-sort-id="name" data-sort="asc" data-sort-display="Name">Name [Asc]</a></li>
        <li><a class="dropdown-item sort-item" href="#" data-sort-id="name" data-sort="desc" data-sort-display="Name">Name [Desc]</a></li>
      </ul>
    </div>
    <!-- end button sort -->

    <!-- form sort -->
    <form id="form-sort" action="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" method="GET">
      <input type="hidden" name="form_token" value="{{ $form_token['sort'] }}"/>
      <input type="hidden" id="sorting_column" name="sorting_column" value=""/>
      <input type="hidden" id="sorting" name="sorting" value="{{ request()->input('sorting') }}"/>
      <input type="hidden" id="sorting_display" name="sorting_display" value="{{ request()->input('sorting_display') }}"/>
      {!! ((!empty(request()->input('search')))?'<input type="hidden" name="search" value="'.request()->input('search').'"/>':'') !!}
      {!! ((!empty(request()->input('need_verification')))?'<input type="hidden" name="need_verification" value="'.request()->input('need_verification').'"/>':'') !!}
    </form>
    <!-- end form sort -->

    <!-- control list -->

    <!-- total count -->
    <div class="control-list">
      <hr>
        <button type="button" id="selectCount" class="selected-btn btn btn-custom gap"></button>
        <button type="button" id="modal-delete" class="btn btn-icons btn-custom gap"><i class="bi bi-trash"></i></button>
      <hr>
    </div>
    <!-- end total count -->

    <!-- end control list -->

  </div>
  <!-- end card header -->

  <!-- card body -->
  <div class="card-body">

    <!-- hidden -->
    <input type="hidden" id="form_token" name="form_token" value=""/>
    <input type="hidden" id="remark" name="remark" value=""/>
    <!-- end hidden -->

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
                <table class="table table-striped">

                  <!-- thead -->
                  <thead class="bg-danger text-white mx-3">

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

                              <a href="{{ route($hyperlink['page']['view'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id,'id'=>$v->publication_id]) }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-pencil"></i>
                              </a>

                              <a data-href="{{ route($hyperlink['page']['delete']['main'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" class="btn-delete-publication btn-sm btn btn-danger">
                                <i class="bi bi-trash text-white"></i>
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

              @break

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

<!-- modal filter -->
  <div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">

    <!-- modal dialog -->
    <div class="modal-dialog" role="document">

      <!-- modal content -->
      <div class="modal-content">

        <!-- form filter -->
        <form action="{{ route($hyperlink['page']['list'],['organization_id'=>request()->organization_id,'employee_id'=>request()->employee_id]) }}" method="GET">

          <!-- modal header -->
          <div class="modal-header">
            <h5 class="modal-title">Filter By</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <!-- end modal header -->

          <!-- modal body -->
          <div class="modal-body">

            <div class="col-md-12">

              <div class="form-group">
                <label for="need_verification">Verification Status</label>
                <select class="form-control select2" id="need_verification" name="need_verification">
                  <option value="">-Select Status-</option>
                  <option value="1">Pending</option>
                  <option value="0">Verified</option>
                </select>

              </div>

            </div>

          </div>
          <!-- end modal body -->

          <!-- modal footer -->
          <div class="modal-footer">
            {!! ((!empty(request()->input('search')))?'<input type="hidden" name="search" value="'.request()->input('search').'"/>':'') !!}
            <input type="hidden" name="form_token" value="{{ $form_token['filter'] }}"/>
            <button type="submit" class="btn btn-custom">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
          <!-- end modal footer -->

        </form>
        <!-- end form -->

      </div>
      <!-- end modal content -->

    </div>
    <!-- end modal dialog -->

  </div>
  <!-- end modal filter -->


  <!-- Script for dynamic row numbering and file operations -->
  <script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function($){

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[class*="btn-delete-main"]').on('click',function(event){

      //Set Parent Row
      var parent_row = $(this).closest('tr').attr('id');



      //Set Form Token
      var form_token = '{{ $form_token["delete"] }}';

      //Set Hyperlink
      var hyperlink  = $(this).data('href');
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
