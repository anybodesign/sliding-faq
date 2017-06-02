jQuery(document).ready(function() {

	jQuery('.faq-list--title').click(function() {
		jQuery('.faq-list--question').removeClass('faq-on');
		jQuery('.faq-list--answer').slideUp('normal');
   
		if(jQuery(this).parent().find('.faq-list--answer').is(':hidden') == true) {
			jQuery(this).parent().addClass('faq-on');
			jQuery(this).parent().find('.faq-list--answer').slideDown('normal');
		} 
	 });
	
	jQuery('.faq-list--answer').hide();	
	
});