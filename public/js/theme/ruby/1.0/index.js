(function($){

  'use strict';
  $(function(){

    //Enable Select2
    // $('.select2').select2();
    $('select').select2({
      width:'100%'
    });

    //Enable Tooltip
    $('[data-toggle-secondary="tooltip"]').tooltip();

    //Enable Popover
    $('[data-toggle="popover"]').popover()

    //Dismiss Popover
    $('.popover-dismiss').popover({trigger:'focus'})

  });

})(jQuery)
