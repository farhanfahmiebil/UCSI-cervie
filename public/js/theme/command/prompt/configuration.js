var path;

/**************************************************************************************
  Template Command
**************************************************************************************/
function templateCommand(){

  //Set Message
  var message = '';

  //Set Message
  message += '<div class="action">';
  message += '<div class="command">';
  message += '<span class="symbol">>';
  message += '</span>';
  message += '<input class="input" type="text" autocomplete="off">';
  message += '</div>';
  message += '<div class="output">';
  message += '</div>';
  message += '</div>';

  //Return Message
  return message;

}

/**************************************************************************************
  Execute
**************************************************************************************/
function execute(input,parameter = null){

  //Get Value
  switch(input){

    //Home
    case 'home':

      //Redirect Url
      window.location.href = path.hyperlink.home;

    break;

    //Help
    case '?':
    case 'help':

      showHelp();

    break;


    //Route List
    case 'route:list':

      window.location.href = path.hyperlink.route.list;

    break;

    //Config Cache
    case 'config:clear':

      //Get Configuration
      getConfiguration(
        {
          'value':'config_clear'
        }
      );

    break;

    //Config Cache
    case 'config:cache':

      //Get Configuration
      getConfiguration(
        {
          'value':'config_cache'
        }
      );

    break;

    //PHP Artisan Optimize
    case 'optimize':

      //Get Configuration
      getConfiguration(
        {
          'value':'optimize'
        }
      );

    break;


    //Route Cache
    case 'route:cache':

      //Get Configuration
      getConfiguration(
        {
          'value':'route_cache'
        }
      );

    break;

    //Route Cache
    case 'route:clear':

      //Get Configuration
      getConfiguration(
        {
          'value':'route_clear'
        }
      );

    break;

    //Route Cache
    case 'cls':

      resetForm();

    break;

    //Route Cache
    case '':
    case ' ':

      //Set Default Template
      $('.panel').append($('<div class="action">').html(templateCommand()));
      $('.input').last().focus();

    break;

    default:

      errorForm(input);

    break;

  }

}

/**************************************************************************************
  Get Configuration
**************************************************************************************/
function getConfiguration(data){

  var loader = '';

  loader += 'Processing...'
  // loader += '<div class="loading-dots">';
  // loader += '<span class="dot one">.</span>';
  // loader += '<span class="dot two">.</span>';
  // loader += '<span class="dot three">.</span>';
  // loader += '</div>';

  //Set Header
  $.ajaxSetup({
    'headers':{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  });

  //Set Request
  $.ajax({
    'type':'GET',
    'url':path.hyperlink.ajax.configuration,
    'data':{'value':data.value},
    beforeSend:function(){

      //Break Line
      $('.panel').append($('<div class="action">').html(''));

      //Set Panel Loader
      $('.panel').append($('<div class="action">').html(loader));

    },
    success:function(data){

      //Set Panel Message
      $('.panel').append($('<div class="action">').html(data));

      //Set Panel Message Empty
      $('.panel').append($('<div class="action">').html('&nbsp;'));

      //Set Default Template
      $('.panel').append($('<div class="action">').html(templateCommand()));

      //Set Last Focus
      $('.input').last().focus();

    }

  });

}

/**************************************************************************************
  Reset Form
**************************************************************************************/
function resetForm(){

  //Clear Command Prompt
  $('.terminal').children(':not(.prompt:first)').remove();

  //Set Input Null
  input.val('');

  //Create Break Line for New Input to Type
  $('.terminal').append('<p class="prompt output new-output"></p>');

}

/**************************************************************************************
  Error Form
**************************************************************************************/
function errorForm(input){

  //Set Message
  var message = '\''+input+'\' :command not found';

  //Set Panel Message
  $('.panel').append($('<div class="action">').html(message));

  //Set Panel Message Empty
  $('.panel').append($('<div class="action">').html('&nbsp;'));

  //Set Default Template
  $('.panel').append($('<div class="action">').html(templateCommand()));

  //Set Last Focus
  $('.input').last().focus();

}

/**************************************************************************************
  Show Help
**************************************************************************************/
function showHelp(){

  //Set Message
  var message  = '<p class="prompt">Option:</p>';
      message += '<p class="prompt continous">'+spaceGap(1)+'</p>';
      message += '<p class="prompt continous">help or ?'+spaceGap(11)+' :Get Help</p>';
      message += '<p class="prompt continous">home '+spaceGap(15)+' :Go To Login</p>';
      message += '<p class="prompt continous">route:list '+spaceGap(9)+' :Display List of Route</p>';
      message += '<p class="prompt continous">config:clear '+spaceGap(7)+' :Remove Configuration Cache</p>';
      message += '<p class="prompt continous">config:cache '+spaceGap(7)+' :Create a Cache File</p>';
      message += '<p class="prompt continous">optimize '+spaceGap(11)+' :Creates a Compiled File</p>';
      message += '<p class="prompt continous">route:cache '+spaceGap(8)+' :Caching your Routes</p>';
      message += '<p class="prompt continous">route:clear '+spaceGap(8)+' :Clear the Route Cache</p>';
      message += '<p class="prompt continous">'+spaceGap(1)+'</p>';

  //Set Panel Message
  $('.panel').append($('<div class="action">').html(message));

  //Set Default Template
  $('.panel').append($('<div class="action">').html(templateCommand()));

  //Set Last Focus
  $('.input').last().focus();

}

$('body').on('click',function(){

  //Set Last Focus
  $('.input').last().focus();

});

/**************************************************************************************
  Hyperlink
**************************************************************************************/
function hyperlink(path){

  return path;

}

/**************************************************************************************
  Space Gap
**************************************************************************************/
function spaceGap(range){

  //Set Text
  var text = '';

  //Get Loop
  for(var x = 0;x < range;x++){

    text += '&nbsp;';

  }

  //Return Text
  return text;

}
