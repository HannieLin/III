<!DOCTYPE html>
<html>

<head>
    <title>frontend</title>
    <?php include("../sub-views/common_css.php"); ?>
    <link rel="stylesheet" href="/15_林培涵_鷄渴-就是愛喝飲料/assets/css/index.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    // post 登入
    if (isset($_POST['login'])) {
        $member = $DB->fetch("SELECT * FROM member WHERE type = '2' AND username = ?", $_POST['username']);
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
        unset($_SESSION["shop_cart"]);
    }
    ?>
    <?php include("../sub-views/frontend_header.php"); ?>

    <div class="block02" style="background-image: url(/15_林培涵_鷄渴-就是愛喝飲料/assets/img/home.jpg);">
        <div class="logo mb-3" style="width:200px;">
            <img src="/15_林培涵_鷄渴-就是愛喝飲料/assets/img/G-KER.png" alt="">
        </div>
        <h1 class="slogan" style="font-size:50px;">就 是 愛 喝 飲 料</h1>
        <?php
        if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
            echo '<h2 class="sayhello" style="color:white; width:800px;">嗨!&nbsp;' . $_SESSION['name'] . '&nbsp;你好啊!!&nbsp今天想喝什麼呢?' . '</h2>';
        } else {
            echo '
            <div class="signin mt-3">
                <h3 style="text-align:center; color:white;"><i class="bi bi-person-circle"></i>登入</h3>
                <form action="index.php" method="post" class="row g-3">
                    <label for="username" class="form-label col-12 text-white">帳號</label>
                    <input type="text" class="form-control col-12" name="username">
                    <label for="password" class="form-label col-12 text-white">密碼</label>
                    <input type="password" class="form-control col-12 mb-3" name="password">
                    <button type="submit" name="login" class="btn btn-light mb-5" id="btn" style="color:tomato; font-weight: bold;">登入</button>
                </form>   
            </div>';
        }
        ?>
        <!-- style="color:tomato; font-weight: bold;" -->
    </div>
    <?php include("../sub-views/frontend_footer.php"); ?>
    <?php include("../sub-views/common_js.php"); ?>
</body>

</html>