function navigate(navid) {

//Close everything
	var wrappers = $('.wrapper');
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

/*

	var items = $('.helppanel, .helppanelbutton, .xbox');
	var navlink = $('.navlink');
	var current = navlink.id;
	var xbox = $('.xbox')

	var open = function() {
							$(items).removeClass('close').addClass('open');
						}
	var close = function() { 
							$(items).removeClass('open').addClass('close');
						}

	hp.click(function(){
		if (hp.hasClass('open')) {$(close)}
		else {$(open)}
	});
	xbox.click(function(){
		if (hp.hasClass('open')) {$(close)};
	});*/

}