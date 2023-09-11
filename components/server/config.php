<?php
$productName = "Codex Demo Product";  
$productID = "DP12345";  
$productPrice = 55; 
$currency = "usd"; 


define('STRIPE_API_KEY', 'sk_test_51KdaLwJtPEbOITsDLRJE1kE9ZpGQ1UKyi3c56ERIHCxCKFMrfS5GbVwgUHnmJCMddO2l7oUaB4x1NJMSWWiiGMez00Ke0tWbm4');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51KdaLwJtPEbOITsDS1FB3bCzXMOpefG8evLw2d5PzMjwXlJp0P808oKs96mVCVWtihddcFc91o4RzIvBaY6T3LVe00zoyxyfrW');
define('STRIPE_SUCCESS_URL','http://localhost/tippmix/payment-success.php');
define('STRIPE_CANCEL_URL','http://localhost/tippmix/payment-cancel.php');


define('DB_HOST', 'localhost');   
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', '');   
define('DB_NAME', 'tm'); 
?>