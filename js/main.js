$(document).ready(function(){

	var inDrops = false;
	var inPop = false;
	var inForm = false;

/************************************************/
/************************************************/
/**********************MENU**********************/
/************************************************/
/************************************************/

	function openMenu(){
		$(".menu-btn").data("state", 1);
		$(".menu-cont").css("z-index", "99");
		$(".menu").animate({ "width": "250px" }, 200);
	};
	function closeMenu(){
		$(".menu-btn").data("state", 0);
		$(".menu").animate({ "width": "0px" }, 200, function(){ $(".menu-cont").css("z-index", "-100"); });
	};

	$(".menu-btn").click(function(){
		var state = $(this).data("state");
		if(state === 0)
		{
			openMenu();
		}
		else
		{
			closeMenu();
			closeDrops();
		}
	});
	$(".menu-close").click(function(){
		closeMenu();
		closeDrops();
	});
	$(window).resize(function(){
		closeMenu();
		closeDrops();
	});

/*********************************************************/
/*********************************************************/
/**********************SCROLL EFFECT**********************/
/*********************************************************/
/*********************************************************/

	$(window).scroll(function(){
		var scroll_top = $(this).scrollTop();
		var back_position = scroll_top * 0.25;
		$(".wrapper").css("background-position", "0px " + back_position + "px");
	});

/*************************************************/
/*************************************************/
/**********************DROPS**********************/
/*************************************************/
/*************************************************/

	function closeDrops()
	{
		$(".drop-title").each(function(){
			$(this).find("span").css("transform","rotate(0deg)");
			$(this).siblings(".drop-options").css("display","none");
			$(this).parent().css("background-color", "transparent");
			$(this).parent().data("child", 0);
			$(this).parent().data("state", 0);
		});
	};

	function closeDropsNot(element)
	{
		var parent = $(element).parent().parent().closest(".drop").data("child");

		$(".drop-title").not(element).each(function(){
			if(parent == null)
			{
				$(this).find("span").css("transform","rotate(0deg)");
				$(this).siblings(".drop-options").css("display","none");
				$(this).parent().css("background-color", "transparent");
				$(this).parent().data("child", 0);
				$(this).parent().data("state", 0);
			}
			else
			{
				var child = $(this).parent().data("child");
				if(child === 0)
				{
					$(this).find("span").css("transform","rotate(0deg)");
					$(this).siblings(".drop-options").css("display","none");
					$(this).parent().css("background-color", "transparent");
					$(this).parent().data("child", 0);
					$(this).parent().data("state", 0);
				}
			}
		});
	};

	$(".drop-title").click(function(){
		var state = $(this).parent().data("state");
		if(state === 0)
		{
			$(this).find("span").css("transform","rotate(90deg)");
			$(this).siblings(".drop-options").css("display","block");
			$(this).parent().parent().closest(".drop").data("child", 1);
			$(this).parent().css("background-color", "#EEEEEE");
			$(this).parent().data("state", 1);
			closeDropsNot(this);
		}
		else
		{
			$(this).find("span").css("transform","rotate(0deg)");
			$(this).siblings(".drop-options").css("display","none");
			$(this).parent().parent().closest(".drop").data("child", 0);
			$(this).parent().css("background-color", "transparent");
			$(this).parent().data("child", 0);
			$(this).parent().data("state", 0);
		}
	});

	$(".drop-title").mouseenter(function(){
		inDrops = true;
	});

	$(".drop-title").mouseleave(function(){
		inDrops = false;
	});

	$(".cont-menu").click(function(){
		if(inDrops === false)
		{
			closeDrops();
		}
	});

/**************************************************/
/**************************************************/
/**********************POP-UP**********************/
/**************************************************/
/**************************************************/

	$(".pop-open").click(function(){
		$(".pop-cont").css("display", "flex");
	});

	$(".pop-close").click(function(){
		$(".pop-cont").css("display", "none");
	});

	$(".pop").mouseenter(function(){
		inPop = true;
	});

	$(".pop").mouseleave(function(){
		inPop = false;
	});

	$(".pop-cont").click(function(){
		if(inForm === false)
		{
			$(this).css("display", "none");
		}
	});

/******************************************************/
/******************************************************/
/**********************FORM LOGIN**********************/
/******************************************************/
/******************************************************/

	$(".form-log-open").click(function(){
		$(".form-log-cont").css("display", "flex");
	});

	$(".form-log-close").click(function(){
		$(".form-log-cont").css("display", "none");
	});

	$(".form-log").mouseenter(function(){
		inForm = true;
	});

	$(".form-log").mouseleave(function(){
		inForm = false;
	});

	$(".form-log-cont").click(function(){
		if(inForm === false)
		{
			$(this).css("display", "none");
		}
	});

/****************************************************/
/****************************************************/
/**********************FORM REG**********************/
/****************************************************/
/****************************************************/

	$(".form-reg-open").click(function(){
		$(".form-log-cont").css("display", "none");
		$(".form-reg-cont").css("display", "flex");
	});

	$(".form-reg-close").click(function(){
		$(".form-reg-cont").css("display", "none");
	});

	$(".form-reg").mouseenter(function(){
		inForm = true;
	});

	$(".form-reg").mouseleave(function(){
		inForm = false;
	});

	$(".form-reg-cont").click(function(){
		if(inForm === false)
		{
			$(this).css("display", "none");
		}
	});

});