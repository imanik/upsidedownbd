// Global Javascript Initialization
var Custom = function() {
  'use strict';


  // Handle Promo Section
  var handleButton = function() {
    $('#yes-btn').click(function() {
        //console.log("Hello World");
      $(this).hide();
      $('#no-btn').hide();
      $('#buy-ticket-btn').removeClass('hidden');
    });

    $('#no-btn').click(function() {
        //console.log("Hello World");
      $(this).hide();
      $('#yes-btn').hide();
      $('#vaccine-reg-btn').removeClass('hidden');
    });
  }






  return {
    init: function() {
      handleButton(); // initial setup for Bootstrap Components

    }
  }
}();

$(document).ready(function() {
  Custom.init();
});
