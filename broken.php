<!DOCTYPE HTML>

<html>
<?php
$book_name = $_POST['book_name'];
$borrow_day = $_POST['borrow_day'];
$aver_rate = $_POST['aver_rate'];
$account = $_SESSION['account'];
$book_id = $_GET['book_id'];
$link = mysqli_connect("localhost", "root");
mysqli_query($link, "SET NAMES 'UTF8'");
mysqli_select_db($link, "sa");
//抓評論資料
$rate_sql = "select * from evaluation where book_id = '$_GET[book_id]'";
$rate_rs = mysqli_query($link, $rate_sql);
//抓書籍資料
$book_sql = "select * from book_info where book_id = '$_GET[book_id]'";
$book_rs = mysqli_query($link, $book_sql);
//從book_info資料表取得資料
$fetch_book_info_all_sql = "SELECT * FROM book_info WHERE book_id = '$_GET[book_id]'";
$book_info_rs = mysqli_query($link, $fetch_book_info_all_sql);
$book_info_array = mysqli_fetch_array($book_info_rs);
$ISBN = $book_info_array['ISBN'];
//點數
$point_sql = "select * from account where account = '$account'";
$point_rs = mysqli_query($link, $point_sql);
$point = mysqli_fetch_array($point_rs);
$points = $point['point'];
?>

<head>
    <title>書籍破損狀況</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/book-list.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <a href="index.php" class="logo"><strong>首頁</strong></a>
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
                </header>

                <!--破損情況-->
                <?php
                    //從book_condition資料表取得資料
                    $fetch_book_condition_all_sql = "SELECT * FROM book_condition WHERE book_id = '$book_id'";
                    $book_condition_rs = mysqli_query($link, $fetch_book_condition_all_sql);
                    $book_condition_array = mysqli_fetch_array($book_condition_rs);
                ?>
                <section>
                    <header class="major">
                        <h2>詳細書況</h2>
                    </header>
                    <div>
                        <!-- 以下輪播圖 -->
                        <div id="demo" class="carousel slide" data-ride="carousel" style='width:500px;'>
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="10000">
                                        <img src="images/<?php echo $book_condition_array['book_broken_image1']; ?>" style='height:500px' class="d-block w-100" alt="書況圖1">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2000">
                                        <img src="images/<?php echo $book_condition_array['book_broken_image2']; ?>" style='height:500px' class="d-block w-100" alt="書況圖2">  
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/<?php echo $book_condition_array['book_broken_image3']; ?>" style='height:500px' class="d-block w-100" alt="書況圖3">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/<?php echo $book_condition_array['book_broken_image4']; ?>" style='height:500px' class="d-block w-100" alt="書況圖4">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/<?php echo $book_condition_array['book_broken_image5']; ?>" style='height:500px' class="d-block w-100" alt="書況圖5">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>

                        </div>
                        <!-- 以上輪播圖 -->
                        <div style="position: relative; left: 800px; bottom: 400px">
                            <form action="addorder.php" method="post">
                                <div class="content" style="width:100%">

                                    <?php
                                    $book = mysqli_fetch_assoc($book_rs);
                                    //借書跟捐書人的名字
                                    $ownsql = "select * from account where account = '$book[book_owner]'";
                                    $ownrs = mysqli_query($link, $ownsql);
                                    $book_own = mysqli_fetch_assoc($ownrs);
                                    $usesql = "select * from account where account = '$book[book_user]'";
                                    $users = mysqli_query($link, $usesql);
                                    $book_use = mysqli_fetch_assoc($users);
                                    ?>
                                    <article>
                                        <header>

                                            <h2><?php echo $book['book_name']; ?></h2>
                                            <input type='hidden' name='book_name' value="<?php echo $book['book_name']; ?>">
                                            <h8>#<?php echo $book['book_id']; ?><br></h8>
                                            <input type='hidden' name='book_id' value="<?php echo $_GET['book_id']; ?>">
                                            <h4>擁有者 : <?php echo $book_own['account']; ?><br></h4>
                                            <input type="hidden" name="book_own" value="<?php echo $book['book_owner']; ?>">
                                            <h4>租借者 : <?php if ($book['book_user'] == "none") {
                                                            echo "none";
                                                        } else {
                                                            echo $book_use['account'];
                                                        } ?><br></h4>
                                            <h4>對分享者的評價 : <?php echo $aver_rate; ?>⭐<br></h4>
                                            <input type="hidden" name="book_user" value="<?php echo $account; ?>">
                                            <input type="hidden" name="borrow_day" value="<?php echo $borrow_day; ?>">
                                            <input type="hidden" name="ISBN" value="<?php echo $ISBN; ?>">
                                            <p>備註 : <?php echo $book_condition_array['note']; ?></p>
                                            <input type="hidden" name="status" value="待借書">
                                        </header>

                                        <!-- 以下為評論，暫時擱棄 -->
                                        <?php
                                        // while ($rate = mysqli_fetch_assoc($rate_rs)) {
                                        ?>

                                            <!-- &nbsp;
                                            <div style="flex: 1;"><img class="book_image" src="images/<?php //echo $rate['brok_img']; ?>" /></div>
                                            <div style="flex:5;margin-left: 40px; display:flex; flex-direction:column" class="link-top">
                                                <div style="flex:1">
                                                    <h4><?php //echo $rate['account']; ?></h4>
                                                </div>
                                                <div style="flex:1">
                                                    <h8><?php //echo $rate['rate_content']; ?></h8>
                                                </div>
                                                <div style="flex:1">
                                                    <h8>#<?php //echo $rate['rate_id']; ?>&nbsp&nbsp&nbsp&nbsp<?php //echo $rate['rate_time']; ?></h8>
                                                </div>
                                            </div> -->


                                        <?php //} ?>
                                    </article>
                                    <div class="actions">
                                        <?php if ($points < 5) { ?>
                                            <input type="submit" value="您的點數<5" disabled>
                                        <?php } else { ?>
                                            <input type="submit" onclick="window.alert('預約成功');" value="確定借閱"> <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
            <?php include "footer.php" ?>
        </div>
        <?php include "index_bar.html" ?>
    </div>




</body>

</html>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

<style>
    .brok_box {
        margin: 5%;
        height: 100%;
        display: flex;
    }

    .brok_img {
        height: 200px;
        width: 150px;
    }

    .brok_box_item {
        flex: 1;
    }

    .brok_box_item2 {
        flex: 2;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: row;
        margin-left: 40px;
    }

    /*中間的過度的橫線*/
    .link-top {
        width: 50%;
        border-bottom: solid #ACC0D8 1px;
    }

    /*畫一條再右邊的豎線*/
    .link-right {
        width: 100px;
        height: 20%;
        border-right: solid #ACC0D8 1px;
    }
</style>