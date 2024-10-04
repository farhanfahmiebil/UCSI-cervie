/**************************************************************************************
	Window On Load
**************************************************************************************/
$(window).on('load',function(){

	"use strict";

 $('[data-toggle="popover"]').popover()

	$('.search-box').hide();
	$('.control-list').hide();

	//Verification
	//$('#verification-user').modal('show');

	/* 	Animate loader off screen.
	**************************************************************************************/
	$(".preloader").fadeOut("slow");
	$(".login-page").fadeIn("slow");


	/* 	Search Box for List View
	**************************************************************************************/
	$('#search-box').click(function(){

		//If Not Visible
		if($('.search-box').is(':visible')){
			$('.search-box').fadeOut();
			return true;
		}

		//If Visible
		$('.search-box').fadeIn();
		return false;

  });

	 /* 	Sort Item for List View
 	**************************************************************************************/
  $('.sort-item').click(function(e){

     //Put Data Into Form
     $('#form-sort #sorting_column').val($(this).attr('data-sort-id'));
     $('#form-sort #sorting').val($(this).attr('data-sort'));
		 $('#form-sort #sorting_display').val($(this).attr('data-sort-display'));
		 //console.log($(this).attr('data-sort-id'));
     //Form Submit
     $("#form-sort").submit();

  });

	 /* 	On Hide Reset To Null List View
 	**************************************************************************************/
   //$('#modal-revert,#modal-checklist').on('hidden.bs.modal', function(event){$("#form-checklist #type").val('');});
   $('#modal-filter').on('hidden.bs.modal', function(event){$('#form-filter').find('.select2').val(null).trigger('change');});

	 $('#selectAll').on('click',function(){

      if($(this).prop('checked')){

				//Control List Show
	      $('.control-list').fadeIn();

				//Checked All Select Box
        $('.selectBox').each(function(){$(this).not(':disabled').prop('checked',true)});

      }else{

				//Control List Hide
	      $('.control-list').fadeOut();

				//Unchecked All Select Box
				$('.selectBox').each(function(){$(this).prop('checked',false);});
      }

			//Get Total Count Selected
	    $('#selectCount').html($('.selectBox:checked').length+' Selected');

    });

		$('.selectBox').on('click',function(){

			//If Select Box Per Item Checked
			if($(this).prop('checked')){

			 //Control List Show
			 $('.control-list').fadeIn();

			}

			//If Select Box Per Item Unchecked
			else{

			 //Check Select Box Per Item Unchecked
			 if($('.selectBox:checked').length == 0){$('.control-list').fadeOut();}

			}

			//Get Total Count Selected
			$('#selectCount').html($('.selectBox:checked').length+' Selected');

	 });	

});

/**************************************************************************************
	Function
**************************************************************************************/

function inputSetting(category,e){

	var character_code = (e.which) ? e.which : e.keyCode

	switch(category){

		case 'number':

			if(character_code > 31 && (character_code < 48 || character_code > 57)){

				return false;

			}

			return true;

		break;

		default:

		break;

	}



}

/* 	Clock
**************************************************************************************/
function Clock(data) {

	setInterval(function(){

		//Check Class or ID
		var id = checkClassOrID(data.id);

		//Get Date Function
		var time = new Date();

		//Get Hour
		var hours = time.getHours(); // this is local hours, may want getUTCHours()

		if(data.time_type.toLowerCase() === 'normal'){

			// Adjust for Timezone
			hours = (hours + 24 - 2) % 24;
			// Get AM/PM
			var am = hours < 12 ? 'AM' : 'PM';
			// Convert to 12-Hour Style
			hours = (hours % 12) || 12;

			var get_time = (hours<10?'0':'') + hours;
					get_time += ':';
					get_time += (time.getMinutes()<10?'0':'') + time.getMinutes();
					get_time += ':';
					get_time += (time.getSeconds()<10?'0':'') + time.getSeconds();
					get_time += ' ';
					get_time += am;

		}else if(strtolower(data.time_type) === 'military'){

			var get_time = (hours<10?'0':'') + hours;
					get_time += ':';
					get_time += (time.getMinutes()<10?'0':'') + time.getMinutes();
					get_time += ':';
					get_time += (time.getSeconds()<10?'0':'') + time.getSeconds();
		}

		$(id).html(get_time);

	}, 1000);
}

/* 	Geo Location
**************************************************************************************/
function Geolocation(data){

	//Check Class or ID
	var id = checkClassOrID(data.id);

		if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
						$(id).html('Latitude:'+position.coords.latitude.toFixed(2)+'<br/> Longitude:'+position.coords.longitude.toFixed(2)+'');
				});
    }else{
        $(id).text('Geolocation is not supported by this browser.');
    }
}

/* 	Alert Modal
**************************************************************************************/

function alertModal(data){
	$('#'+data.modal_name).modal('show');
	$('#'+data.modal_name).find('.modal-title').html(data.title);
	$('#'+data.modal_name).find('.modal-body .text').html(data.message);
}

/* 	Confirmation Modal

function confirmationModal(data){ console.log(1);


		//
		$('#'+data.modal_name).find('.modal-title').html(data.title);
		$('#'+data.modal_name).find('.modal-body .text').html(data.message);


		//If Yes Clicked
		$('#'+data.modal_name+' .btn_true').click(function(event){

			window.location = data.redirect;
			//	$('#'+data.form_name).submit();
			}
		);
}
**************************************************************************************/

/* Create Bootstrap Modal Dynamicly
   USAGE: new bootstrapModal('Title','Body Text').Show();
-----------------------------------------------------*/
var bootstrapModal = function(data){
  var title = data.title || 'No Title';
  var body = data.body || 'No body';
  var buttons = data.buttons || [
    {
      value:'Close',
      css:'btn-secondary',
      Callback: function(event){
        bootstrapModal.Close();
      }
    }
  ];

  var get_modal_structure = function() {
    var that = this;
    that.id = bootstrapModal.id = Math.random();
    var html_button = '';
    for (var i = 0; i < buttons.length; i++) {
      html_button += '<button type="'+(buttons[i].type || 'button')+'" '+((buttons[i].id) ? 'id="'+(buttons[i].id)+'"':'')+'  class="btn ' +(buttons[i].css || '') + ' '+ (buttons[i].class || '')+ '" name="btn' + that.id +'">' + (buttons[i].value || 'CLOSE') +'</button>';
    }

		var html_remark = '';
		if(data.remark === true){
			//html_remark += '<div class="row">';
			html_remark += '<div class="col-md-12">';
			html_remark += '<div class="form-group">';
			html_remark += '<label for="status">Remark</label>';
			html_remark += '<input type="text" class="form-control" id="remark_data" name="remark_data" placeholder="Remark">';
			html_remark += '</div>';
			html_remark += '</div>';
			//html_remark += '</div>';
		}

    var html_content = '<div class="modal fade" name="modal_token" id="' + that.id + '" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="' +
      that.id + '"Label">';
			html_content += '<div class="modal-dialog" role="document">';
      html_content += '<div class="modal-content">';
      html_content += '<div class="modal-header">';
			html_content += '<h5 class="modal-title text-center">';
			html_content += title;
			html_content += '</h5>';
      html_content += '<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">';
      html_content += '<span aria-hidden="true">&times;</span>';
      html_content += '</button>';
      html_content += '</div>';
      html_content += '<div class="modal-body">';

			if(data.remark === true){
	      html_content += html_remark;
			}else{
				html_content += '<div class="row">';
	      html_content += '<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">' + body + '</div>';
	      html_content += '</div>';
			}

      html_content += '</div>';
      html_content += '<div class="modal-footer">';
      html_content += html_button;
      html_content += '</div>';
      html_content += '</div>';
      html_content += '</div>';
      html_content += '</div>';
			html_content += '</div>';


    return html_content;
  }();
  bootstrapModal.Delete = function() {
    var modals = document.getElementsByName("modal_token");
    if (modals.length > 0) document.body.removeChild(modals[0]);
  };
  bootstrapModal.Close = function() {
    $(document.getElementById(bootstrapModal.id)).modal('hide');
    bootstrapModal.Delete();
  };
  this.Show = function() {
    bootstrapModal.Delete();
    document.body.appendChild($(get_modal_structure)[0]);
    var btns = document.querySelectorAll("button[name='btn" + bootstrapModal.id + "']");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", buttons[i].Callback || bootstrapModal.Close);
    }
    $(document.getElementById(bootstrapModal.id)).modal('show');
  };
};

function modeModal(collection){
console.log(collection);
	var type = '';
	var title = ((collection.header_title)?collection.header_title:'');
	var button;
	var message = '';
	// var message_custom = ((collection.data[0].message_custom)?collection.data[0].message_custom:'');
	var message_custom = ((collection.message_custom)?collection.message_custom:'');
	var id = [];
	var get_form_name = checkClassOrID(collection.form_name);

	$('.selectBox:checked').each(function(i){

    multi_select = true;
    id[i] = $(this).val();
  });

	switch(collection.modal_name){

		case 'modal-soft-delete':
				title='Confirmation';
				message = (message_custom && message_custom !== '')?message_custom:'Are you Sure You Want To Delete This '+((id.length > 1)?'('+id.length+')':'')+' Item ? <br/> (<b>Status will change to <span class="badge bg-danger">Deleted</span>. Once status change to <span class="label label-danger">deleted</span> status. User can have option to permanently delete or revert back.</b>';
				button = [
						{
							id: 'btn-remark',
							type: 'button',
							value: 'Yes',
							css: 'btn-custom'
						},
						{
							type: 'button',
							value: 'No',
							css: 'btn-secondary',
							Callback: function(event) {
								bootstrapModal.Close();
							}
						}
		    	]
		break;

		case 'modal-hard-delete':
				title='Confirmation';
				message = (message_custom && message_custom !== '')?message_custom:'Are you Sure You Want To Delete This '+((id.length > 1)?'('+id.length+')':'')+' Item ?';
				button = [
						{
							id: 'btn-submit',
							type: 'submit',
							value: 'Yes',
							css: 'btn-custom'

						},
						{
							type: 'button',
							value: 'No',
							css: 'btn-secondary',
							Callback: function(event) {
								bootstrapModal.Close();
							}
						}
		    	]

		break;

		case 'modal-revert':

				//Check ID Exist
				id = (collection.id)?collection.id:'';
console.log(get_form_name+' #'+id);
				//If ID Exist
				if(id){
					$(get_form_name).not('#'+id).find('.selectBox').prop('checked', false);
					$(get_form_name+' #'+id).find('.selectBox').prop('checked',true);
				}
				title='Remark';
				message = (message_custom && message_custom !== '')?message_custom:'Are you Sure You Want To Revert This Item ? <br/> (<b>Status will change to <span class="badge bg-warning">Inactive</span>. Once status change to <span class="badge bg-warning">Inactive</span> status. User can have option to <span class="badge bg-success">Active</span> or <span class="badge bg-danger">Delete</span>.</b>';
				button = [
						{
							id: 'btn-remark',
							type: 'submit',
							value: 'Yes',
							css: 'btn-custom'

						},
						{
							type: 'button',
							value: 'No',
							css: 'btn-secondary',
							Callback: function(event) {
								bootstrapModal.Close();
							}
						}
		    	]
		break;

		case 'modal-confirmation':

			message = (message_custom && message_custom !== '')?message_custom:'';
			button = [
					{
						type: 'button',
						value: 'No',
						css: 'btn-secondary',
						Callback: function(event){

							/****Last Change 17/10/2022**/

							// if(typeof collection.is_second_layer && collection.is_second_layer[0].status === true){ console.log('#'+collection.is_second_layer[0].hide_first_layer_id);
							// 	$('#'+collection.is_second_layer[0].hide_first_layer_id+' .modal-content').removeClass('backdrop');
							// }

							bootstrapModal.Close();
						}
					},
					{
						id: 'btn-confirmation',
						type: 'button',
						value: 'Yes',
						css: 'btn-custom'

					}
	    	]

		break;

		default:
			title='No Title';
			msg = 'No Message';
		break;

	}

	//Check If Second Layer Is Called
	if(typeof collection.is_second_layer !== 'undefined' && collection.is_second_layer[0].status === true){
		$('#'+collection.is_second_layer[0].hide_first_layer_id+' .modal-content').addClass('backdrop');
	}

  new bootstrapModal(
    {
    'title':title,
    'body':message,
    'buttons':button
  	}
  	).Show();

	if(collection.modal_name === 'modal-soft-delete' || collection.modal_name === 'modal-revert'){

		$('#btn-remark').on('click',function(event){
	    //modal_delete.hide();
	    bootstrapModal.Close();
	     new bootstrapModal(
	      {
	      'title':'Remark',
	      'remark':true,
	      'buttons':[
	        {
	          id: 'btn-submit',
	          type: 'button',
	          value: 'Yes',
	          css: 'btn-custom'
	        },
	        {
	          type: 'button',
	          value: 'Cancel',
	          css: 'btn-secondary',
	          Callback: function(event) {
	            bootstrapModal.Close();
	          }
	        }
	      ]
	    	}
	    ).Show();

			var remark = $('#remark_data');
// 			console.log(get_form_name);
// console.log(collection.data[0]);
			$('#btn-submit').on('click',function(e){

				$(get_form_name+' #form_token').val(collection.data[0].token);
				$(get_form_name+' #remark').val(remark.val());
				$(get_form_name).submit();

			});


	  });
	}
	else
  if(collection.modal_name === 'modal-hard-delete'){
		$('#btn-submit').on('click', function(e){

			//Check ID and Type Of
			if(collection.data[0].id !== 'undefined' && typeof collection.data[0].id !== 'undefined'){

				//Check ID Length
				if(collection.data[0].id.length){
					$(get_form_name+' #id').val(collection.data[0].id);
				}
			}

			if(collection.data[0].filename){
				$(get_form_name+' #data').val(collection.data[0].filename);
			}

			$(get_form_name+' #form_token').val(collection.data[0].token);
			$(get_form_name).submit();

		});
	}

	$('#btn-confirmation').on('click',function(e){

		if(collection.redirection === true){

			$.post(data.path,
				{
					'_token': $('meta[name=csrf-token]').attr('content'),
					'_method' : 'POST',
					'id' : collection.data[0].id,
					'form_token' :collection.data[0].form_token
					},
					function(response){

					 if(response != '')
						{
						 console.log(response);
						}

				});
				window.location.reload();
		}else{

			console.log(get_form_name +' #'+collection.button_submit);


			$(get_form_name).submit();

		}

	});

}

//Get Class Or ID
function checkClassOrID(data){//console.log($('.dynamic-element').length);
	return ($('#'+data).length)?'#'+data:(($('.'+data).length)?'.'+data:messageError(data));
}

//Get Message Error
function messageError(data){console.log(data+' is not ID or Class');}

/* 	Check Upload Type
**************************************************************************************/
function checkUpload(data){

	var check_file;
	var get_parent;
	var file_preview;
	var image_preview;
	var reader;
	var get_form;
	var data_size;
	var checking = false;

	if(data.id[0]){

		//Get File Exist
		var check_file = checkFileExt(data);

		//If File Exist
		if(check_file){

			//Get Reader
			reader = new FileReader();

			//If Data Type Not Clone

				//Check Data Target
				data_target = checkClassOrID(data.data_target);
		//	}else{
		//		console.log(data.data_target);
		//	}

			if(data.type != 'clone'){
				//Get Parent To Point Preview
				get_parent = checkClassOrID($(data_target).parent().attr('id'));
			}else{

			}

			//Get Size
			data_size = (typeof data.data_size !== 'undefined')?data.data_size:'2097152';

			//Check Size
			if(!(data.id[0].size <= data_size)){

				//Set Alert Modal
				alertModal(
					{
						'modal_name':'modal-alert',
						'title':'Error',
						'message':'Size '+((data.upload_type == 'image')?data.upload_type:'file')+' exceeded (Max:'+data_size+'kb)',
					}
				);
				checking = false;
				return false;
			}

			//Get File Reader
			reader.onload = function(e){
				//console.log(data.id[0].size);

				//Set to File Input
				//$(data_target).attr('value', e.target.result);
				$(data_target).attr('value', data.id[0].name);
				//Check If Image Preview
				if(data.upload_type == 'image'){

					//Check Data Target
					image_preview = (typeof data.image_preview !== 'undefined')?checkClassOrID(data.image_preview):0;

					//If Image Preview
					if(image_preview){

						//Check Parent
						if($(get_parent).has(image_preview)){

							//Image Preview
							file_preview = $(get_parent).children(image_preview).attr('src', e.target.result);

						}

				 }

				}
				/*
				if(data.type == 'dynamic'){
					$(data_target).attr('value', data.id[0].name);
				}
				*/

				//Hide Text Preview
				$(get_parent+' .text').hide();


			}

			//Set Checking
			checking = true;

			//Read Input
			reader.readAsDataURL(data.id[0]);

			if((typeof data.auto_submit !== 'undefined')){

				//Get Form
				get_form = $(get_parent).closest('form').attr('id');

				//Check Form Attribute
				get_form = checkClassOrID(get_form);

				//Check Checking

				if(checking != false){
					//Form Submit
					$(get_form).submit();
				}

				//console.log();
			}


		}else{ //console.log('data.data_target');

				//$(data.data_target).attr('value', '');
			//$('#modal-alert').modal({show: 'true'});
			//alertModal('alert','Error','Invalid Image');
				alertModal(
					{
						'modal_name':'modal-alert',
						'title':'Error',
						'message':'Invalid '+((data.upload_type == 'image')?data.upload_type:'file'),
					}
				);

		}
	}
}

/* 	Get File Upload Type
**************************************************************************************/
function checkFileExt(data){
	var file_ext = {

		//Image
		'image':[
			'image/png',
			'image/jpg',
			'image/jpeg',
			'image/bmp'
		],

		//Application
		'application':[
			'application/doc',
			'application/docx',
			'application/xls',
			'application/xlsx',
			'application/ppt',
			'application/pptx',
			'application/txt',
			'application/pdf'
		],

	}

	var check_status = false;

	switch(data.upload_type){

		case 'all':
			if($.isArray(data.file_upload_type)){

				 //If Multi Extension
				for(var i = 0;i < data.file_upload_type.length;i++){


						if(data.id[0].type === data.id[0].type.split('/')[0]+'/'+data.file_upload_type[i]){

						//check_status = true;
							return true;
							break;
							//
						}//else{
						//	return false;
						//}
						//continue;
				}
				return false;
			//	check_status = true;
			}else{
				//Check Type
				for(var i = 0; i < file[data.upload_type].length; i++){

					if(data.id[0].type == file_ext[data.upload_type][i]){

						return true;
					}

				}

			}

		break;

		case 'image':

			if($.isArray(data.file_upload_type)){

				 //If Multi Extension
				for(var i = 0;i < data.file_upload_type.length;i++){

						if(data.id[0].type === data.upload_type+'/'+data.file_upload_type[i]){

							return true;
						}
						continue;
				}

				return false;
			}else{
				//Check Type
				for(var i = 0; i < file[data.upload_type].length; i++){

					if(data.id[0].type == file_ext[data.upload_type][i]){
						return true;
					}

				}

			}
		break;

		case 'application':

			if($.isArray(data.file_upload_type)){

				 //If Multi Extension
				for(var i = 0;i < data.file_upload_type.length;i++){


						if(data.id[0].type === data.upload_type+'/'+data.file_upload_type[i]){ 	//console.log('ok');
							return true;
						}
						continue;
				}

				return false;

			}else{

				//Check Type
				for(var i = 0; i < file[data.upload_type].length; i++){

					if(data.id[0].type == file_ext[data.upload_type][i]){
						return true;
					}

				}
			}
		break

		default:
			return false;
		break;
	}

}


function cloneItem(data){
	var clone_group = $('.clone-group');
	var i = $('.clone-group .clone-data').length + 1;

	//Set Default Clone Limit
	var clone_limit = (data.clone_limit)?data.clone_limit:2;
	//console.log(i+'/'+clone_limit);
	if(i == clone_limit){
		$('#add-item').hide();
	}

	$('#add-item').unbind('click').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();


			//Get Total Clone
			i = $('.clone-group .clone-data').length + 1;

			if(i == clone_limit){
				$('#add-item').hide();
			}
			//If Not Exceed Clone Limit
			if(i <= clone_limit){

				if(data.type === 'upload'){
					var data_row = '<div class="clone-data row col-md-12">';
							data_row += '<div class="input-group">';
							data_row += '<input type="text" id="clone-preview-'+i+'" name="'+data.clone_preview+'" class="form-control cursor clone-preview" placeholder="Click Here or Drag File Here" readonly>';
							data_row += '<span class="input-group-addon btn btn-add remove-clone-item"><i class="fa fa-trash "></i></span>';
							data_row += '<input type="file" id="clone-item-'+i+'" name="'+data.clone_name+'" class="form-control clone-item">';
							data_row += '</div>';
							data_row += '</div>';
					//$('<p><label for="clone_item"><input type="text" id="file_upload_preview" nane="clone_item" class="form-control cursor" placeholder="Click or Drag File Here" readonly></label> <a href="#" class="remove_clone_item">Remove</a></p>').appendTo(scntDiv);
					$(data_row).appendTo(clone_group);
					i++;

					$('[id*="clone-item-"]').unbind('change').change(function(event){
						event.preventDefault();

						var get_no = $(this).attr('id').replace('clone-item-','');
						//console.log(get_no);

						//console.log($(this).find('.attachment_file').val().replace(/C:\\fakepath\\/i, ''));
						checkUpload(
							{
								'id':$(this.files),
								//'data_target':$('#clone-preview-'+get_no),
								'data_target':'clone-preview-'+get_no,
								'file_upload_type':data.file_upload_type,
								'upload_type':data.upload_type,
								'upload_process':'input',
								'type':'clone'
							}
						);
					});

					$('[id*="clone-preview-"]').unbind('click').click(function(event){
						//$('#clone-group').on('click', '.clone_preview', function() {
						//console.log($(this).attr('id'));
						event.preventDefault();
						event.stopPropagation();
						var get_no = $(this).attr('id').replace('clone-preview-','');

						//	console.log(this.replace('clone_preview_',''));

						$('#clone-item-'+get_no).trigger('click');

					});

					return false;
				}
			}
	});

	$('.clone-group').on('click', '.remove-clone-item', function() {	console.log(i);
		if(i !== clone_limit){
			$('#add-item').show();
		}

		//if( i > 2 ) {
				$(this).parents('.clone-data').remove();
				resetCloneIndexes();
	//	}
		return false;
	});
}

/* 	Reset Clone Index
**************************************************************************************/
function resetCloneIndexes(){

	//Set Index
  var j = 1;

	//Get Clone
  $('.clone-preview').each(function(){

		//Reset Index Clone
  	$(this).attr('id', 'clone-item_' + j);

		//Increment
    j++;

  });
}

/* 	Upper Case Words
**************************************************************************************/
function ucwords(data){

	//Set String
	var str = data;

	//Set Lowercase
	str = str.toLowerCase();

	//Split Words
	var words = str.split(' ');

	//Set String Empty
	str = '';

	//Loop Words
	for(var i = 0;i < words.length;i++){

		//Set Word
		var word = words[i];

		//Convert Uppercase By Word
		word = word.charAt(0).toUpperCase() + word.slice(1);

		//If String More Than Zero
		if (i > 0) { str = str + ' '; }

		//String Equal to Word
		str = str + word;

	}

	//Return COnvert Word
	return str;

}
