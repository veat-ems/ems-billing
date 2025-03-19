$(function() {
  $('.slide:gt(0)').hide();
  setInterval(function() {
    $('.slide:first').fadeOut('slow').next().fadeIn('slow').end().appendTo('.slider');
  }, 4000)
});