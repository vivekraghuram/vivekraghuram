function navigate(navid) {

//Close everything
	var wrappers = $('.slidewrapper');
	$(wrappers).removeClass('open');

//Remove nav color
	var navlinks = $('.navlink');
	$(navlinks).removeClass('chosen');

//Open Selected Panel
	var selectedpanel = $('.'+navid);
	$(selectedpanel).addClass('open');

//add nav color
	var selectnav = $('#'+navid);
	$(selectnav).addClass('chosen');

}