( function( $ ){

	jQuery( document ).ready( function() {
        
        jQuery( 'body' ).on( 'change', '.layout-options-image input', function(e) {
            var layoutval = $(this).val();
            var widget = $(this).closest('.widget');
            widget.find('.description-layout').removeClass('active-layout');
            widget.find('.description-layout.'+layoutval).addClass('active-layout');
        });
        
	} );
} ) ( jQuery );