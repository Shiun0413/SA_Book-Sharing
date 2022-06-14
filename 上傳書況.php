
<!DOCTYPE HTML>

<html>

<head>
    <title>上傳書況</title>
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
                            header("location:index.php?log=no");
                        }
                        $book_id = $_GET['book_id'];
                        ?>
                </header>

                <!-- Content -->
                <section>

                    <!-- Content -->
                    <h2 id="content">輕鬆分享書籍！</h2>
                    <p>簡單幾個步驟，就能將您的愛書分享出去！讓其他人看看您的推薦吧！</p>

                    <hr class="major" />
                    <!--書籍資訊填寫表單-->
                    <h2 id="elements">上傳書況</h2>

                    <form method="post" action="上傳書況_check.php?book_id=<?php echo $book_id ?>" enctype='multipart/form-data'>
                        <div class="row gtr-uniform">
                            
                            <div class="col-6">
                                請上傳五張書況圖：封面、封底、書衣、書背、書腰&nbsp&nbsp&nbsp<input type="file" name="book_broken_image[]" id="book_broken_image" multiple="multiple" accept=".jpg, .png, .img, .jpeg" required/>
                            </div>
                            <div class="col-8">
                                <textarea name="note" id="note" placeholder="備註:" rows="6"></textarea>
                            </div>
                            <!-- 上架按鈕 -->
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" name="submit" value="上架" class="primary" /></li>
                                    <li><input type="reset" value="重新填寫" /></li>
                                </ul>
                            </div>
                        </div>
                    </form>

                </section>

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
