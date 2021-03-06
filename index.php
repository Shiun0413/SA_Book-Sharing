<?php

$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
$sql = "select * from book_info GROUP BY ISBN order by likes DESC";
$rs = mysqli_query($link, $sql);
if (isset($_GET['log'])) {
    if ($_GET['log'] == 'no') {
        echo "<script>alert('請先登入帳號密碼')</script>";
    } else if ($_GET['log'] == 'r_success') {
        //echo "<script>alert('還書成功')</script>";
    } else if ($_GET['log'] == 'r_fail') {
        echo "<script>alert('還書失敗')</script>";
    } else if ($_GET['log'] == 'b_success') {
        echo "<script>alert('借書成功')</script>";
    }
}
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>書籍共享平台</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <form action="member.php">
                    <section id="search" class="alt">
                        <?php
                        if (isset($_SESSION['name'])) {
                            $name = $_SESSION['name'];
                            $account = $_SESSION['account'];
                            $con = $_SESSION['con'];
                            echo "<ul class='icons'>
                                <li><p>$name ，歡迎光臨 <a href='logout.php' class='button primary small'>登出</span></a></p></li>
                                </ul>";
                        } else {
                            echo "<ul class='icons'>
                                <li><a href='login.php' class='button primary small'>登入</span></a></li>
                                </ul>";
                        }
                        ?>
                        </form>
                        <form method="post" action="search.php">
                            <input type="text" name="query" id="query" placeholder="輸入關鍵字" />
                        </form>
                    </section>

                </header>

                <!-- Banner -->

                <section id="banner">
                    <div class="content" style="padding:15px">
                        <header>
                            <h1>書籍共享平台</h1>
                        </header>
                        <h4>想要看書又不想花錢嗎？只要捐出家裡閒置的藏書，你也可以免費看書！</h4>
                        <p>為了解決書籍價值因書籍被閒置在書櫃中而浪費，我們希望這個網頁能夠有效最大化這些書的價值。
                            隨著「共享經濟」逐漸普及，許多平台的出現，都是為了讓家中閒置的物品，
                            不要浪費它的價值，讓有需要的人可以透過小小的錢甚至是免費，也能擁有「使用權」。</p>
                        <p>本系統設有點數制，每日登入系統即可獲得點數，分享書籍者可以獲得更多的點數。
                            若想要借閱書籍，必須消耗點數才能借閱。借書和還書的部分，
                            我們會將會員提供的聯絡方式、居住地區顯示在網站上，因此借閱者可以和分享者聯絡，
                            並約好在何時何地見面，也可以在面交時確認書籍完整程度，以免發生爭議。</p>

                    </div>
                    <img src="images/book.jpg" width="560" height="320" alt=""  style="margin-top: 100px"/>
                </section>

                <!-- Section  -->
                <section>
                    <header class="major">
                        <h2>熱門推薦</h2>
                    </header>
                    <div class="features">

                        <?php
                        $i = 0;
                        while ($rslt =  mysqli_fetch_assoc($rs) and $i < 8) {
                        ?>
                            <article>
                                <span><img  class="book_image" src="images/<?php echo $rslt['book_image']; ?>" alt="" /></span>
                                <div class="content">
                                    <h3><?php echo $rslt['book_name']; ?></h3>
                                    <p><?php echo $rslt['book_introduction']; ?></p>
                                    <ul class="actions">
                                        <?php if (isset($account)) {
                                            if ($rslt['book_owner'] == $account) { ?>
                                                <li><a href="書籍內容.php?book_name=<?php echo $rslt['book_name'] ?>&ISBN=<?php echo $rslt['ISBN'] ?>" class="button">書籍資訊</a>
                                                </li><?php } else { ?>
                                                <li><a href="書籍內容.php?book_name=<?php echo $rslt['book_name'] ?>&ISBN=<?php echo $rslt['ISBN'] ?>" class="button">書籍資訊</a>
                                                </li><?php }
                                                } else { ?>
                                            <li><a href="書籍內容.php?book_name=<?php echo $rslt['book_name'] ?>&ISBN=<?php echo $rslt['ISBN'] ?>" class="button">書籍資訊</a>
                                            </li><?php } ?>

                                    </ul>
                                </div>

                            </article>
                        <?php $i += 1;
                        } ?>

                    </div>
                </section>

                <!-- Section -->


            </div>
            
            <?php include "footer.php" ?>
        </div>
        
        <?php include "index_bar.html" ?>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>
