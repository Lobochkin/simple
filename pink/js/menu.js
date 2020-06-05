'use strict';

(function () {
  var navMain = document.querySelector('.main-nav');
  var navToggle = document.querySelector('.page-header__toggler');
  var pageHeader = document.querySelector('.page-header');

  navToggle.classList.remove('page-header__toggler--no-js');

  navToggle.addEventListener('click', function() {
    if (navMain.classList.contains('main-nav--closed')) {
      navMain.classList.remove('main-nav--closed');
      navToggle.classList.remove('page-header__toggler--open');
      pageHeader.classList.remove('page-header--close-menun');
    } else {
      navMain.classList.add('main-nav--closed');
      navToggle.classList.add('page-header__toggler--open');
      pageHeader.classList.add('page-header--close-menun');
    }
  });
})();
