<?php 
// Include configuration file  
require_once 'components/server/config.php'; 
require_once 'components/server/mydb.php'; 
echo $api_error = '';
$payment_id = 1;

if(!empty($_GET['session_id'])){
    $session_id = $_GET['session_id'];
    $sqlQ = "SELECT * FROM tm_transactions WHERE session_id = ?"; 
    $stmt = $con->prepare($sqlQ);  
    $stmt->bind_param("s", $db_session_id); 
    $db_session_id = $session_id; 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    if($result ->num_rows > 0){
        echo 'No checkout session id found';
    }
    else{
        require 'stripe-php/init.php';
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY);
        try { 
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id); 
        } catch(Exception $e) {  
            $api_error = $e->getMessage();  
        } 
        if(empty($api_error) && $checkout_session){ 
        $customer_details = $checkout_session->customer_details; 
 
        // Retrieve the details of a PaymentIntent 
        try { 
            $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent); 
        } catch (\Stripe\Exception\ApiErrorException $e) { 
            $api_error = $e->getMessage(); 
        } 
        if(empty($api_error) && $paymentIntent){ 
            if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){ 

       /* echo 'Found checkout session:  ' . $session_id;*/

       $customer_name = $customer_email = ''; 
       if(!empty($customer_details)){ 
           $customer_name = !empty($customer_details->name)?$customer_details->name:''; 
           $customer_email = !empty($customer_details->email)?$customer_details->email:''; 
       }  

                    // Check if any transaction data is exists already with the same TXN ID 
                    $sqlQ = "SELECT id FROM tm_transactions WHERE txn_id = ?"; 
                    $stmt = $con->prepare($sqlQ);  
                    $stmt->bind_param("s", $transactionID); 
                    $stmt->execute(); 
                    $result = $stmt->get_result(); 
                    $prevRow = $result->fetch_assoc(); 
                     
                    if(!empty($prevRow)){ 
                        $payment_id = $prevRow['id']; 
                    }else{ 
    
                        $insertData = "INSERT INTO `tm_transactions`(`id`, `customer_name`, `customer_email`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES ('[value-1]','[value-2]','nmthdvd123@gmail.com','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','$session_id','[value-13]',NOW())";
                        $res = mysqli_query($con, $insertData);

            if($insert){ 
                $payment_id = $stmt->insert_id; 
            } 
            $insertData = "INSERT INTO `tm_transactions`(`id`, `customer_name`, `customer_email`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES ('[value-1]','[value-2]','$customer_email','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','$session_id','[value-13]',NOW())";
            $res = mysqli_query($con, $insertData);
        } 
         
        $status = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
        }
        $insertData = "INSERT INTO `tm_transactions`(`id`, `customer_name`, `customer_email`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES ('[fasz-1]','[fasz-2]','$customer_email','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','$session_id','[value-13]',NOW())";
        $res = mysqli_query($con, $insertData);
    }
    $insertData = "INSERT INTO `tm_transactions`(`id`, `customer_name`, `customer_email`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES ('[geci-1]','[value-2]','$customer_email','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','$session_id','[value-13]',NOW())";
    $res = mysqli_query($con, $insertData); 
    }
    $insertData = "INSERT INTO `tm_transactions`(`id`, `customer_name`, `customer_email`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES ('[kuki-1]','[value-2]','$customer_email','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','$session_id','[value-13]',NOW())";
    $res = mysqli_query($con, $insertData);
}
$insertData = "INSERT INTO `tm_transactions`(`id`, `customer_name`, `customer_email`, `item_name`, `item_number`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `stripe_checkout_session_id`, `created`, `modified`) VALUES ('[value-1]','[value-2]','$customer_email','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','$session_id','[value-13]',NOW())";
$res = mysqli_query($con, $insertData);
}



?>

<?php if(!empty($payment_id)){ ?>
   
	
    <h4>Payment Information</h4>
    <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
    <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
    <p><b>Paid Amount:</b> <?php echo $price.' '.$paidCurrency; ?></p>
    <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
	
    <h4>Customer Information</h4>
    <p><b>Name:</b> <?php echo $customer_name; ?></p>
    <p><b>Email:</b> <?php echo $customer_email; ?></p>
	
    <h4>Product Information</h4>
    <p><b>Name:</b> <?php echo $name; ?></p>
    <p><b>Price:</b> <?php echo $price.' '.$currency; ?></p>
<?php }else{ ?>
    <h1 class="error">Your Payment been failed!</h1>
    <p class="error"></p>
<?php } ?>