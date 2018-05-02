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
}

function prepare_file_inputs()
{
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
});