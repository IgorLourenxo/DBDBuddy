$(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
  
  $("img").on("dragstart", function(event) {
    event.preventDefault();
  });
  