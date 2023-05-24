$('#closeStatePanel').on('click', function(){
    $(".information").removeClass('show');
    $(".information").addClass('hide');
})

$('.state-hidden').on('click', function(){
    $(".information").removeClass('hide');
    $(".information").addClass('show');
})

$(document).bind('keydown', 'shift+i', function (e) {
    e.preventDefault();
    $(".information").removeClass('hide');
    $(".information").addClass('show');
  });