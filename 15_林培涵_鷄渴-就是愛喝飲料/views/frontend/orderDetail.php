<!DOCTYPE html>
<html>

<head>
    <title>訂單明細</title>
    <?php include("../sub-views/common_css.php"); ?>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/frontend_header.php");

    // 網址沒傳id 導回訂單頁
    if (!isset($_GET['id'])) {
        header("Location: orders.php");
    }

    $id = $_GET['id'];

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

    <div class="container mt-5 p-4 mb-5" style="border: solid 1px rgb(195, 207, 219); border-radius:15px;box-shadow: 5px 5px 10px rgb(175, 167, 167);">
        <h3>訂單明細</h3>
        <hr>
        <b>訂單時間 : </b><?php echo $order['orderDate']; ?><br>
        <b>訂單類型 : </b><?php echo ($order["type"] == '1' ? '自取' : ($order["type"] == '2' ? '外送' : '')); ?><br>
        <b>姓&ensp;&ensp;&ensp;&ensp;名 : </b><?php echo $order['name']; ?><br>
        <b>電&ensp;&ensp;&ensp;&ensp;話 : </b><?php echo $order['tel']; ?><br>
        <b>地&ensp;&ensp;&ensp;&ensp;址 : </b><?php echo $order['address']; ?><br>
        <b>狀&ensp;&ensp;&ensp;&ensp;態 : </b> <?php echo $order["status"] == '0' ? '已下單' : ($order["status"] == '1' ? '製作中' : ($order["status"] == '2' ? '可取餐 / 外送中' : ($order["status"] == '3' ? '已完成' : ''))); ?><br>
        <b>總&ensp;&ensp;&ensp;&ensp;價 : </b> <?php echo $order['amount']; ?>
        <table class="table table-striped table-hover mt-5">
            <thead>
                <tr>
                    <!-- <th>商品代碼</th> -->
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
                    // echo '<td>' . $row["code"] . '</td>';
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