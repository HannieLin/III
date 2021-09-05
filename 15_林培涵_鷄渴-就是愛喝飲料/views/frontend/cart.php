<!DOCTYPE html>
<html>

<head>
    <title>購物車</title>
    <?php include("../sub-views/common_css.php"); ?>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/frontend_header.php");

    /* 查詢購物車 */

    $orderList = array();
    $productList = array();
    if (
        !isset($_SESSION['shop_cart']) ||
        !is_array($_SESSION['shop_cart']) ||
        count($_SESSION['shop_cart']) == 0
    ) {
        // 空購物車
    } else {
        $orderList = $_SESSION['shop_cart'];

        $idArr = array();
        $condArr = array();
        foreach ($orderList as &$value) {
            array_push($idArr, $value['id']);
            array_push($condArr, '?');
        }

        $productList = $DB->fetchAll("
            SELECT 
            id, code, name, priceL, priceM 
            FROM product 
            WHERE id IN (" . implode(", ", $condArr) . ") 
            ORDER BY code;", $idArr);
    }

    $cart = array();

    foreach ($orderList as $row) {
        $pdt = array();
        foreach ($productList as $product) {
            if ($product['id'] == $row['id']) {
                $pdt = $product;
            }
        }

        array_push($cart, array(
            'id' => $row['id'],
            'code' => $pdt['code'],
            'name' => $pdt['name'],
            'size' => $row['size'],
            'ih' => $row['ih'],
            'num' => $row['num'],
            'price' => $row['size'] == 'l' ? $pdt['priceL'] : ($row['size'] == 'm' ? $pdt['priceM'] : 0),
            'amount' => $row['size'] == 'l' ? (intval($pdt['priceL']) * intval($row['num'])) : ($row['size'] == 'm' ? (intval($pdt['priceM']) * intval($row['num'])) : 0)
        ));
    }

    /* */

    /* 處理訂單部分 */
    if (isset($_POST['order'])) {

        /* orders部分 */
        $memberId = $_SESSION["userid"];
        $type = $_POST['type'];
        $name = $_POST['memberName'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        $amount = $_POST['amount'];

        $sql = "INSERT INTO orders (memberId, type, name, tel, address, status, orderDate, amount) VALUES (?, ?, ?, ?, ?, '0', NOW(), ?);";
        $DB->execute($sql, array($memberId, $type, $name, $tel, $address, $amount));

        $orderId = $DB->lastInsertId();

        /* orderDetail部分 */
        foreach ($cart as $row) {
            $sql = "INSERT INTO order_detail (orderId, productId, size, ih, price, num, amount) VALUES (?, ?, ?, ?, ?, ?, ?);";
            $DB->execute($sql, array($orderId, $row['id'], $row['size'], $row['ih'], $row['price'], $row['num'], $row['amount']));
        }

        unset($_SESSION['shop_cart']);
        phpAlert("新增訂單完成，請等候店家處理。");
        header("Location: orders.php");
    }

    /* */

    ?>

    <div id='div_session_write'></div>

    <div class="container mt-5" style="border: solid 1px rgb(195, 207, 219); border-radius:15px;box-shadow: 5px 5px 10px rgb(175, 167, 167);">
        <h4 class="mt-4"><i class="bi bi-cart4"></i>購物車</h4>
        <table class="table table-striped table-hover mt-4 mb-4">
            <thead>
                <tr>
                    <!-- <th>商品代碼</th> -->
                    <th>商品名稱</th>
                    <th>大小</th>
                    <th>冰溫</th>
                    <th>單價</th>
                    <th>數量</th>
                    <th>金額</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $amount = 0;
                if (count($cart) > 0) {
                    foreach ($cart as $row) {
                        echo '<tr class="cartlist">';
                        // echo '<td>' . $row["code"] . '</td>';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . ($row["size"] == 'l' ? '大(L)' : ($row["size"] == 'm' ? '小(M)' : '')) . '</td>';
                        echo '<td>' . ($row["ih"] == 'i' ? '冰(I)' : ($row["ih"] == 'h' ? '熱(H)' : '')) . '</td>';
                        echo '<td>' . $row["price"] . '</td>';
                        echo '<td>' . $row["num"] . '</td>';
                        echo '<td>' . $row["amount"] . '</td>';
                        echo '<td>
                            <button class="btn btn-light btn-sm" style="color:tomato;" 
                                onclick="doDelete(' . $row["id"] . ', 
                                \'' . $row["size"] . '\', 
                                \'' . $row["ih"] . '\')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </td>';
                        echo '</tr>';
                        $amount += intval($row["amount"]);
                    }
                    //金額總計
                    echo '<tr>';
                    // echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td>合計</td>';
                    echo '<td>' . $amount . '</td>';
                    echo '<td></td>';
                    echo '</tr>';
                } else {
                    echo '<tr><td colspan="8">購物車空無一物，快去點餐吧!!!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5 p-3 mb-5" style="border: solid 1px rgb(195, 207, 219); border-radius:15px;box-shadow: 5px 5px 10px rgb(175, 167, 167);">
        <h4><i class="bi bi-card-text"></i>訂購資訊</h4>
        <hr>
        <form id="myform" action="cart.php" method="post">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <div class="col-12">
                <!-- <label for="inputAddress" class="form-label">類型：</label> -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="1" id="radio-type-1">
                    <label class="form-check-label" for="radio-type-1">自取</label>
                </div>
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="radio" name="type" value="2" id="radio-type-2">
                    <label class="form-check-label" for="radio-type-2">外送</label>
                </div>
            </div>
            <div style="display:flex;">
                <div class="col-6">
                    <label for="memberName" class="form-label">姓名：</label>
                    <input type="text" class="form-control mb-3" name="memberName" <?php echo 'value="' . $_SESSION['name'] . '"' ?>>
                </div>
                <div class="col-6">
                    <label for="tel" class="form-label-inline">電話：</label>
                    <input type="text" class="form-control mb-3" name="tel">
                </div>
            </div>
            <div class="col-12">
                <label for="address" class="form-label">地址：</label>
                <input type="text" class="form-control mb-4" name="address">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" name="order" class="btn btn-light" style="color: tomato;">送出訂單</button>
            </div>
        </form>
    </div>


    <?php include("../sub-views/common_js.php"); ?>

    <script>
        $("#myform").submit(function(event) {
            var findError = false;
            if ($('input[name="type"]:checked').val() == undefined) {
                alert("請選擇取餐類型");
                findError = true;
            }
            if ($('input[name ="memberName"]').val() == "") {
                alert("請輸入姓名");
                findError = true;
            }

            if ($('input[name ="tel"]').val() == "") {
                alert("請輸入電話");
                findError = true;
            }
            if (findError) {
                event.preventDefault();
            }
            console.log($('input[name="type"]:checked').val());
            console.log($('input[name ="memberName"]').val());
            console.log($('input[name ="tel"]').val());
            console.log($('input[name ="address"]').val());

        });

        function doDelete(id, size, ih) {
            jQuery('#div_session_write').load('/15_林培涵_鷄渴-就是愛喝飲料/helpers/session_write.php?type=delete' +
                '&id=' + id +
                '&size=' + size +
                '&ih=' + ih);
            location.reload();
        }
    </script>
</body>

</html>