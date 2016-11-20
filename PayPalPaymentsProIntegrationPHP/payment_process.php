<?php
require('paypal/PaypalPro.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $payableAmount = 10;
    $nameArray = explode(' ',$_POST['name_on_card']);
    
    //Buyer information
    $firstName = $nameArray[0];
    $lastName = $nameArray[1];
    $city = 'Kolkata';
    $zipcode = '700091';
    $countryCode = 'IN';
    
    //Create an instance of PaypalPro class
    $paypal = new PaypalPro;
	
	//Payment details
    $paypalParams = array(
        'paymentAction' => 'Sale',
        'amount' => $payableAmount,
        'currencyCode' => 'USD',
        'creditCardType' => $_POST['card_type'],
        'creditCardNumber' => trim(str_replace(" ","",$_POST['card_number'])),
        'expMonth' => $_POST['expiry_month'],
        'expYear' => $_POST['expiry_year'],
        'cvv' => $_POST['cvv'],
        'firstName' => $firstName,
        'lastName' => $lastName,
        'city' => $city,
        'zip'	=> $zipcode,
        'countryCode' => $countryCode,
    );
    $response = $paypal->paypalCall($paypalParams);
    $paymentStatus = strtoupper($response["ACK"]);
    if ($paymentStatus == "SUCCESS"){
		$data['status'] = 1;
		
        $transactionID = $response['TRANSACTIONID'];
        //Update order table with tansaction data & return the OrderID
        //SQL query goes here..........
		
        $data['orderID'] = $OrderID;
    }else{
         $data['status'] = 0;
    }

    echo json_encode($data);
}
?>