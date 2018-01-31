(function ($) {
$(document).ready(function() {
	
	$("div[class*='field-name-prog']").css("display","none");
	
	var images = [
		'DiagM.jpg', 
		'NCampusStairway.jpg', 
		'UMAerialsJuly15.jpg', 
		'UMAngellHall.jpg', 
		'UMAngellHallComputingCenter.jpg', 
		'UMCampusSidewalk.jpg', 
		'UMCube.jpg', 
		'UMMuseumofArt.jpg', 
		'UMtoDiag.jpg'
	];
	$('#block-block-6').css({'background-image': 'url(/sites/all/themes/bootstrap_iia/images/' + images[Math.floor(Math.random() * images.length)] + ')'});
	$(".mobilebutton").click(function(){
		$("#pagemenu").slideToggle("");
	});
	$(".mobilebutton-sub").click(function(){
		$(this).next("ul").slideToggle("");
		$(this).find(".font-icon").toggleClass("fa-times-circle");
	});

	$("div.region.region-sidebar-first.well .block-title").click(function(){
		$("div.region.region-sidebar-first.well ul.menu.nav").slideToggle("");
		$("div.region.region-sidebar-first.well .block-title").toggleClass('open');
	});
	$(window).resize(function(){
		$("div.region.region-sidebar-first.well ul.menu.nav").removeAttr("style");
	});	
	$('a.dropdown-toggle').removeAttr('data-toggle');
	$('a.dropdown-toggle').removeAttr('data-target');
	$(".region-header .globalnav").accessibleDropDown();
	$(".image-zoom").fancybox({
		'autoScale'	: false,
		'titleShow'     : true,
		'titlePosition'	: 'over',
		'onClosed'	: function() {
			$("#fancy-content").empty();
		}
	});
	$(".modal-info").fancybox({
		'type'		: 'iframe',
		'autoDimensions': false,
		'autoScale'	: false,
		'width'		: 840,
		'height'	: 640,
		'padding'	: 0,
		'scrolling'	: 'auto',
		'titleShow' : false,
		'onClosed'	: function() {
			$("#fancy-content").empty();
		}
	});
	$("a[rel=photo-gallery-zoom]").fancybox({
		'type'		: 'image',
		'titleShow' : false,
		'onClosed'	: function() {
			$("#fancy-content").empty();
		}
	});
	$(".service-center-browsers-requirements .browser-requirement-exception").hide();
	$(".service-center-browsers-requirements .browser-requirement-title").click(function() {
		$(this).next(".browser-requirement-exception").slideToggle();
		$(this).toggleClass("open");
		});

	$(".field-name-field-answer").prev().addClass("field-name-field-question-clickable");
	$(".field-name-field-answer").prev().removeClass("field-name-field-question");
	$(".field-name-field-answer").hide();
	$(".field-name-field-question-clickable").click(function() {
		$(this).next(".field-name-field-answer").slideToggle();
		$(this).toggleClass("field-name-field-question-clickable-open");
		});
	
	$(".expand-all-content").click(function() {
//		$(".field-name-field-question-clickable").toggleClass("field-name-field-question-clickable-open").next().slideToggle();
		if($(this).html()=='Expand All Content') { $(".field-name-field-question-clickable").addClass("field-name-field-question-clickable-open").next().slideDown(); } else { $(".field-name-field-question-clickable-open").removeClass("field-name-field-question-clickable-open").next().slideUp(); }
		$(this).html($(this).html() == 'Hide All Content' ? 'Expand All Content' : 'Hide All Content');
		});

//cs101 image updater script
if ($(".quiz-report-score").length) {
	//FYI, using if instead of else if here because there's a results page with all 3 images on it
	if ($("#cs1012015q3").length) {
		$("#cs1012015q3").attr("src","/sites/default/files/dropbox-phish-res.png");
	}
	if ($("#cs1012015q4").length) {
		$("#cs1012015q4").attr("src","/sites/default/files/weblogin-phish-res.png");
	}	
	if ($("#cs1012015q2").length) {
		$("#cs1012015q2").attr("src","/sites/default/files/phish-site-2015-q2-res.png");
	}		
}
//else {console.log("didn't find it");}

//$("iframe[name='googleSearchFrame']").attr("width","100%");
//$(".gs-webResult']").attr("width","100%");$("#pagemenu").accessibleDropDown();});
$.fn.accessibleDropDown = function ()
{
    var el = $(this);
    $("a", el).focus(function() {
        $(this).parents("li").addClass("hover");
    }).blur(function() {
        $(this).parents("li").removeClass("hover");
    });
}
})(jQuery);

setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0054/2162.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);