<?php
    $book_id = $_GET['book_id'];

    $link = mysqli_connect("localhost", "root" ,"12345678");
	mysqli_select_db($link, "sa");
    
    $sql="DELETE FROM book_info WHERE book_id = '$book_id';";

    if(mysqli_query($link,$sql))
    {
        header('location:已上架書籍.php?method=message&message=下架成功');
    }else{
        header('location:已上架書籍.php?method=message&message=下架失敗');
    }

?>
