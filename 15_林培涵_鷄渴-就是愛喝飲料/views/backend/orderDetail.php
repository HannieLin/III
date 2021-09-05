<!DOCTYPE html>
<html>

<head>
    <title>訂單明細</title>
    <?php include("../sub-views/common_css.php"); ?>
</head>

<body >
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/backend_header.php");

    // 網址沒傳id 導回訂單頁
    if (!isset($_GET['id'])) {
        header("Location: orders.php");
    }

    $id = $_GET['id'];

    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        $sql = "UPDATE orders SET status = ? WHERE id = ?;";
        $DB->execute($sql, array($status, $id));
        phpAlert("修改成功");
    }

    $order = $DB->fetch("SELECT * FROM orders WHERE id = ?", $id);
    $details = $DB->fetchAll("SELECT 
            p.code,
            p.name,
            o.size,
            o.ih,
            o.price,
            o.num,
            o.amount
        FROM order_detail o
        LEFT JOIN product p
            ON p.id = o.productId 
        WHERE o.orderId = ?", $id);
    ?>

    <div class="container mt-5 mb-5">
        <h3>訂單明細</h3>
        <b>訂單時間 : </b><?php echo $order['orderDate']; ?><br>
        <b>訂單類型 : </b><?php echo ($order["type"] == '1' ? '自取' : ($order["type"] == '2' ? '外送' : '')); ?><br>
        <b>姓&ensp;&ensp;&ensp;&ensp;名 : </b><?php echo $order['name']; ?><br>
        <b>電&ensp;&ensp;&ensp;&ensp;話 : </b><?php echo $order['tel']; ?><br>
        <b>地&ensp;&ensp;&ensp;&ensp;址 : </b><?php echo $order['address']; ?><br>
        <!-- <b>狀&ensp;&ensp;&ensp;&ensp;態 : </b><br> -->
        <form action="orderDetail.php?id=<?php echo $id; ?>" method="post" class="row g-3">
            <input type="hidden" name="id" <?php echo 'value="' . $id . '"'; ?> />
            <div class="col-12">
                <label for="inputAddress" class="form-label"><b>訂單狀態 : </b> </label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="0" id="radio0" <?php echo ($order["status"] == '0' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio0">已下單</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="1" id="radio1" <?php echo ($order["status"] == '1' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio1">製作中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="2" id="radio2" <?php echo ($order["status"] == '2' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio2">可取餐 / 外送中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="3" id="radio3" <?php echo ($order["status"] == '3' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio3">已完成</label>
                </div>
                <button type="submit" type="status" class="btn btn-primary btn-sm">儲存狀態</button>
            </div>
        </form>
        <b>總價 : </b><?php echo $order['amount']; ?>
        <table class="table table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th>商品代碼</th>
                    <th>商品名稱</th>
                    <th>大小</th>
                    <th>冰溫</th>
                    <th>單價</th>
                    <th>數量</th>
                    <th>總價</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($details as $row) {
                    echo '<tr>';
                    echo '<td>' . $row["code"] . '</td>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . ($row["size"] == 'l' ? '大(L)' : ($row["size"] == 'm' ? '小(M)' : '')) . '</td>';
                    echo '<td>' . ($row["ih"] == 'i' ? '冰(I)' : ($row["ih"] == 'h' ? '熱(H)' : '')) . '</td>';
                    echo '<td>' . $row["price"] . '</td>';
                    echo '<td>' . $row["num"] . '</td>';
                    echo '<td>' . $row["amount"] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include("../sub-views/common_js.php"); ?>

    <script>
        $(function() {

        });
    </script>
</body>

</html>