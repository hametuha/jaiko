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

  $('a.fb-share-link').click(function(e){
    e.preventDefault();
    try{
      FB.ui({
        method: 'share',
        href: $(this).attr('href')
      }, function(response){});
    }catch(e){}
  });
});
