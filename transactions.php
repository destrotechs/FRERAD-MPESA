<?php
require_once('conf.php');
include('header.php');

$transactions = new Payment("trasactions");
$transactions->getTransactions($_COOKIE['username']);

include('footer.php');

?>