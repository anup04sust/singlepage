/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var nc = jQuery.noConflict();

function fullScreenSlider() {
    var winWidth = nc(window).width();
    var winHeight = nc(window).height();
    nc('#fullSlider .slide > img,#fullSlider .slider-caption').css({
        height: winHeight,
        width: 'auto'
    });
}
nc(window).load(function () {
    "use strict";
    nc('#fullSlider').flexslider({
        directionNav: 0,
        start: function (slider) {
            nc(slider).parent().removeClass('loadding');
            nc(slider).css('visibility', 'visible')
        },
    });
    nc('#fullSlider .flex-control-paging').wrapAll('<div class="flex-control-wrap" />').wrapAll('<div class="container" />');
});
nc(document).ready(function () {
    "use strict";
    fullScreenSlider();
    nc("#header").affix({
        offset: {
            top: 35,
        }
    })
});
nc(window).on('resize', function () {
    "use strict";
    fullScreenSlider();
});
/*
 $(window).load(function() {
 $('#mainSlider').flexslider({
 //animation: 'slide',
 directionNav: 0
 });
 
 //for slider second
 $('#blockSlider4').flexslider({
 //animation: 'slide',
 directionNav: 0
 });	
 //	$('.flex-control-nav1').wrapAll('<div class="flex-control-wrap1" />').wrapAll('<div class="container1" />');
 $('.flex-control-nav').each(function() {
 $(this).wrapAll('<div class="flex-control-wrap" />').wrapAll('<div class="container" />');
 });
 });
 function fullScreenSlider() {
 var winWidth = $(window).width();
 var winHeight = $(window).height();
 $('#mainSlider img, .slider-caption').css({
 height: winHeight,
 width: 'auto'	
 });
 $('#blockSlider4 li img, .slider-caption').css({
 height: winHeight,
 width: 'auto'	
 });
 }
 $(document).ready(function() {
 fullScreenSlider();
 // sticky header
 $(window).scroll( function() {
 var height = $(window).scrollTop();
 $('header[role="heading"]').removeClass('sticky');
 
 if(height > 20) {
 $('header[role="heading"]').addClass('sticky');
 } else {
 $('header[role="heading"]').removeClass('sticky');			
 }
 
 });
 $('.scrollDown').click(function() {
 $("html, body").animate({
 scrollTop: $('#content').offset().top
 }, 1000);
 });
 
 });
 
 $(window).resize(fullScreenSlider);
 
 function jumpOrScrollTo(anchor) {
 var anchor = '#' + anchor;
 return function() {
 if (!$(anchor).length) {
 window.location = '/' + anchor;
 } else {
 $('html, body').animate({
 scrollTop: parseInt($(anchor).offset().top)
 }, 1000);
 $('button').removeClass('collapsed');
 $('.main-navigation').removeClass('in');
 }
 }
 }
 
 jQuery(document).ready(function() {
 var offset = 220;
 var duration = 500;
 
 jQuery(window).scroll(function() {
 if (jQuery(this).scrollTop() > offset) {
 jQuery('.back-to-top').fadeIn(duration);
 } else {
 jQuery('.back-to-top').fadeOut(duration);
 }
 });
 
 jQuery('.back-to-top').click(function(event) {
 event.preventDefault();
 jQuery('html, body').animate({scrollTop: 0}, duration);
 return false;
 });			
 
 jQuery('ul li a#menu-contact, .mobile-menu > ul li a#menu-contact').bind('click',jumpOrScrollTo('get-in-touch'));
 
 jQuery('ul li a#menu-team, .mobile-menu > ul li a#menu-team').bind('click',jumpOrScrollTo('our-team'));
 
 $('.main-navigation li').hover(
 function(){
 $(this).addClass('open')	
 },
 function(){
 $(this).removeClass('open')	
 });
 
 $(window).scroll(function(){
 if($(window).scrollTop()>0){
 $('body').addClass('shadow');
 } else {
 $('body').removeClass('shadow');
 }
 });
 
 });
 */