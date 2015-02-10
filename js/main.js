$(document).ready(function() {
  var navigationLinks = $('.links').children().children();

  $(navigationLinks).each(function(key, value) {

    $(value).on('click', function(e) {
      $('.slide').removeClass('active');
      $(navigationLinks).removeClass('chosen');

      $(this).addClass('chosen');
      $('#' + $(this).attr('id') + '-slide').addClass('active');
    });

  });
});
