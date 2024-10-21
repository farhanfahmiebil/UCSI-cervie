<!-- tab pane -->
<div class="tab-pane fade {{ ((request()->tab_category == 'general_information')?'show active':'') }}" id="general_information" role="tabpanel">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['organization_id'=>request()->organization_id,'id'=>request()->id,'tab'=>'tab','tab_category'=>'general_information']) }}" method="POST">
    {{csrf_field()}}

    <!-- card -->
    <div class="card">

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-sm-12 col-12">

            <!-- row -->
            <div class="row gx-3">

              <!-- col -->
              <div class="col-12">

                <!-- row -->
                <div class="row justify-content-center mt-5">

                  <!-- content -->
                  <div class="col-xxl-8 col-sm-12 col-12 order-xxl-2 order-xl-1 order-lg-1 order-md-1 order-sm-1">
                    <div class="card">

                      <div class="card-body">
                        <h5 class="card-title mb-2">Position</h5>

                        <!-- table responsive -->
                        <div class="table-responsive pt-5">

                          <!-- table -->
                          <table class="table table-striped">

                            <!-- thead -->
                            <thead class="bg-danger text-white mx-3">

                              @php

                                //Set Checkbox Status
                                $checkbox['status'] = false;

                              @endphp

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

                                          @php

                                            //Set Checkbox Status
                                            $checkbox['status'] = true;

                                          @endphp

                                          <td class="{{ $value['class'] }}">

                                        @else
                                          <td>
                                        @endif

                                          {{-- Output the icon and name --}}
                                          {!! isset($value['icon']) ? $value['icon'] : '' !!}
                                          {{ isset($value['name']) ? $value['name'] : '' }}

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

                              {{-- Check Researcher Position Exist --}}
                              @if(count($data['main']['cervie']['researcher']['position']) > 0)

                                {{-- Get Researcher Position Data --}}
                                @foreach($data['main']['cervie']['researcher']['position'] as $key=>$value)

                                  <tr id="{{ $value->position_id }}">

                                    {{-- Check if Checkbox Status True --}}
                                    @if($checkbox['status'])
                                      <td>
                                        <div class="form-check-label">
                                          <input type="checkbox" name="id[]" class="form-check-input selectBox" value="{{ $value->position_id }}"/>
                                        </div>
                                      </td>
                                    @endif
                                    {{-- End Check if Checkbox Status True --}}

                                    <td>{{ ($key+1) }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->organization_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($value->date_end)->format('d F Y') }}</td>
                                    <td><span class="badge bg-{{ (($value->need_verification)?'warning':'success') }}">{{ (($value->need_verification)?'Pending':'Verified') }}</span></td>
                                    <td>

                                      <a href="{{ route($hyperlink['page']['position']['view'],['id'=>$value->position_id]) }}" class="btn btn-sm btn-secondary">
                                        <i class="mdi mdi-pencil"></i>
                                      </a>

                                      <a data-href="{{ route($hyperlink['page']['position']['delete']) }}" class="modal-delete-position btn btn-sm btn-danger">
                                        <i class="mdi mdi-trash-can text-white"></i>
                                      </a>

                                    </td>
                                  </tr>

                                @endforeach
                                {{-- End Get Researcher Position Data --}}

                              @else

                                <tr>
                                  <td colspan="{{ count($data['table']['column']['cervie']['researcher']['position']) }}">No Data</td>
                                </tr>

                              @endif
                              {{-- End Check Researcher Position Exist --}}

                            </tbody>
                            <!-- end tbody -->

                          </table>
                          <!-- end table -->

                          <!-- pagination -->
                          <div class="col-12 pt-3">

                            {{-- Check Main Data Exist --}}
                            @if(count($data['main']['cervie']['researcher']['position']) >= 1)

                              <!-- paginate -->
                              {{ $data['main']['cervie']['researcher']['position']->appends(request()->input())->links(Config::get('routing.application.modules.dashboard.researcher.layout').'.navigation.pagination.index',['navigation'=>['alignment'=>'center']]) }}
                              <!-- end paginate -->

                            @endif
                            {{-- End Check Main Data Exist --}}

                          </div>
                          <!-- end pagination -->

                        </div>
                        <!-- end table responsive -->
                        
                      </div>
                    </div>
                  </div>
                  <!-- end content -->

                  <!-- content navigation right -->
                  <div class="col-xxl-3 col-sm-4 col-12 order-xxl-3 order-xl-3 order-lg-3 order-md-3 order-sm-3">

                    <!-- position -->
                    <div class="stats-tile d-flex align-items-center tile-red">
                      <div class="sale-icon icon-box xl rounded-5 me-3">
                        <i class="bi bi-boxes font-2x text-red"></i>
                      </div>
                      <div class="sale-details text-white">
                        <h5>Position</h5>
                      </div>
                    </div>
                    <!-- end position -->

                    <!-- area interest -->
                    <div class="stats-tile d-flex align-items-center border">
                      <div class="sale-icon icon-box xl rounded-5 me-3">
                        <i class="bi bi-joystick font-2x text-red"></i>
                      </div>
                      <div class="sale-details text-secondary">
                        <h5>Area Interest</h5>
                      </div>
                    </div>
                    <!-- end area interest -->

                  </div>
                  <!-- end content navigation right -->

                </div>
                <!-- end row -->

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
      <a href="{{ route($hyperlink['page']['list']['home'],['organization_id'=>request()->organization_id]) }}" class="btn btn-dark">Back to List</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end tab pane -->


<script type="text/javascript">

/**************************************************************************************
  Document On Load
**************************************************************************************/
$(document).ready(function($){


});

</script>
