<?php
require_once('conf.php');
sleep(45);
$checkStatus= new Payment("payments");
$checkStatus->generateSandboxToken();
$checkStatus->querySTKPush();

?>