<?php
session_start();
include_once('constants.php');
class Payment{
	var $table;
	var $conn;
	var $accesstoken="";
	var $processRequestCode;
// 	var $password="";
// 	var $timestamp="";
	var $checkoutrequestid="";
	function __construct($t){
		$this->table= $t;
		$this->conn= new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPASSWORD);
		if($this->conn){
// 			$this->getTimestamp();
// 			$this->getPassword();

			return $this->conn;
		}else{
			echo "unable to connect to database";
		}
	}

	//functions and actions here
	public function generateToken(){
		$url = 'https://'.ENV.'.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  
         $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode(CONSUMER_KEY . ':' . CONSUMER_SECRET);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . $credentials
        )); //setting a custom header
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        return $this->accesstoken=json_decode($curl_response, true) ['access_token'];
	}
	

	public function processRequest($p){
		$transactiontype='CustomerBuyGoodsOnline';
		$amount='1';
		$phone=$p;
		$partyA=$phone;
		$partyB=PARTYB;
		$callbackurl=CALLBACK_URL;
		$accountreference="HEWANET";
		$transactiondesc="plan payment";
		$remark='payplan';
		$url='https://'.ENV.'.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
		
		$timestamp='20'.date("ymdhis");
    	$password=base64_encode(SHORT_CODE.passkey.$timestamp);
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
  		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accesstoken));

		$postData=array(
			'BusinessShortCode'=>SHORT_CODE,
			'Password'=>$password,
			'Timestamp'=>$timestamp,
			'TransactionType'=>$transactiontype,
			'Amount'=>$amount,
			'PartyA'=>$partyA,
			'PartyB'=>PARTYB,
			'PhoneNumber'=>$phone,
			'CallBackURL'=>$callbackurl,
			'AccountReference'=>$accountreference,
			'TransactionDesc'=>$transactiondesc
		);
		$data=json_encode($postData);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$curl_response=curl_exec($ch);
		
		 
		$mycode=json_decode($curl_response)->ResponseCode;
		
		if($mycode==0){
			$this->checkoutrequestid=json_decode($curl_response,true)['CheckoutRequestID'];
			setcookie("checkoutid",$this->checkoutrequestid,time()+(60*1),"/");
		 //header("location:callback.php");
			echo("success");
		}else{
			$err="Your transaction could not be completed at this time, try again later";
			setcookie("err",$err,time()+(60*1),"/");
			//header("location:err.php");
			echo "failed";
		}
		 
		 
		
	}
public function querySTKPush(){ 
    
    $url = 'https://'.ENV.'.safaricom.co.ke/mpesa/stkpushquery/v1/query';
    $timestamp='20'.date("ymdhis");

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accesstoken));


    $curl_post_data = array(
        'BusinessShortCode' => SHORT_CODE,
        'Password' => base64_encode(SHORT_CODE.LIPA_NA_MPESA_KEY.$this->timestamp),
        'Timestamp' => $this->timestamp,
        'CheckoutRequestID' => $_COOKIE['checkoutid'],
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_HEADER, false);

    $curl_response = curl_exec($curl);

    $resultCode=json_decode($curl_response,true)['ResultCode'];
    
    //if transaction was successful
    if($resultCode==0){
    	 header("location:callbackStatus.php"); 
    	  	
    }else{
    	$err="Your transaction didn't complete successfully, please retry again";
    	setcookie("err",$err,time()+(60*2),"/");
    	header("location:err.php");
    	
    }
}

	public function getPassword(){
		 $this->password=base64_encode(SHORT_CODE.LIPA_NA_MPESA_KEY.$this->timestamp);
	}
	public function getTimestamp(){
		$this->timestamp='20'.date(	"ymdhis");
		//return $this->timestamp;
	}
	public function login($user,$pass){
		$query="SELECT * FROM ".$this->table." WHERE username=? AND password=?";
		$username=$user;
		$statement=$this->conn->prepare($query);
		$statement->execute([$username,$pass]);
		$user=$statement->fetchAll();

			if(count($user)==1){
			setcookie("loggedin",true,time()+(60*10),"/");
			setcookie("username",$username,time()+(60*10),"/");
			setcookie("password",$pass,time()+(60*10),"/");

			for ($i=0; $i < count($user); $i++) { 
				$phn='0'.$user[$i]['phone'];
			setcookie("phone",$phn,time()+(60*10),"/");	
			}

			session_unset();
			header("location:profile.php");
		}else{
			$_SESSION['error_login']="your username or password maybe wrong!";
			header("location:index.php");
		}
		
		
		
	} 
	public function fetchPlans(){
		$query="SELECT * FROM  radreply WHERE username=:user";
		$statement=$this->conn->prepare($query);
		$statement->execute(['user'=>$_COOKIE['username']]);
		
			while($plans=$statement->fetchAll()){
			if (count($plans)>0) {
				for ($i=0; $i < count($plans); $i++) { 
				 	echo "session expiry date : <b>".$plans[$i]['value']."</b>";
				}
			}else{
				echo "You have not purchased plans yet";
				}
			}
	}
	public function registerUser($name,$phone,$email,$username,$password){
		$query1="SELECT * FROM ".$this->table." WHERE username=:user";
		$query2="SELECT * FROM ".$this->table." WHERE phone=:phn";
		//check if username exists
		$statement=$this->conn->prepare($query1);
		$statement->execute(['user'=>$username]);
		$count1= count($statement->fetchAll());

		//check if phone exist
		$st=$this->conn->prepare($query2);
		$st->execute(['phn'=>$phone]);
		$count2=count($st->fetchAll());
		
		if ($count1>0) {
			echo "u";
		}else if($count2>0){
			echo "p";
		}

		else{

			$query="INSERT INTO ".$this->table." (name,phone,email,username,password) VALUES(:name,:phone,:email,:username,:password)";
			$stmt=$this->conn->prepare($query);
			$res=$stmt->execute([
				'name'=>$name,
				'phone'=>$phone,
				'email'=>$email,
				'username'=>$username,
				'password'=>$password
			]);
			if ($res) {
				echo "user created successfully!";
			}else{
				echo "e";
			}
		}


	}
	public function createPlan($user,$plan){
		$queryToFindIfUserExists="SELECT * FROM radcheck WHERE username=:user";
		$statement=$this->conn->prepare($queryToFindIfUserExists);
		$statement->execute(['user'=>$user]);
		$count1= count($statement->fetchAll());

		if ($count1>0) {
			
		}else{
			$queryradcheck="INSERT INTO radcheck (username,attribute,op,value) VALUES (:username,:attribute,:op,:value)";
			$statement= $this->conn->prepare($queryradcheck);
			$statement->execute([
				'username'=>$user,
				'attribute'=>'Cleartext-Password',
				'op'=>':=',
				'value'=>$_COOKIE['password']
			]);
		}


		$year=date("Y");
		$month=date("m");
		$day=date("d");
		$hour=date("H");
		$min=date("i");
		$sec=date("sa");
		//add user to radusergroup according to his plan
		if ($plan=='dailyplan') {
			//calculate date to disconnect i.e now + one day

		$dateTo=mktime($hour,$min,$sec,$month,$day+1,$year);
		$dateToDisconnect=date("Y-m-dTH:i:s",$dateTo);
		$dateToDisconnect=str_replace('UTC', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('CES', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('CET', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('am', '', $dateToDisconnect);
		//add user to daily plan radusergroup
		//check if user exists in radusergroup
		$queryToFindIfUserExists="SELECT id FROM radusergroup WHERE username=:user";
		$statement=$this->conn->prepare($queryToFindIfUserExists);
		$statement->execute(['user'=>$user]);
		$count1= count($statement->fetchAll());
			if($count1>0){
				
			}else{
				//add user to the table
				$query="INSERT INTO radusergroup (username,groupname,priority) VALUES(:username,:groupname,:priority)";
				$stmt=$this->conn->prepare($query);
				$res=$stmt->execute(['username'=>$user,'groupname'=>$plan,'priority'=>0]);
			}
			//add sessionterminatetime attribute to radgroupreply

			//find if user exist in this table
			$queryToFindIfUserExists="SELECT id FROM radreply WHERE username=:user";
			$statement=$this->conn->prepare($queryToFindIfUserExists);
			$statement->execute(['user'=>$user]);
			$id=$statement->fetchColumn(0);
			//die($id);
				if($id!="" && $id!=NULL){
					//update session termin ate date
					$query="UPDATE radreply SET value=:value WHERE id=:id";
					$st=$this->conn->prepare($query);
					$st->execute(['value'=>$dateToDisconnect,'id'=>$id]);

				}else{
					$query="INSERT INTO radreply (username,attribute,op,value) VALUES (:user,:att,:op,:val)";
					$st=$this->conn->prepare($query);
					$st->execute(['user'=>$user,'att'=>'WISPr-Session-Terminate-Time','op'=>':=','val'=>$dateToDisconnect]);
				}

		}else if($plan=='weeklyplan'){
			//calculate date to disconnect i.e now + 7 days
			$dateTo=mktime($hour,$min,$sec,$month,$day+7,$year);
		$dateToDisconnect=date("Y-m-dTH:i:s",$dateTo);
		$dateToDisconnect=str_replace('CET', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('am', '', $dateToDisconnect);
		$dateToDisconnect=str_replace('UTC', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('CES', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('pm', '', $dateToDisconnect);
		//add user to daily plan radusergroup
		//check if user exists in radusergroup
		$queryToFindIfUserExists="SELECT id FROM radusergroup WHERE username=:user";
		$statement=$this->conn->prepare($queryToFindIfUserExists);
		$statement->execute(['user'=>$user]);
		$count1= count($statement->fetchAll());
			if($count1>0){
				
			}else{
				//add user to the table
				$query="INSERT INTO radusergroup (username,groupname,priority) VALUES(:username,:groupname,:priority)";
				$stmt=$this->conn->prepare($query);
				$res=$stmt->execute(['username'=>$user,'groupname'=>$plan,'priority'=>0]);
			}
			//add sessionterminatetime attribute to radgroupreply

			//find if user exist in this table
			$queryToFindIfUserExists="SELECT id FROM radreply WHERE username=:user";
			$statement=$this->conn->prepare($queryToFindIfUserExists);
			$statement->execute(['user'=>$user]);
			$id=$statement->fetchColumn(0);
			//die($id);
				if($id!="" && $id!=NULL){
					//update session termin ate date
					$query="UPDATE radreply SET value=:value WHERE id=:id";
					$st=$this->conn->prepare($query);
					$st->execute(['value'=>$dateToDisconnect,'id'=>$id]);

				}else{
					$query="INSERT INTO radreply (username,attribute,op,value) VALUES (:user,:att,:op,:val)";
					$st=$this->conn->prepare($query);
					$st->execute(['user'=>$user,'att'=>'WISPr-Session-Terminate-Time','op'=>':=','val'=>$dateToDisconnect]);
				}

		}else if ($plan=='monthlyplan') {
			//calculate date to disconnect i.e now + 30 days
			$dateTo=mktime($hour,$min,$sec,$month,$day+30,$year);
		$dateToDisconnect=date("Y-m-dTH:i:s",$dateTo);
		$dateToDisconnect=str_replace('CET', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('am', '', $dateToDisconnect);
		$dateToDisconnect=str_replace('UTC', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('CES', 'T', $dateToDisconnect);
		$dateToDisconnect=str_replace('pm', '', $dateToDisconnect);
		//add user to daily plan radusergroup
		//check if user exists in radusergroup
		$queryToFindIfUserExists="SELECT id FROM radusergroup WHERE username=:user";
		$statement=$this->conn->prepare($queryToFindIfUserExists);
		$statement->execute(['user'=>$user]);
		$count1= count($statement->fetchAll());
			if($count1>0){
				
			}else{
				//add user to the table
				$query="INSERT INTO radusergroup (username,groupname,priority) VALUES(:username,:groupname,:priority)";
				$stmt=$this->conn->prepare($query);
				$res=$stmt->execute(['username'=>$user,'groupname'=>$plan,'priority'=>0]);
			}
			//add sessionterminatetime attribute to radgroupreply

			//find if user exist in this table
			$queryToFindIfUserExists="SELECT id FROM radreply WHERE username=:user";
			$statement=$this->conn->prepare($queryToFindIfUserExists);
			$statement->execute(['user'=>$user]);
			$id=$statement->fetchColumn(0);
			//die($id);
				if($id!="" && $id!=NULL){
					//update session termin ate date
					$query="UPDATE radreply SET value=:value WHERE id=:id";
					$st=$this->conn->prepare($query);
					$st->execute(['value'=>$dateToDisconnect,'id'=>$id]);

				}else{
					$query="INSERT INTO radreply (username,attribute,op,value) VALUES (:user,:att,:op,:val)";
					$st=$this->conn->prepare($query);
					$st->execute(['user'=>$user,'att'=>'WISPr-Session-Terminate-Time','op'=>':=','val'=>$dateToDisconnect]);
				}

		}
	}
	public function saveTransaction($amnt,$trans_id,$trans_date,$phone){
		$q="INSERT INTO transactions (username,payment_method,amount,plan,transaction_id,transaction_date,phone_number) VALUES (:user,:payment_met,:amount,:plan,:trans_id,:trans_date,:phone)";
		$statement=$this->conn->prepare($q);
		$res=$statement->execute([
			'user'=>$_COOKIE['username'],
			'payment_met'=>'M-Pesa',
			'amount'=>$amnt,
			'plan'=>$_COOKIE['plan'],
			'trans_id'=>$trans_id,
			'trans_date'=>$trans_date,
			'phone'=>$phone,
		]);
		if ($res) {
			$status="your transaction completed successfully, your login credentials are active upto to session expiry date displayed on my details tab";
 	setcookie("status",$status,time()+(60*2),"/");
 	header("location:status.php");
		}else{
			$status="Your transaction completed successifully butthere was an error saving transaction details, However, you can use your credentials to login and access internetb";
			setcookie("status",$status,time()+(60*2),"/");
 			header("location:status.php");
		}

	}
	public function getTransactions($user){
		$query="SELECT * FROM transactions WHERE username=:user";
		$statement=$this->conn->prepare($query);
		$statement->execute(['user'=>$user]);
			while($plans=$statement->fetchAll()){
			if (count($plans)>0) {
				$out="<table class='table table-sm table-stripped table-bordered table-light'><thead><tr><td>Name</td><td>Value</td></tr></thead><tbody>";
				for ($i=0; $i < count($plans); $i++) { 
				 	echo "<table class='table table-stripped table-bordered table-active table-light table-sm'><thead><tr class='bg-success text-white'><td>Name</td><td>Value</td></tr></thead><tbody><tr><td>Payment method</td><td>".$plans[$i]['payment_method']."</td></tr><tr><td>Mpesa receipt Number</td><td>".$plans[$i]['transaction_id']."</td></tr><tr><td>Amount</td><td>KES ".$plans[$i]['amount']."</td></tr><tr><td>Plan paid for</td><td>".$plans[$i]['plan']."</td></tr></tbody></table>";
				}
			}else{
				echo "You have not purchased plans yet";
				}
			}
	}
	public function updatePhone($phon){
		$query2="SELECT * FROM tempaccount WHERE phone=:phn";
		$st=$this->conn->prepare($query2);
		$st->execute(['phn'=>$phon]);
		$count2=count($st->fetchAll());
		
		if ($count2>0) {
			echo "No user found with the initial mobile number, contact system admin";
			exit(0);
		}else{
		$queryToFindIfUserExists="SELECT id FROM tempaccount WHERE username=:user";
			$statement=$this->conn->prepare($queryToFindIfUserExists);
			$statement->execute(['user'=>$_COOKIE['username']]);
			$id=$statement->fetchColumn(0);
			//die($id);
				if($id!="" && $id!=NULL){
					//update session termin ate date
					$query="UPDATE tempaccount SET phone=:phone WHERE id=:id";
					$st=$this->conn->prepare($query);
					$st->execute(['phone'=>$phon,'id'=>$id]);
					echo "your phone number has been updated successfully, you will be logged out";

				}else{
					echo "Your phone number could not be updated, try again later";
				}
			}
	}
}

?>
