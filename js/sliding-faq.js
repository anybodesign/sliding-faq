jQuery(document).ready(function($) {

	$('.faq-list--title').on('click', function () {
		
		$('.faq-list--question').removeClass('faq-on');
		$('.faq-list--answer').slideUp('normal').attr('aria-expanded','false');
   
		if($(this).parent().find('.faq-list--answer').is(':hidden') == true) {
			$(this).parent().addClass('faq-on');
			$(this).parent().find('.faq-list--answer').slideDown('normal').attr('aria-expanded','true');
		} 
		
	 });
	
	$('.faq-list--answer').hide().attr('aria-expanded','false');	
	
});