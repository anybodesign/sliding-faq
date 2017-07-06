jQuery(document).ready(function($) {

	$('.faq-list--title').on('click', function () {
		
		// hide everything
		
		$('.faq-list--question').removeClass('faq-on');
		$('.faq-list--answer').slideUp('normal').attr('aria-hidden','true');
		$(this).attr('aria-expanded','false');
		
		
		// if content is hidden
		
		if($(this).parent().parent().find('.faq-list--answer').is(':hidden') == true) {
			
			// add class and show the content (and toggle aria-hidden)
			
			$(this).parent().addClass('faq-on');
			$(this).parent().parent().find('.faq-list--answer').slideDown('normal').attr('aria-hidden','false');
			
			// toggle aria-expanded on the button
			
			$('.faq-list--title').attr('aria-expanded','false');
			$(this).attr('aria-expanded','true');
		} 
		
	 });
	
	// hide the answers on load
	
	$('.faq-list--answer').hide();	
	
});