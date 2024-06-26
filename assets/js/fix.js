/* Accessability */
$(".sr-only:not(d-none)").addClass("d-none");
$(".skip-block:not(d-none)").addClass("d-none");
/* Menu Link */ 
$(".menu-link").each(function(e) {
	var ya = $(this).find('.hokage-menu-icon');
	var href = $(this).attr('href');
	if (ya.length != 0){
		/* Admin */
		if (href.includes('admin')){
			ya.addClass("ki-solid ki-setting-2 fs-2");
		}
		/* My (Dashboard) */
		else if (href.includes('my')){
			if (href.includes('courses')){
				ya.addClass("ki-solid ki-book fs-2");
			} else {
				ya.addClass("ki-solid ki-element-11 fs-2");
			}
		} else {
			ya.attr("class", "ki-solid ki-home fs-2");
		}
	}
});
/* User Avatar */
$(".userpicture").addClass("m-auto rounded-circle");
$(".userinitials").addClass("m-auto rounded-circle");
/* Button */
$(".btn:not(btn-sm)").addClass("btn-sm");
/* Form */
$('.form-control:not(.form-control-sm)').addClass('form-control-sm');
/* Table */
$("table.flexible:not(.table-bordered)").addClass("table-bordered");
$(".table-bordered").addClass("table-rounded table-striped border");
$("#prev-activity-link.btn-link").removeClass("btn-link");
$("#next-activity-link:btn-link").removeClass("btn-link");
$("#prev-activity-link:not(btn-sm)").addClass("btn-sm");
$("#next-activity-link:not(btn-sm)").addClass("btn-sm");