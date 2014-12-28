(function($){
	// Tabs
	jQuery('ul.nd_tabs li a:not(ul.nd_tabs li.tab_right a), form.nd_form a.forgotten').click(function(){
		var $this = jQuery(this);
		var $wrap = $this.closest('.nd_login_widget');

		$wrap.find('.nd_form, .nd_logged_in').hide();
		$wrap.find('ul.nd_tabs li').removeClass('active');

		var target = $this.attr('href');
		target = target.replace( '#', '' );

		$this.parent().addClass('active');
		$wrap.find( '.' + target ).fadeIn();

		return false;
	});

	jQuery('ul.nd_tabs li:first').click();

	// Ajax
	jQuery('form.nd_form').submit(function(){
		var thisform = this;
		jQuery('div.nd_form_inner').block({ message: null, overlayCSS: {
	        backgroundColor: '#fff',
	        opacity:         0.6
	    } });
		jQuery.ajax({
			type: 'POST',
			url: jQuery(thisform).attr('action'),
			data: jQuery(thisform).serialize(),
			success: function( result ){
				jQuery('ul.errors, ul.messages').remove();
				result = jQuery.trim( result );
				if (result=='SUCCESS') {
					window.location = jQuery(thisform).attr('action');
				} else if (result.substring(8,0) =='SUCCESS:') {
					message = result.substr(8);
					jQuery('div.nd_form_inner', thisform).prepend('<ul class="messages"><li>' + message + '</li></ul>');
					jQuery('div.nd_form_inner').unblock();
				} else {
					jQuery('div.nd_form_inner', thisform).prepend('<ul class="errors"><li>' + result + '</li></ul>');
					jQuery('div.nd_form_inner').unblock();
				}
			}
		});
		return false;
	});
})(jQuery);