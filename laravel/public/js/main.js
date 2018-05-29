var transition_imgs_directory = 'images/transition/';
var transition_imgs = [];
var transition_index = 0;
var transition_imgs_count = 0;
var transition_state = true;
var transition_fade = 2000;
var transition_delay = 3000;

function get_transition_imgs()
{
	var transition_imgs_directory = 'images/transition/';
    $.ajax({
        async: false,
        data: ({dir: transition_imgs_directory}),
        dataType: 'json',
        url: 'GetTransitionImgs',
        success: function(images){
            console.log(images);
            $.each(images, function(index, img){
                transition_imgs.push(img);
                transition_imgs_count++;
            });
            transition_imgs_count--;
        },
        error: function(images){
            console.log(images);
        },
        always: function(images)
        {
            console.log(images);
        }
    });
    $('#transition-fnt').css('background-image', 'url("' + transition_imgs_directory + transition_imgs[0] + '")');
	$('#transition-bck').css('background-image', 'url("' + transition_imgs_directory + transition_imgs[0] + '")');
}

function transition_effect()
{
	transition_index++;
	if(transition_index > transition_imgs_count)
		transition_index = 0;
	if(transition_state)
	{
		$('#transition-bck').css('background-image', 'url("' + transition_imgs_directory + transition_imgs[transition_index] + '")');
		$('#transition-fnt').fadeOut(transition_fade, function(){
			$('#transition-fnt').css('z-index', '-2');
			$('#transition-bck').css('z-index', '-1');
		});
		$('#transition-bck').fadeIn(transition_fade, function(){
			setTimeout(function(){ transition_effect(); }, transition_delay);
		});
	}
	else
	{
		$('#transition-fnt').css('background-image', 'url("' + transition_imgs_directory + transition_imgs[transition_index] + '")');
		$('#transition-bck').fadeOut(transition_fade, function(){
			$('#transition-bck').css('z-index', '-2');
			$('#transition-fnt').css('z-index', '-1');
		});
		$('#transition-fnt').fadeIn(transition_fade, function(){
			setTimeout(function(){ transition_effect(); }, transition_delay);
		});
	}
	transition_state = !transition_state;
}

function fill_date()
{
	for(var i = 1; i <= 30; i++)
	{
		$('.date-container .day').append('<option value=' + i + '>' + i + '</option>');
	}
	var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
	for(var i = 1; i <= 12; i++)
	{
		$('.date-container .month').append('<option value=' + i + '>' + months[i - 1] + '</option>');
	}
	var currentyear = (new Date).getFullYear();
    var lastyear = 1900;
	for(var i = lastyear; i <= currentyear; i++)
	{
		$('.date-container .year').append('<option value=' + i + '>' + i + '</option>');
	}
	$('.date-search').on('change', function(){
		if($(this).val().length == 0)
		{
			var areothersempity = true;
			$('.date-search').each(function(){
				if($(this).val().length != 0)
				{
					areothersempity = false;
				}				
			});
			if(!areothersempity)
			{
				$('.date-search').prop('required', true);
			}
			else
			{
				$('.date-search').prop('required', false);
			}
		}
		else
		{
			$('.date-search').prop('required', true);
		}
	});
	$('#search-form input:radio').on('click', function(){
		if($(this).val() == 'content')
		{
			$('.date-search').prop('disabled', false);
		}
		else
		{
			$('.date-search').prop('disabled', true);
		}
	});
}

function prepare_file_inputs()
{
	$('.file-container input:text').on('keydown paste', function(e){
        e.preventDefault();
    });
	$('.file-container input:text').on('click', function(){ $(this).siblings('input:file').trigger('click'); });
	$('.file-container input:file').on('change', function(event){ $(this).siblings().val(event.target.files[0].name); });
}

function prepare_file_btn_inputs()
{
	$('.btn-input-file-container button').on('click', function(){ $(this).siblings('input:file').trigger('click'); });
}

var in_popup = false;

function close_all_popups(element)
{
	$('.popup').not(element).each(function(){
		$(this).css('display', 'none');
		$(this).data('state', 0);
	});
}

function prepare_popups()
{
	$('.popup-trigger').on('click', function(){
		var target = $(this).data('target');
		close_all_popups(target);
		var state = $(target).data('state');
		if(state)
		{
			$(target).css('display', 'none');
			$(target).data('state', 0);
			$('body').css('overflow', 'auto');
		}
		else
		{
			$(target).css('display', 'block');
			$(target).data('state', 1);
			$('body').css('overflow', 'hidden');
		}
	});
	$('.popup').on('click', function(){
		if(!in_popup)
		{
			$(this).css('display', 'none');
			$(this).data('state', 0);
			$('body').css('overflow', 'auto');
		}
	});
	$('.popup-content').on('mouseenter', function(){
		in_popup = true;
	});
	$('.popup-content').on('mouseleave', function(){
		in_popup = false;
	});
}

$(document).ready(function(){
	get_transition_imgs();
	transition_effect();
	fill_date();
	prepare_file_inputs();
	prepare_file_btn_inputs();
	prepare_popups();

	/*************************************************/
	/********************PETITIONS********************/
	/*************************************************/
	$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
	
	$('#login-form').on('submit', function(event){
		event.preventDefault();
		var login_form = $(this);
		var state = login_form.data('state');
		if(state == 0)
		{
			login_form.data('state', 1);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url:'login',
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					console.log(response);
					if(response.success == false)
					{
						if(response.found == false)
						{
							$('#login-form .msg-request').css('display', 'block');
							$('#login-form .msg-request').html('No existe tal cuenta');
							setTimeout(function(){ $('#login-form .msg-request').css('display', 'none'); }, 5000);
							login_form.data('state', 0);
						}
						else if(response.found == true)
						{
							if(response.active == true)
							{
								$('#login-form .msg-request').css('display', 'block');
								$('#login-form .msg-request').html('Contraseña incorrecta');
								setTimeout(function(){ $('#login-form .msg-request').css('display', 'none'); }, 5000);
							login_form.data('state', 0);
							}
							else if(response.active == false)
							{
								$('#login-form .msg-request').css('display', 'block');
								$('#login-form .msg-request').html('Cuenta temporalmente baneada');
								setTimeout(function(){ $('#login-form .msg-request').css('display', 'none'); }, 5000);
							login_form.data('state', 0);
							}
						}
					}
					else if(response.success == true)
					{
						if(response.found == true)
						{
							if(response.active == true)
							{
								if(response.user_type == 1)
								{
									window.location.href = 'admin';
								}
								else
								{
									window.location.href = 'perfil';
								}
							}
						}
					}
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	$('#register-form').on('submit', function(event){
		event.preventDefault();
		var register_form = $(this);
		var state = register_form.data('state');
		if(state == 0)
		{
			register_form.data('state', 1);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url:'register',
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					console.log(response);
					if(response.success == false)
					{
						$('#register-form .msg-request').css('display', 'block');
						$('#register-form .msg-request').html('Ya existe una cuenta con el correo: ' + response.found);
						setTimeout(function(){ $('#register-form .msg-request').css('display', 'none'); }, 5000);
						register_form.data('state', 0);
					}
					else
					{
						window.location.href = 'perfil';
					}
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	$('#photo-profile-change input:file').on('change', function(){
		$('#photo-profile-change').trigger('submit');
	});
	$('#photo-profile-change').on('submit', function(event){
		event.preventDefault();
		var formData = new FormData(this);
		jQuery.ajax({
			data: formData,
			dataType: 'json',
			url:'change_profile',
			type:'POST',
			cache: false,
	        contentType: false,
	        processData: false,
			beforeSend: function()
			{

			},
			success: function(response)
			{
				console.log(response);
				$('.profile-user').css('background-image', "url('data:image/jpeg;base64,"+response.image+"')");
				$('.user-profile').css('background-image', "url('data:image/jpeg;base64,"+response.image+"')");
			},
			error: function(response)
			{
				console.log(response);
			},
			complete: function()
			{
				console.log('complete');
			}
		});
	});
	$('#photo-background-change input:file').on('change', function(){
		$('#photo-background-change').trigger('submit');
	});
	$('#photo-background-change').on('submit', function(event){
		event.preventDefault();
		var formData = new FormData(this);
		jQuery.ajax({
			data: formData,
			dataType: 'json',
			url:'change_background',
			type:'POST',
			cache: false,
	        contentType: false,
	        processData: false,
			beforeSend: function()
			{

			},
			success: function(response)
			{
				console.log(response);
				$('.background-user').css('background-image', "url('data:image/jpeg;base64,"+response.image+"')");
			},
			error: function(response)
			{
				console.log(response);
			},
			complete: function()
			{
				console.log('complete');
			}
		});
	});
	$('#upload-form').on('submit', function(event){
		event.preventDefault();
		var upload_form = $(this);
		var state = upload_form.data('state');
		if(state == 0)
		{
			upload_form.data('state', 1);

			var now = new Date();
			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);
			var today = now.getFullYear()+"-"+(month)+"-"+(day);
			$('.date-ipt').val(today);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url:'upload_video',
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					console.log(response);
					if(response.success == true)
					{
						var target = '#video-upd-status';
						close_all_popups(target);
						var state = $(target).data('state');
						if(state)
						{
							$(target).css('display', 'none');
							$(target).data('state', 0);
							$('body').css('overflow', 'auto');
						}
						else
						{
							$(target).css('display', 'block');
							$(target).data('state', 1);
							$('body').css('overflow', 'hidden');
						}
						var back01 = '"background-image: url(';
						var back02 = "'data:image/jpeg;base64," + response.image + "');";
						var back03 = '"';
						var back04 = back01 + back02 + back03;
						$('#shared > .row').append(
							"<div class='col-xs-12 col-sm-4 col-md-3'>"+
							"<div class='video'>"+
							'<a class="video-img" href="/view/' + response.id + '" style=' + back04 + '>'+
							"<span class='icon-controller-play'></span>"+
							"</a>"+
							"<div class='video-info'>"+
							"<p class='video-title'>" + response.title + "</p>"+
							"<p class='video-user'>Por: " + response.user_name + "</p>"+
							"<p class='video-video-info'><span class='icon-eye'></span> " + response.views + "</p>"+
							"</div>"+
							"</div>"+
							"</div>"
						);
						upload_form.data('state', 0);
						$('#upload-form')[0].reset();
					}
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	var bannedvpage = 1;
	$(document).on('click', '.bannedvideos .pagination a', function(event)
	{
		event.preventDefault();
		bannedvpage = $(this).attr('href').split('page=')[1];
		$.ajax({
			url: '/admin',
			data: {page: bannedvpage, method: 0},
			type: 'GET',
			dataType: 'json',
			success: function(response)
			{
				$('.bannedvideos').html(response);
				console.log(response);
			}
		});
	});
	$(document).on('click', '.remove-ban', function(){
		var idvideo = $(this).data('value');
		$.ajax({
			url: '/removebanvideo',
			data: {idvideo: idvideo, bannedvpage: bannedvpage, method: 0},
			type: 'POST',
			dataType: 'json',
			success: function(response)
			{
				$('.bannedvideos').html(response);
				console.log(response);
			}
		});
	});
	var bannedupage = 1;
	$(document).on('click', '.bannedusers .pagination a', function(event)
	{
		event.preventDefault();
		bannedupage = $(this).attr('href').split('page=')[1];
		$.ajax({
			url: '/admin',
			data: {page: bannedupage, method: 1},
			type: 'GET',
			dataType: 'json',
			success: function(response)
			{
				$('.bannedusers').html(response);
				console.log(response);
			}
		});
	});
	$(document).on('click', '.remove-user-ban', function(){
		var idvideo = $(this).data('value');
		$.ajax({
			url: '/removebanuser',
			data: {idvideo: idvideo, bannedupage: bannedupage},
			type: 'POST',
			dataType: 'json',
			success: function(response)
			{
				$('.bannedusers').html(response);
				console.log(response);
			}
		});
	});
	$('#like-form').on('submit', function(event){
		event.preventDefault();
		var like_form = $(this);
		var state = like_form.data('state');
		if(state == 0)
		{
			like_form.data('state', 1);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url: likeAjax,
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					if(response.success == true)
					{
						if(response.method == 0)
						{
							$('#like').css('color', '#AAAAAA');
						}
						else
						{
							$('#like').css('color', '#4285f4');
						}
						$('#like').siblings().html(response.likes);
						$('#like-form > .method').val(response.method);
						like_form.data('state', 0);
					}
					console.log(response);
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	$('#fav-form').on('submit', function(event){
		event.preventDefault();
		var fav_form = $(this);
		var state = fav_form.data('state');
		if(state == 0)
		{
			fav_form.data('state', 1);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url: favAjax,
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					if(response.success == true)
					{
						if(response.method == 0)
						{
							$('#fav').css('color', '#AAAAAA');
						}
						else
						{
							$('#fav').css('color', '#fa8072');
						}
						$('#fav-form > .method').val(response.method);
						fav_form.data('state', 0);
					}
					console.log(response);
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	$('#follow-form').on('submit', function(event){
		event.preventDefault();
		var follow_form = $(this);
		var state = follow_form.data('state');
		if(state == 0)
		{
			follow_form.data('state', 1);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url: followAjax,
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					if(response.success == true)
					{
						if(response.method == 0)
						{
							$('#foll').css('color', '#AAAAAA');
						}
						else
						{
							$('#foll').css('color', '#4285f4');
						}
						$('#follow-form > .method').val(response.method);
						follow_form.data('state', 0);
					}
					console.log(response);
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	var page = 1;
	var order = 0;
	var rendercommentsAjax = rendercommentsLastAjax;
	$('#comment-form').on('submit', function(event){
		event.preventDefault();
		var comment_form = $(this);
		var state = comment_form.data('state');
		if(state == 0)
		{
			comment_form.data('state', 1);

			var now = new Date();
			var day = ("0" + now.getDate()).slice(-2);
			var month = ("0" + (now.getMonth() + 1)).slice(-2);
			var today = now.getFullYear()+"-"+(month)+"-"+(day);
			$('.comment-date').val(today);
			$('.latest_page').val(page);
			$('.comments-order').val(order);
			var formData = new FormData(this);
			jQuery.ajax({
				data: formData,
				dataType: 'json',
				url: commentAjax,
				type:'POST',
				cache: false,
		        contentType: false,
		        processData: false,
				beforeSend: function()
				{

				},
				success: function(response)
				{
					$('.comments-section').html(response);
					$('#comment-form textarea').val('');
					comment_form.data('state', 0);
					console.log(response);
				},
				error: function(response)
				{
					console.log(response);
				},
				complete: function()
				{
					console.log('complete');
				}
			});
		}
	});
	$(document).on('click', '.comments-section .pagination a', function(event)
	{
		event.preventDefault();
		page = $(this).attr('href').split('page=')[1];
		$.ajax({
			url: rendercommentsAjax,
			data: {page: page},
			type: 'GET',
			dataType: 'json',
			success: function(response)
			{
				$('.comments-section').html(response);
				console.log(response);
			}
		});
	});
	$(document).on('click', '.btn-cmt-order', function(){
		var btn_order = $(this);
		var state = btn_order.data('state');
		if(state == 0)
		{
			btn_order.data('state', 1);
			if(order == 0)
			{
				order = 1;
				rendercommentsAjax = rendercommentsFirstAjax;
			}
			else
			{
				order = 0;
				rendercommentsAjax = rendercommentsLastAjax;
			}
			$.ajax({
				url: rendercommentsAjax,
				data: {page: page},
				type: 'GET',
				dataType: 'json',
				success: function(response)
				{
					$('.comments-section').html(response);
					btn_order.data('state', 0);
					if(order == 1)
					{
						btn_order.html('mas viejos a mas recientes');
					}
					else
					{
						btn_order.html('mas recientes a mas viejos');
					}
					console.log(response);
				}
			});
		}
	});
});