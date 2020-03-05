<?php
require_once('conf.php');
sleep(40);
$checkStatus= new Payment("payments");
$checkStatus->generateSandboxToken();
$checkStatus->querySTKPush();

?>