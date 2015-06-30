jQuery(document).ready(function() {

	jQuery('.faq-list--question').click(function() {
		jQuery('.faq-list--question').removeClass('faq-on');
		jQuery('.faq-list--answer').slideUp('normal');
   
		if(jQuery(this).find('.faq-list--answer').is(':hidden') == true) {
			jQuery(this).addClass('faq-on');
			jQuery(this).find('.faq-list--answer').slideDown('normal');
		 } 
	 });
	
	jQuery('.faq-list--answer').hide();	
	
});