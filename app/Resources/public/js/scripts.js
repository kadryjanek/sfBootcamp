// gdy dokument zostanie w pełni załadowany
$(document).ready(function(){
	
	// formularz kontaktowy
	$form = $('form#contact-form'); 
	
	// akcja wykonywana w momencie kliknięcia przycisku 'submit'
	$form.submit(function() {

		console.log("Send form");
		
		// zapobiega standardowemu wysłaniu formularza
		return false;
	})
	
});
