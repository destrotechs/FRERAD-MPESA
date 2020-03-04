<?php
error_reporting(0);
require_once('conf.php');
$callbackData=json_decode(trim(file_get_contents("https://hewanet.co.ke/callback/callback.txt")),true);
 $jsonObject = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'];
 if ($jsonObject!=NULL && $jsonObject!="") {
 	foreach ($jsonObject as $key => $value)
        {

            if ($value[Name] == "Amount")
            {
                $amount = $value[Value];
            }
            else if ($value[Name] == "MpesaReceiptNumber")
            {
                $transactionId = $value[Value];

            }
            else if ($value[Name] == "TransactionDate")
            {
                $TransactionDate = $value[Value];

            }
            else if ($value[Name] == "PhoneNumber")
            {

                $PhoneNumber = $value[Value];
            }


        }
        $payment= new Payment("transactions");
        $payment->createPlan($_COOKIE['username'],$_COOKIE['plan']);
        $payment->saveTransaction($amount,$transactionId,$TransactionDate,$PhoneNumber);

 }else{
 	$err="your transaction did not complete successfully, try again";
 	setcookie("err",$err,time()+(60*2),"/");
 	header("location:err.php");
 }
 
?>