<!--借書或還書-->
<?php

$name = $_SESSION['name'];
$account = $_SESSION['account'];
$link = mysqli_connect("localhost", "root");
$order_id = $_POST['order_id'];
mysqli_query($link, "SET NAMES 'UTF8'");

mysqli_select_db($link, "sa");
if ($_GET['br'] == 'r') {
	//return
	$book_id = $_POST['book_id'];
	$ISBN = $_POST['ISBN'];
	$sql = "UPDATE `book_info` SET `book_user`='none' WHERE book_id = $book_id";
	$clear_book_id_sql = "UPDATE orderlist SET book_id = 0  WHERE order_id = '$order_id'";
	$owner_check_clear_sql="UPDATE orderlist SET owner_check = 0 WHERE order_id='$order_id'";
    $user_check_clear_sql="UPDATE orderlist SET user_check = 0 WHERE order_id='$order_id'";
	//評論書籍
	$return_time = date('Y-m-d');
	
	$rate = $_POST['rate'];
	$rate_content = $_POST['rate_content'];
	//$brok_img = $_POST['brok_img']; 已經不用ㄌ
	$book_owner = $_POST['book_owner'];

	$rate_sql = "INSERT INTO `evaluation`(`book_id`,`account`,`rate`, `rate_content`, `rate_time`,  `ISBN` ,`owner_account`) 
    VALUES ('$book_id','$account','$rate','$rate_content','$return_time', '$ISBN','$book_owner')";
	//query
	if (mysqli_query($link, $rate_sql) and mysqli_query($link, $sql) and mysqli_query($link, $clear_book_id_sql) and mysqli_query($link, $owner_check_clear_sql) and mysqli_query($link, $user_check_clear_sql)) {
		//header("location:index.php?log=r_success");
		
		echo "<script>alert('感謝您的評價！'); location.href='index.php?log=r_success'</script>";
	} else {
		header("<script>alert('評價失敗！');location.href='index.php?log=r_fail'</script>");
	}
} else {
	$book_id = $_SESSION['book_id'];
	$sql = "UPDATE `book_info` SET `book_user`='$account' WHERE book_id = $book_id";
	if (mysqli_query($link, $sql)) {
		header('location:index.php?log=b_success');
	}
}
?>
