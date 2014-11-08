// gdy dokument zostanie w pełni załadowany
$(document).ready(function() {
	
	// formularz kontaktowy
	var $form = $('form#contact-form');
	// akcja dla formularza kontaktowego
	var action = $form.attr('action');
	
	var handleForm = function() {

		// akcja ajaksowa metodą POST
		$.post(
			action, 
			$form.serialize(),
			function(response) {
			
				if (response.success) {
					alert(response.message)
				} else {
					alert(response.message);
					$form.replaceWith(response.view);
				}
				
				$form = $('form#contact-form');
				$form.submit(handleForm);
			}, 
			'json'
		);
		
		// zapobiega standardowemu wysłaniu formularza
		return false;
	}
	
	// akcja wykonywana w momencie kliknięcia przycisku 'submit'
	$form.submit(handleForm);
	
});
