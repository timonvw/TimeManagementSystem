var toggle = $('.burger');
var menu = $('.navbar-menu');

toggle.on('click', function(event) {
  menu.toggleClass('is-active');
});
