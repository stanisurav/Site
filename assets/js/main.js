$(document).ready(function() {

    // Всплывающее окно для аватарки
    $('button.myLinkModal').click(function(event) {
        event.preventDefault();
        $('#myOverlay').fadeIn(297, function() {
            $('#myModal')
                .css('display', 'block')
                .animate({
                    opacity: 1
                }, 198);
        });
    });
    $('#myModal__close, #myOverlay').click(function() {
        $('#myModal').animate({
                opacity: 0
            }, 198,
            function() {
                $(this).css('display', 'none');
                $('#myOverlay').fadeOut(297);
            });
    });

      // Всплывающее окно, которое закроется лишь при вводе данных
          $('#myOverlayObl').fadeIn(297, function() {
              $('#myModalObl')
                  .css('display', 'block')
                  .animate({
                      opacity: 1
                  }, 198);
          });


      // Всплывающее окно для редактирования characters
      $('button#but_popap_ch').click(function(event) {
          event.preventDefault();
          $('#Overlay_ch').fadeIn(297, function() {
              $('#Modal_ch')
                  .css('display', 'block')
                  .animate({
                      opacity: 1
                  }, 198);
          });
      });
      $('#Modal_close_ch, #Overlay_ch').click(function() {
          $('#Modal_ch').animate({
                  opacity: 0
              }, 198,
              function() {
                  $(this).css('display', 'none');
                  $('#Overlay_ch').fadeOut(297);
              });
      });

      // Всплывающее окно для редактирования characters
      $('button#but_popap_m').click(function(event) {
          event.preventDefault();
          $('#Overlay_m').fadeIn(297, function() {
              $('#Modal_m')
                  .css('display', 'block')
                  .animate({
                      opacity: 1
                  }, 198);
          });
      });
      $('#Modal_close_m, #Overlay_m').click(function() {
          $('#Modal_m').animate({
                  opacity: 0
              }, 198,
              function() {
                  $(this).css('display', 'none');
                  $('#Overlay_m').fadeOut(297);
              });
      });
});
