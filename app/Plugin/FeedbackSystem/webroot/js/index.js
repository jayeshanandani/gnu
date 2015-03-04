$(function() {
  $('.draggable').draggable({ cursor: 'crosshair', revert: 'invalid'});
  $('#drop').droppable({ accept: '.draggable', 
           drop: function(event, ui) {
                    console.log('drop');
                   $(this).removeClass('border').removeClass('over');
             var dropped = ui.draggable;
            var droppedOn = $(this);
                 
             
             
                }, 
          over: function(event, elem) {
                  $(this).addClass('over');
                   console.log('over');
          }
                ,
                  out: function(event, elem) {
                    $(this).removeClass('over');
                  }
                     });
$('#drop').sortable();

$('#origin').droppable({ accept: '.draggable', drop: function(event, ui) {
                    console.log('drop');
                   $(this).removeClass('border').removeClass('over');
             var dropped = ui.draggable;
            var droppedOn = $(this);
                 
             
             
                }});
});

