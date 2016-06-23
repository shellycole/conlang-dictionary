$( document ).ready(function() {

	// bootstrap activate popovers
	$('[data-toggle="popover"]').popover({
		container: 'body'
	 });

	// bootstrap enable tooltips
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	})

	// hide all the clonedInput fields, except the first one
	$('.clonedInput').not(':eq(0)').hide();

	// if $_POST, a class is added to divs that have info entered. This leaves them open.
	$('.clonedInput.filled').show();

	// open clonedInputs
	$('.btn-open').on('click', function(e) {
	    e.preventDefault();
	    $(this).parents(':eq(1)').next('.clonedInput').show('slow');
	});

	// close clonedInputs
	$('.btn-close').on('click', function(e) {
	    e.preventDefault();
	    //clear form section on close
	    $(this).parent().parent('.clonedInput').find(':input').each(function() {
			    switch(this.type) {
			        case 'password':
			        case 'text':
			        case 'textarea':
			        case 'file':
			        case 'select-one':       
			            jQuery(this).val('');
			            break;
			        case 'checkbox':
			        case 'radio':
			            this.checked = false;
			    }
			  });
	    // hide form section
	    $(this).parent().parent('.clonedInput').hide('slow');
	});

	// datatables
	if( $.isFunction($.fn.DataTable) ) {
		$('#wordlist').DataTable( {
	        "order": [[ 3, "desc" ]]
	    } );
	}
});