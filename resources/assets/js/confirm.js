$(document).ready(function() {

  $('.delete').on('submit', function () {
      return confirm("Do you whant to delete this item?");
  });
});
