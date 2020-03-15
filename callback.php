<?php
require_once('conf.php');
sleep(40);
$checkStatus= new Payment("transactions");
$checkStatus->generateToken();
$checkStatus->querySTKPush();

?>