<?php
//session_start();

$user = (isset($_SESSION['username'])) ? $_SESSION['username'] : '';
if($user == ''){ 
	echo "คุณยังไม่ได้ล็อกอิน";
	exit();
}else{
	echo "สวัสดีครับ คุณ". $_SESSION['username'];
}

exit();

if(isset($_SESSION['username'])){
	if($_SESSION['username'] == ''){
		echo "คุณยังไม่ได้ล็อกอิน";
		exit();
	}else{
		echo "สวัสดีครับ คุณ". $_SESSION['username'];
	}
}else{
	echo "คุณยังไม่ได้ล็อกอิน 2";
	exit();
}
?>