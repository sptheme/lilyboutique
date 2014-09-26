var $ = jQuery.noConflict();

// Detect Mobile Touch Support
var touchSupport = false;
var eventClick = 'click';
var eventHover = 'mouseover mouseout';

(function($){
  if ('ontouchstart' in document.documentElement) {
    $('html').addClass('touch');
    touchSupport = true;
    eventClick = 'touchon touchend';
    eventHover = 'touchstart touchend';
  } else {
    $('html').addClass('no-touch');
  }
})(jQuery); 



jQuery(document).ready(function($) {

  // Hover plus icon sub-menu  
  $('.mobile-menu-trigger').bind( eventHover, function(event) {
    $(this).toggleClass('hover');    
  });

  /*--------------------------------------------------------------------------------------*/
  /*  Primary navigation
  /*--------------------------------------------------------------------------------------*/
  $('.primary-nav li.menu-item-has-children a').click(function(event) {
    event.preventDefault();
    var $this = $(this);
      var ul = $this.next('ul');
      var ulChildrenHeight = ul.children().length * 25;

      if(!$this.parent().hasClass('active')){
        $this.parent().toggleClass('active');
        ul.toggleClass('active');
        ul.height(ulChildrenHeight + 'px');
      } else {
        $this.parent().toggleClass('active');
        ul.toggleClass('active');
        ul.height(0);
      }
  });

  /* Auto expend for current menu items */ 
  var $navItems = $('.primary-nav ul li');

  $navItems.each(function(index){
    if ($(this).hasClass('current-menu-item')) {
      $parentUl = $(this).parent();
      $parentUl.height($parentUl.children('li').length * 25 + "px");
      $parentUl.parent().addClass('active');
    }
  });

  /* Sidebar Functionality */
  
  var opened = false;
  $('#menu-trigger').bind(eventClick, function(event) {
    if(opened){
      opened = false;
      $(this).removeClass('active');
      setTimeout(function() {
        $('#side-logo').removeClass('active');
        $('#sidemenu-container').removeClass('active');
      }, 500);
    } else {
      $(this).addClass('active');
      setTimeout(function() {
        $('#side-logo').addClass('active');
        $('#sidemenu-container').addClass('active');
        opened = true;
      }, 500);
    }
  });

});