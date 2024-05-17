 $(document).ready(()=> {
	$(".menu-link").each(function(e) {
		var ya = $(this).find('.hokage-menu-icon');
		var href = $(this).attr('href');
		if (ya.length != 0){
			// Admin
			if (href.includes('admin')){
				ya.addClass("ki-duotone ki-setting-2 fs-2");
				ya.html(duotonePallette(2));
			}
			// My (Dashboard)
			else if (href.includes('my')){
				if (href.includes('courses')){
					ya.addClass("ki-duotone ki-book fs-2");
					ya.html(duotonePallette(4));
				} else {
					ya.addClass("ki-duotone ki-element-11 fs-2");
					ya.html(duotonePallette(4));
				}
			} else {
				ya.attr("class", "ki-duotone ki-home fs-2");
			}
		}
	});

	$(".userpicture").addClass("m-auto rounded-circle");
})

function duotonePallette(c) {
	let element = "";
	
	for (var x = 1; x <= c; x++) {
		element += `<span class="path${x}"></span>`; 
	}

	return element;
}