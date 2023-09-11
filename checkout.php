<?php
if (empty($_GET['id'])) {
# code...
header("Location: index.php");
exit;
}
include_once('components/server/mydb.php');
$productID = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM tm_products WHERE id = '$productID'") or die(mysqli_error());
if ($sql->num_rows > 0) {
# code...
$data = mysqli_fetch_array($sql);
$name = $data['name'];
$link= $data['link'];
$price = $data['price'] * 100;
}
else{
header("Location: index.php");
}
require 'stripe-php/init.php';
require 'components/server/config.php';

?>
<html>
<head>
<title>Stripe Server Side Integration</title>

</head>
<body>
    <?php

$stripe = new \Stripe\StripeClient('sk_test_51M6IsGJuqIKAONaQbWLWU4FkhbCPmICv4gPpMYLylJPopbO1yP5Sd6rPaTyJ8vfYZdp07kjOv2CZLzcBeILWkjLS00lR7aHtdZ');

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
    'price_data' => [
      'currency' => 'huf',
      'product_data' => [
        'name' => $name,
        'metadata' => [ 
          'pro_id' => $productID 
      ] 
      ],
      'unit_amount' => $price,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}&name=' . $link,
  'cancel_url' => STRIPE_CANCEL_URL,
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

$api_error = $e->getMessage();

if(empty($api_error) && $checkout_session){ 
  $response = array( 
      'status' => 1, 
      'message' => 'Checkout Session created successfully!', 
      'sessionId' => $checkout_session->id 
  );
} 
?>

</script>
<script src="https://js.stripe.com/v3/"></script>
</body> 
</html>