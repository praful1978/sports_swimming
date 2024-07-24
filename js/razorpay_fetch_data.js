 
// Define a handler function to process payment success
function handlePaymentSuccess(response) {
    // Extract payment details from the response
    const paymentId = response.razorpay_payment_id;
    const orderId = response.razorpay_order_id;
    const signature = response.razorpay_signature; // This may not be present in the response object

    // Log the details for debugging
    console.log('Payment ID:', paymentId);
    console.log('Order ID:', orderId);
    console.log('Signature:', signature);
	document.getElementById('pay_id').innerHTML=paymentId;
document.getElementById('order_id').innerHTML=orderId;
document.getElementById('signature').innerHTML=signature;
    // Handle missing signature
    if (signature === undefined) {
        console.warn('Signature is undefined');
    }

    // You can use these details as needed, e.g., send to your server for verification
}

// Define payment options
const options = {
    key: 'rzp_test_Gv69T1SFBew7Oh',
    amount: 1000, // Example: ₹10 (amount in smallest currency unit)
    currency: 'INR',
    name: 'District Sports office, Yavatmal',
    description: 'Purchase Description',
    handler: handlePaymentSuccess, // Pass the handler function
    prefill: {
        name: 'Customer Name',
        email: 'customer@example.com',
        contact: '9999999999'
    },
    notes: {
        address: 'Customer Address'
    },
    theme: {
        color: '#3399cc'
    }
};

// Create a new Razorpay payment object
const paymentObject = new window.Razorpay(options);

// Open Razorpay checkout form when the button is clicked
document.getElementById('pay-button').addEventListener('click', function() {
    paymentObject.open();
});

 