Stripe.setPublishableKey('pk_test_nVsj0gWavxo7AQnUlUZzKhtP');

var $form = $('#payment-form');

$form.submit(function(event) {
    $('#charge-error').addClass('hidden');
    $form.find('button').prop('disabled', true);
    Stripe.card.createToken({
        number: $('#cardNumber').val(),
        cvc: $('#cvc').val(),
        exp_month: $('#exMonth').val(),
        exp_year: $('#exYear').val(),
        name: $('#cardName').val()
    }, stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status, response) {

    // Grab the form:
    var $form = $('#payment-form');
  
    if (response.error) { // Problem!
      $('#charge-error').removeClass('d-none');
      // Show the errors on the form
      $form.find('#charge-error').text(response.error.message);
      $form.find('button').prop('disabled', false); // Re-enable submission
  
    } else { // Token was created!
  
      // Get the token ID:
      var token = response.id;
  
      // Insert the token into the form so it gets submitted to the server:
      $form.append($('<input type="hidden" name="stripeToken" />').val(token));
  
      // Submit the form:
      $form.get(0).submit();
  
    }
  }
