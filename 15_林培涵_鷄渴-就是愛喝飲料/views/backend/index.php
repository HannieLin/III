<!DOCTYPE html>
<html>

<head>
    <title>GK後台管理系統</title>
    <?php include("../sub-views/common_css.php"); ?>
    
</head>

<body style="background-color:lightcyan">
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    // post 登入
    if (isset($_POST['login'])) {
        $member = $DB->fetch("SELECT * FROM member WHERE type = '1' AND username = ?", $_POST['username']);
        if (!isset($member['id']) || $member['password'] != $_POST['password']) {
            phpAlert("帳號或密碼錯誤");
        } else {
            $_SESSION["userid"] = $member['id'];
            $_SESSION["username"] = $member['username'];
            $_SESSION["name"] = $member['name'];
        }
    } else if (isset($_POST['logout'])) {
        unset($_SESSION["userid"]);
        unset($_SESSION["username"]);
        unset($_SESSION["name"]);
    }
    ?>
    <?php include("../sub-views/backend_header.php"); ?>

    <div class="container mt-3">
        <?php
        if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
            echo '<h4>你好! ' . $_SESSION['name'].'</h4>';
        } else {
            echo '<h4 class="d-flex justify-content-center"><i class="fas fa-user-tie"></i>管理者登入</h4>
                <form action="index.php" method="post" class="row g-3 d-flex justify-content-center">
                    <div class="col-7">
                        <label for="username" class="form-label">帳號</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="col-7">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" name="password">
                    </div>
            <div class="col-12 mt-4 d-flex justify-content-center ">
                        <button type="submit" name="login" class="btn btn-success">登入</button>
                    </div>
                </form>';
        }
        ?>
    </div>
    <img class="mt-4" src="/15_林培涵_鷄渴-就是愛喝飲料/assets/img/G-KER(black).png" alt="" style="position:relative; left:40%; width:300px; height:300px;">
    <?php include("../sub-views/common_js.php"); ?>
</body>

</html>