<!-- virtual card -->
<div class="tab-pane fade {{ ((request()->tab_category == 'setting' && request()->tab_sub_category == 'virtual_card')?'show active':'') }}" id="v-pills-virtual_card" role="tabpanel" aria-labelledby="v-pills-virtual_card-tab">

  <!-- form -->
  <form action="{{ route($hyperlink['page']['update'],['id'=>request()->id,'tab'=>'tab','tab_category'=>'setting','tab_sub_category'=>'virtual_card']) }}" method="POST">
    @csrf

    <!-- card -->
    <div class="card">

      <!-- card header -->
      <div class="card-header">
        <h3>Virtual Card Hyperlink</h3>
      </div>
      <!-- end card header -->

      <hr>

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          <!-- col -->
          <div class="col-12">

            <!-- col -->
            <div class="col-12">

              <!-- qr code -->
              <div class="dz-message needsclick p-3 text-center">
                {!!
                  QrCode::size(200)
                        ->color(255,0,0)
                        ->margin(1)
                        ->generate(route($hyperlink['page']['virtual']['card'],['id'=>Auth::id()]))
                !!}
                <br>

                <label>Scan to Get Detail</label>
              </div>
              <!-- qr code -->

            </div>
            <!-- end col -->

            <!-- hyperlink -->
            <div class="mb-3">
              <div class="form-group">
                <label for="">Hyperlink</label>
                <div class="input-group">
									<input type="text" class="form-control" name="" value="{{ route($hyperlink['page']['virtual']['card'],['id'=>Auth::id()]) }}" disabled>
									<a href="{{ route($hyperlink['page']['virtual']['card'],['id'=>Auth::id()]) }}" class="btn btn-danger" target=”_blank”>
										View
									</a>
								</div>
              </div>
            </div>
            <!-- end hyperlink -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->


      </div>
      <!-- end card body -->

      <!-- card header -->
      <div class="card-header">
        <h3>Logo Header</h3>
        <small><i>Only One Selection</i></small>
      </div>
      <!-- end card header -->

      <!-- card body -->
      <div class="card-body">

        <!-- row -->
        <div class="row gx-3">

          {{-- Check Data Company Exist --}}
          @if(count($data['company']) >= 1)

            {{-- Check Employee VIrtual Card Exist --}}
            @if(isset($data['employee']['virtual_card']))

              @php

                //Explode String Into Array
                $company_id = explode(',',$data['employee']['virtual_card']->logo_header);

              @endphp

            @else

              @php

                //Set Default
                $company_id = array('UCSI_GROUP');

              @endphp

            @endif
            {{-- End Check Employee VIrtual Card Exist --}}

            {{-- Get Data Company --}}
            @foreach($data['company'] as $key=>$value)

              {{-- Check Avatar Exist --}}
              @if(Storage::exists('public/resources/company/'.$value->company_id.'/logo/index.png'))

                @php

                  //Set Avatar
                  $avatar = URL::asset('storage/resources/company/'.$value->company_id.'/logo/index.png');

                @endphp

                <!-- col -->
                <div class="col-2">

                  <!-- company -->
                  <div class="mb-3">
                    <div class="form-group border text-center">
                      <input type="checkbox" id="box_company_{{ $key }}" name="company_id[]" value="{{ $value->company_id }}" {{ (in_array($value->company_id,$company_id)?'checked':'') }}>
                      <label for="box_company_{{ $key }}"><img src="{{ $avatar }}" /></label>
                    </div>
                  </div>
                  <!-- end company -->

                </div>
                <!-- end col -->

              @endif
              {{-- End Check Avatar Exist --}}

            @endforeach
            {{-- End Get Data Company --}}

          @endif
          {{-- End Check Company Exist --}}

        </div>
        <!-- end row -->

      </div>
      <!-- end card body -->

    </div>
    <!-- end card -->

    <!-- control -->
    <div class="d-flex gap-2 justify-content-end">
      <input type="hidden" name="tab_category" value="setting">
      <input type="hidden" name="tab_sub_category" value="virtual_card">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
    <!-- end control -->

  </form>
  <!-- end form -->

</div>
<!-- end virtual card -->
