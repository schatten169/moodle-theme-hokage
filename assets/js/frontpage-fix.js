/* Tambahan fix untuk halaman frontpage */
$("#frontpage-available-course-list").addClass("card");
$("#frontpage-available-course-list").prepend(
  '<div class="card-header bg-primary bg-opacity-75 d-flex flex-wrap flex-row align-items-center"><h3 class="card-title text-white">Beberapa course terbaru</h3></div><div class="card-body"></div><div class="card-footer text-center"></div>'
);
$("#frontpage-available-course-list .courses").first().appendTo($("#frontpage-available-course-list").children(".card-body"));
$("#frontpage-available-course-list a.btn.btn-primary.btn-md").first().appendTo($("#frontpage-available-course-list").children(".card-footer"));
/* Remove unused things */
$("#frontpage-available-course-list h1").remove();
$("#frontpage-available-course-list .landing-dark-bg").remove();