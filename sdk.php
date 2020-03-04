$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
$lastmonth = mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"));
$nextyear  = mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1);

$host="https://example.com/";
		$port=2043;
		set_time_limit(0);
		$socket=socket_create(AF_INET, SOCK_STREAM,0) or die("could not create socket");
		$result=socket_bind($socket, $host,$port) or die("could not bind to socket");
		$result= socket_listen($socket,10) or die("could not set up socket listener");
		$spawn=file_get_contents("php://input");
		//socket_accept($socket) or die("could not accept incoming connection");
		$input = socket_read($spawn, 2048)or die("could not read input")


if($result==0){
			setcookie("status","congratulations!! your payment was successfull",time() + (60*5),"/");

		//save user data if transaction was successful
		//save in radcheck
		$queryradcheck="INSERT INTO radcheck (username,attribute,op,value) VALUES (:username,:attribute,:op,:value)";
		$statement= $this->conn->prepare($queryradcheck);
		$statement->execute([
			'username'=>$_COOKIE['username'],
			'attribute'=>'Cleartext-Password',
			'op'=>':=',
			'value'=>$_COOKIE['password']
		]);

		//save plan info radgroup
		$queryradgroupreply="INSERT INTO radgroupreply (groupname,attribute,op,value) VALUES (:groupname,:attribute,:op,:value)";
		$statement= $this->conn->prepare($queryradgroupreply);
		$statement->execute([
			'groupname'=>$_COOKIE['plan'],
			'attribute'=>$_COOKIE['plan'],
			'op'=>':=',
			'value'=>$_COOKIE['plan']
		]);

		//save user billing info
		$queryradgroupreply="INSERT INTO userbillinginfo (name,email,phone,paymentmethod) VALUES (:name,:email,:phone,:paymentmethod)";
		$statement= $this->conn->prepare($queryradgroupreply);
		$statement->execute([
			'name'=>$_COOKIE['name'],
			'email'=>$_COOKIE['email'],
			'phone'=>$_COOKIE['phone'],
			'paymentmethod'=>'Mpesa'
		]);

		//redirect
		header("location:status.php");
	}else{

		setcookie("status","Failed!! your payment wasn't successfull",time() + (60*5),"/");
	}