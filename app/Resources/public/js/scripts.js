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

				// alternatywna wersja dla odpowiedzi z JSON
				//$form.replaceWith(response.view);
				//alert(response.message);
				
				$form.replaceWith(response);
				
				// ponowne przypisanie akcji 'submit' dla przycisku
				$form = $('form#contact-form');
				$form.submit(handleForm);
			}
			// alternatywna wersja dla żądania z JOSNem
			//'json'
		);
		
		// zapobiega standardowemu wysłaniu formularza
		return false;
	}
	
	// akcja wykonywana w momencie kliknięcia przycisku 'submit'
	$form.submit(handleForm);
	
});
