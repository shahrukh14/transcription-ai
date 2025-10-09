(function (window, undefined) {
  'use strict';
  flatpickr('.flatpickr-input',{
    dateFormat: "d-m-Y",
    });
    flatpickr('.flatpickr-time',{
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
    });
})(window);

$(document).ready(function(){


});

