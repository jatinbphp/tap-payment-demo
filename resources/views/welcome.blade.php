<meta name="_token" content="{!! csrf_token() !!}"/>
<form id="paymentForm">
    <button type="button" onclick="submitPayment()">Pay Now</button>
</form>

<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
<script src="https://js.stripe.com/v3/"></script>

<script>
    function submitPayment() {
        const formData = {
            tapToken: 'token_from_tap_sdk_here' // Replace with actual Tap token
        };

        fetch('{{route("payment")}}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Payment successful:', data);
            // Handle success scenario as per your application flow
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error scenario as per your application flow
        });
    }
</script>
