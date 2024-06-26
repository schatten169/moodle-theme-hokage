/* Tambahan fix untuk halaman dashboard */
/* My Overview */
$("#course_seemore_btn").appendTo('.block_myoverview .card .card-header');
/* Form Control */
$(".btn:not(btn-sm)").addClass("btn-sm");
$(":not(select) .form-control:not(form-control-sm)").addClass("form-control-sm");
/* Aside Section */
$("aside.block-region").append('<div class="d-flex flex-wrap flex-row w-100"><div class="col-8"></div><div class="col-4"></div></div>');
$("section.block_news_items").appendTo('aside.block-region .d-flex .col-8');
$("section.block_badges").appendTo('aside.block-region .d-flex .col-4');
$("section.block_starredcourses").appendTo('aside.block-region .d-flex .col-8');
$("section.block_recentlyaccesseditems").appendTo('aside.block-region .d-flex .col-4');
$("section.block_online_users").appendTo('aside.block-region .d-flex .col-4');
/* Block - Announcement */
$("section.block_news_items .newlink").addClass("text-center border-bottom-1 border-bottom-dashed border-secondary pb-2 mb-3");
$("section.block_news_items .unlist").addClass("my-2 d-flex flex-wrap flex-row gap-3");
$("section.block_news_items .unlist li.post").addClass("card col-4 shadow-sm");
$("section.block_news_items .unlist li.post .info").addClass("card-body p-5 order-1");
$("section.block_news_items .unlist li.post .head.clearfix").addClass("card-footer p-5 order-2");
$("section.block_news_items .unlist li.post .head.clearfix .date").prepend('<i class="fa fa-calendar pe-3"></i>');
$("section.block_news_items .unlist li.post .head.clearfix .name").prepend('<i class="fa fa-user pe-3"></i>');
$("section.block_news_items .card .card-footer .footer").addClass("text-center");
/* Block - Badges */
$("section.block_badges .badges").addClass("flex-fill flex-wrap list-group list-group-flush list-group-horizontal");
$("section.block_badges .badges li").addClass("list-group-item border-0 w-auto");
$("section.block_badges .badges li a").addClass("h-auto");
$("section.block_badges .badges .badge-image").addClass("border border-secondary shadow-sm rounded-circle object-fit-cover w-50px h-50px");
$("section.block_badges .badges .badge-name").remove();
/* Block - Online Users */
$("section.block_online_users .info").addClass("text-center border-bottom-1 border-bottom-dashed border-secondary pb-2 mb-3");
$("section.block_online_users .list").addClass("list-group mh-200px overflow-auto");
$("section.block_online_users .listentry").addClass("list-group-item d-flex justify-content-between align-items-center p-3 shadow-sm");
$("section.block_online_users .listentry .user .userpicture").addClass("me-3");
$("section.block_online_users .listentry .user .userinitials ").addClass("me-3");