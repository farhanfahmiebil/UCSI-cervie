@extends(Config::get('routing.application.modules.dashboard.employee.layout').'.structure.index')

@section('main-content')

  <!-- error -->
  @if($errors->any())
    <div class="col-md-12">
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
  <!-- end error -->

  <!-- nav tab -->
  <ul class="nav nav-tabs" id="customTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link {{ ((request()->route('status')=='submission')?'active':'') }}" id="tab-document-submission" href="{{ route($hyperlink['page']['list'],['company_id'=>request()->route('company_id'),'status'=>'submission']) }}">Submission</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link {{ ((request()->route('status')=='cancelled')?'active':'') }}" id="tab-document-cancelled" href="{{ route($hyperlink['page']['list'],['company_id'=>request()->route('company_id'),'status'=>'cancelled']) }}">Cancelled</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link {{ ((request()->route('status')=='rejected')?'active':'') }}" id="tab-document-rejected"  href="{{ route($hyperlink['page']['list'],['company_id'=>request()->route('company_id'),'status'=>'rejected']) }}">Reject</a>
		</li>
	</ul>
  <!-- end nav tab -->

  <!-- tab content -->
  <div class="tab-content" id="customTabContent">

    {{-- Status --}}
    @include($page['sub'].'.status')

    <!-- end submission -->

	</div>
  <!-- end tab content -->



  {{-- Pop Alert --}}
  @include($hyperlink['navigation']['layout']['dashboard']['employee']['modal']['pop_alert'])

  <script type="text/javascript">

  /**************************************************************************************
    Document On Load
  **************************************************************************************/
  $(document).ready(function($){

    /**************************************************************************************
      Session
    **************************************************************************************/
    @if(Session('message'))
      alertModal(
        {
          'modal_name':'modal-alert',
          'title':'{{ ucwords(Session::get('alert_type')) }}',
          'message':'{{ ucwords(Session::get('message')) }}'
        }
      );
    @endif

    /**************************************************************************************
      Modal Delete
    **************************************************************************************/
    $('[id="modal-delete"]').on('click',function(event){
      modeModal(
        {
          'form_name':'form-checklist',
          'modal_name':'modal-soft-delete',
          'data':[{
                    'token':{!! json_encode($form_token['delete']) !!}
                 }],
        }
      );
    });

    /**************************************************************************************
      Modal Revert
    **************************************************************************************/
    $('[class*="modal-revert"]').on('click',function(event){
      // console.log($(this).attr('data-id'));
      modeModal(
        {
          'id':$(this).attr('data-id'),
          'form_name':'form-checklist',
          'modal_name':'modal-revert',
          'data':[{
                  'token':{!! json_encode($form_token['revert']) !!}
                 }],
        }
      );
    });

  });
  </script>

@endsection
