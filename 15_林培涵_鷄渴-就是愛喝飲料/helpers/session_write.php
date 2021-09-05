<?php
include($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');

$arr = array();

// 新增購物車項目
if ($_GET["type"] == 'add') {
    $GET_id = $_GET["id"];
    $GET_size = $_GET["size"];
    $GET_ih = $_GET["ih"];
    $GET_num = $_GET["num"];
    if (isset($_SESSION['shop_cart'])) {
        $arr = $_SESSION['shop_cart'];
    }

    if (array_key_exists($GET_id . $GET_size . $GET_ih, $arr)) {
        // 現有商品組合數量累加
        $arr[$GET_id . $GET_size . $GET_ih]['num'] += $GET_num;
        // echo '存在該商品' . $arr[$GET_id . $GET_size . $GET_ih]['id'];
    } else {
        //該商品為新商品新增到購物車
        $arr0 = array($GET_id . $GET_size . $GET_ih => array('id' => $GET_id, 'size' => $GET_size, 'ih' => $GET_ih, 'num' => $GET_num));
        foreach ($arr0 as $key => $value) {
            $arr[$key] = $value;
        }
    }
    //新增完成後，重新把二維陣列更新到session
    $_SESSION['shop_cart'] = $arr;

    phpAlert("加入購物車成功！");
}

if ($_GET["type"] == 'delete') {
    $GET_id = $_GET["id"];
    $GET_size = $_GET["size"];
    $GET_ih = $_GET["ih"];
    if (isset($_SESSION['shop_cart'])) {
        $arr = $_SESSION['shop_cart'];
    }
    unset($arr[$GET_id . $GET_size . $GET_ih]);
    //刪除完成後，重新把二維陣列更新到session
    $_SESSION['shop_cart'] = $arr;
    phpAlert("刪除成功！");
}
