/**
 * Description
 */

/*global hoge: true*/

// Enable menu
jQuery(document).ready(function ($) {
  // Sidenav
  $('.button-collapse').sideNav();
  // Toggle
  $('a.toggle-button').click(function(e){
    e.preventDefault();
    $($(this).attr('href')).toggleClass('in');
  });

  // video
  var resizeVideo = function(){
    $('.youtube-bg').each(function(){
      var $video = $(this).find('iframe');
      var width = $video.attr('data-width');
      var height = $video.attr('data-height');
      var maxWidth = $(this).width();
      var maxHeight = $(this).height();
      var finalWidth, finalHeight;
      var xRatio = maxWidth / width;
      var yRatio = maxHeight / height;
      if ( xRatio > yRatio ) {
        // Horizontal
        finalWidth  = maxWidth;
        finalHeight = Math.ceil(height / width * maxWidth);
      }else{
        // Vertical
          finalHeight = maxHeight;
          finalWidth  = Math.ceil(width / height * maxHeight);
      }
      $video.width(finalWidth);
      $video.height(finalHeight);
    });
  };
  resizeVideo();
  var timer = null;
  $(window).resize(function(){
    if(timer){
      clearTimeout(timer);
    }
    timer = setTimeout( resizeVideo, 10 );
  });

  // Share link
  $('a.fb-share-link').click(function(e){
    e.preventDefault();
    try{
      FB.ui({
        method: 'share',
        href: $(this).attr('href')
      }, function(response){});
    }catch(e){}
  });

  // Match height
  $( '.front-cards-row .col p' ).matchHeight();
  $( '.license-item-title' ).matchHeight();
  $( '.license-item-desc' ).matchHeight();
  $('.product-notice-title').matchHeight();
});
