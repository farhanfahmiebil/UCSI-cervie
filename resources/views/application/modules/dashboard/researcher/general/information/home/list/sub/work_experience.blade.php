<!-- col -->
<div class="col-sm-6 grid-margin d-flex stretch-card">

  <!-- card -->
  <div class="card">

    <!-- card body -->
    <div class="card-body">

      <!-- header -->
      <div class="d-flex align-items-center justify-content-between">

        <!-- title -->
				<h4 class="card-title mb-2">Work Experience</h4>
        <!-- end title -->

        <!-- dropdown -->
				<div class="dropdown">
          <a href="{{ route($hyperlink['page']['work']['experience']['new']) }}" class="btn btn-light px-1">
            <i class="mdi mdi-plus text-dark"></i>
            New Work Experience
          </a>
				</div>
        <!-- end dropdown -->

			</div>
      <!-- end header -->

      <!-- table responsive -->
      <div class="table-responsive pt-5">

        <!-- table -->
        <table class="table">

          <!-- thead -->
          <thead>

            {{-- Check Table Column Exist --}}
            @if(isset($data['table']['column']['cervie']['researcher']['work']['experience']) && count($data['table']['column']['cervie']['researcher']['work']['experience']) >= 1)

                {{-- Get Table Column Data --}}
                @foreach($data['table']['column']['cervie']['researcher']['work']['experience'] as $key => $value)

                    {{-- Check if the column is of category 'checkbox' --}}
                    @if(isset($value['category']) && $value['category'] == 'checkbox')

                        <td>{!! $value['checkbox'] !!}</td>

                    @else

                        {{-- Check if 'class' is set and apply it --}}
                        @if(isset($value['class']) && !empty($value['class']))
                            <td class="{{ $value['class'] }}">
                        @else
                            <td>
                        @endif

                          {{-- Output the icon and name --}}
                          {!! isset($value['icon']) ? $value['icon'] : '' !!}
                          {{ isset($value['name']) ? $value['name'] : '' }}

                        </td>

                    @endif

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

            {{-- Check Researcher Work Experience Exist --}}
            @if(count($data['main']['cervie']['researcher']['work']['experience'])>0)

              {{-- Get Researcher Work Experience Data --}}
              @foreach($data['main']['cervie']['researcher']['work']['experience'] as $key=>$value)

                <tr id="{{ $value->work_experience_id }}">
                  <td>{{ ($key+1) }}</td>
                  <td>
                    <span>{{ $value->company_name }}</span>
                    <br>
                    <span>{{ $value->designation }}</span>
                  </td>
                  <td>{{ $value->year_start }} - {{ (($value->is_working_here)?'Current':$value->year_end)  }}</td>
                  <td>

                    <a href="{{ route($hyperlink['page']['work']['experience']['view'],['id'=>$value->work_experience_id]) }}" class="btn btn-secondary">
                      <i class="mdi mdi-pencil"></i>
                    </a>

                    <a href="#" class="btn btn-danger">
                      <i class="mdi mdi-trash-can text-white"></i>
                    </a>

                  </td>
                </tr>

              @endforeach
              {{-- End Get Researcher Work Experience Data --}}

            @else

              <tr>
                <td colspan="{{ count($data['table']['column']['cervie']['researcher']['work']['experience']) }}">No Data</td>
              </tr>

            @endif
            {{-- End Check Researcher Work Experience Exist --}}

          </tbody>
          <!-- end tbody -->

        </table>
        <!-- end table -->

      </div>
      <!-- end table responsive -->

    </div>
    <!-- end card body -->

  </div>
  <!-- end card -->

</div>
<!-- end col -->
