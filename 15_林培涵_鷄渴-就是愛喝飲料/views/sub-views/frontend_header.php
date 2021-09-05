<nav class="navbar navbar-expand-lg navbar-light " style="background-color: tomato;">
    <a class="navbar-brand mr-0" href="#"><img src="/15_林培涵_鷄渴-就是愛喝飲料/assets/img/G-KERlogotext.png" alt="" style="width: 80px; height:40px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">首頁 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop.php">菜單</a>
            </li>
            <?php
            if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                echo '<li class="nav-item">
                        <a class="nav-link" href="cart.php">購物車</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">訂單</a>
                    </li>';
            }
            ?>
        </ul>

        <!-- <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="qa.php">常見問題</a>
            </li>
        </ul> -->
        <?php
        if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
            echo '<b>' . $_SESSION['name'] . '，你好!</b>
                <form action="index.php" method="post" class="form-inline  ml-4 my-2 my-lg-0">
                    <button class="btn btn-outline-light mr-3 my-2 my-sm-0" name="logout" type="submit" onmouseover="changetc(this)" onmouseout="normal(this)">登出</button>
                </form>';
        }
        ?>
    </div>
</nav>
<script>
    function changetc(id){
        id.style.color="tomato";
    }
    function normal(id){
        id.style.color="white";
    }
</script>