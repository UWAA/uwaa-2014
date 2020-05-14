$("#search").keyup(function() {
    var filter = $(this).val(),
      count = 0;
    $('div.flip-card-front').each(function() {
      if ($(this).text().search(new RegExp(filter, "i")) < 0) {
        $(this).closest('div.flip-card').hide();
      } else {
        $(this).closest('div.flip-card').show();
        count++;
      }
    });
});