
//search event listener
$(document).ready(function() {
  $("button[type='submit']").click(function(event) {
      event.preventDefault(); // Prevent the form from submitting normally
      var collegeName = $("input[name='collegeName']").val();
$.ajax({
  type: "POST",
  url: "src/php/search-collegelist.php",
  data: { search: collegeName },
  success: function(data) {
      $("#collegelistTableBody").html(data);
  }
});
  });
});
//row event listener
$(document).ready(function() {
  const numRowsSelect = $('#num_rows_select');
  numRowsSelect.change(function() {
      const limit = this.value;
      const url = `src/php/fetch-collegelist.php?limit=${limit}`;
      $.get(url, function(data) {
          $('#collegelistTableBody').html(data);
      });
  });
});
function goToCollegeSite(collegeName,ID) {
    window.location.href = `src/php/collegeSite.php?name=${encodeURIComponent(collegeName)}&id=${encodeURIComponent(ID)}`;
}

$(document).ready(function() {
  // Add mouseover effect to destination boxes
  $('.destination').mouseover(function() {
    $(this).css('border', '2px solid #0066cc');
  });
  $('.destination').mouseout(function() {
    $(this).css('border', 'none');
  });
});

