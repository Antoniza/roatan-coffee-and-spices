$('#desktop').click(function () {
  $('.menu-item').toggleClass('hideMenuList');
  $('.sideBar').toggleClass('changeMenuSize');
});

$('#mobile').click(function () {
  $('.sideBar').toggleClass('showMenu');
  $('.backdrop').toggleClass('showBackdrop');
  $('.sideBar').removeClass('changeMenuSize');
  $('.menu-item').removeClass('hideMenuList');
});

$('.cross-icon').click(function () {
  $('.sideBar').toggleClass('showMenu');
  $('.backdrop').toggleClass('showBackdrop');
});

$('.backdrop').click(function () {
  $('.sideBar').removeClass('showMenu');
  $('.backdrop').removeClass('showBackdrop');
});

$('.menu-item').click(function (e) {
  $('li').removeClass('menu-selected');
  $('.menu-item').toggleClass('hideMenuList');
  $(this).closest('li').addClass('menu-selected');
  $('.sideBar').toggleClass('changeMenuSize');
  $('.backdrop').removeClass('showBackdrop');

  e.preventDefault();
  $('.data-container').load($(this).attr('href'));
});

$('.icon-menu-item').click(function (e) {
  $('li').removeClass('menu-selected');
  $(this).closest('li').addClass('menu-selected');

  e.preventDefault();
  $('.data-container').load($(this).attr('href'));
});

$('.menu-item.logout_button').click(function (e) {
  $('li').removeClass('menu-selected');
  $(this).closest('li').addClass('menu-selected');

  e.preventDefault();
  window.location.href = '/dashboard';
});

// * MODAL HANDLE
$('.modal-shadow').click(function (){
  $('.modal').removeClass('show');
  $(this).removeClass('show');
})

$('.cancel-button').click(function () {
  $('.modal').removeClass('show');
  $('.modal-shadow').removeClass('show');
});

// * DARK MODE HANDLER

$('.theme-button').click(function () {
  $('.sideBar').toggleClass('dark');
  $('.data-container').toggleClass('dark');
  $('header').toggleClass('dark');
  $('.light-theme').toggleClass('hide');
  $('.dark-theme').toggleClass('hide');
});

// * OPEN SIDEBAR WITH RIGHT CLICK

$(document).on("contextmenu", "body", function (e) {
  e.preventDefault();
  $('.menu-item').toggleClass('hideMenuList');
  $('.sideBar').toggleClass('changeMenuSize');
});

// * SHORTCUTS SETTINGS

$(document).bind('keydown', 'F1', function (e) {
  e.preventDefault();
  $('#clients-modal').toggleClass('show');
  $('.modal-shadow').toggleClass('show');
});

$(document).bind('keydown', 'esc', function () {
  $('.data-container').load($(location).attr('href', 'dashboard'));
});