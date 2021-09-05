<nav class="navbar navbar-expand-lg navbar-light bg-success ">
    <a class="navbar-brand" href="#">GK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">首頁 <span class="sr-only">(current)</span></a>
            </li>
            <?php
            if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                echo '<li class="nav-item">
                        <a class="nav-link " href="product.php">菜單</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">訂單</a>
                    </li>';
            }
            ?>
        </ul>
        <?php
        if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
            echo '<b class="text-dark">'.$_SESSION['name'].'</b>
                <form action="index.php" method="post" class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-light ml-4 my-2 my-sm-0" name="logout" type="submit">登出</button>
                </form>';
        }
        ?>
    </div>
</nav>