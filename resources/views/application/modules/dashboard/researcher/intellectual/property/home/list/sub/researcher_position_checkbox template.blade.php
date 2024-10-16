<!-- publication -->
<div class="row">

  <!-- col -->
  <div class="col-sm-12 grid-margin d-flex stretch-card">

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <!-- header -->
        <div class="d-flex align-items-center justify-content-between">

          <!-- title -->
					<h4 class="card-title mb-2">Researcher Position</h4>
          <!-- end title -->

          <!-- dropdown -->
					<div class="dropdown">
            <a href="{{ route($hyperlink['page']['new']['position']) }}" class="btn btn-light px-1">
              <i class="mdi mdi-plus text-dark"></i>
              New Position
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
              @if(isset($data['table']['column']['cervie']['researcher']['position']) && count($data['table']['column']['cervie']['researcher']['position']) >= 1)

                  {{-- Get Table Column Data --}}
                  @foreach($data['table']['column']['cervie']['researcher']['position'] as $key => $value)

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

              {{-- Check Researcher Position Exist --}}
              @if(count($data['main']['cervie']['researcher']['position'])>0)

                {{-- Get Researcher Position Data --}}
                @foreach($data['main']['cervie']['researcher']['position'] as $key=>$value)

                  <tr id="{{ $value->position_id }}">
                    <td>
                      <div class="form-check-label">
                        <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $value->position_id }}"/>
  										</div>
                    </td>
                    <td>{{ ($key+1) }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->organization_name }}</td>
                    <td><label class="badge badge-{{
                      (
                        ($value->status_name == 'active')?'success':(
                          ($value->status_name == 'inactive')?'warning':'danger'
                        )
                      )
                    }}">{{ ucwords($value->status_name) }}</label></td>
                  </tr>

                @endforeach
                {{-- End Get Researcher Position Data --}}

              @else

                <tr>
                  <td>1</td>
                </tr>

              @endif
              {{-- End Check Researcher Position Exist --}}


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

</div>
<!-- end publication -->
