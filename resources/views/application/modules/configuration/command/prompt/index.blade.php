@extends(Config::get('routing.application.modules.configuration.layout').'.structure.index')

@section('main-content')

  <!-- container -->
  <div class="container">
    <!-- <h1>Terminal</h1> -->
    <br>

    <!-- panel -->
    <div class="panel">

      <!-- action -->
      <div class="action">
        <div class="command"><span class="symbol">System Administrator Access</span>
        </div>
        <div class="output"></div>
      </div>
      <!-- end action -->

      <!-- break line -->
      <br>
      <!-- end break line -->

      <!-- action -->
      <div class="action">
        <div class="command"><span class="symbol">> </span>
          <input class="input" type="text" placeholder="Type help or ?" autofocus="" autocomplete="off"/>
        </div>
        <div class="output"></div>
      </div>
      <!-- end action -->

    </div>
    <!-- end panel -->

  </div>
  <!-- end container -->

  <script type="text/javascript">

  //Set Path
  var path;

  /**************************************************************************************
    Document Ready
  **************************************************************************************/
  $(document).ready(function(){

    //Init
    path = hyperlink(
      {
        'hyperlink':{
          'ajax':{
            'configuration':'{{ route($hyperlink['ajax']['configuration']) }}',
          },
          'home':'#',
          'route':{
            'list':'{{ route($hyperlink['page']['route']['list']) }}'
          }
        }
      }
    );

    /**************************************************************************************
      Panel on Keypress and Input
    **************************************************************************************/
    $('.panel').on('keypress','.input',function(e){

      //Set Input
      var input = $(this).val();

      //On Enter
      if(e.which == 13){

        //Set Prperty to True
        $(this).prop('readonly', true);

        //Execute
        execute(input);

      }

    });

    /**************************************************************************************
      Panel
    **************************************************************************************/
    $('.panel').stop().animate({
      scrollTop:$(".panel")[0].scrollHeight
    },800);

  });

  </script>

@endsection
