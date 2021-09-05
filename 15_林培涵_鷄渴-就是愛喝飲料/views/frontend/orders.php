<!DOCTYPE html>
<html>

<head>
    <title>訂單</title>
    <?php include("../sub-views/common_css.php"); ?>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/frontend_header.php");

    // 查詢條件
    $orders = array();
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        $orders = $DB->fetchAll("SELECT * FROM orders WHERE memberId = ? ORDER BY orderDate DESC;", $_SESSION["userid"]);
    }

    ?>

    <div class="m-4 mt-5 p-3"style="border: solid 1px rgb(195, 207, 219); border-radius:15px;box-shadow: 5px 5px 10px rgb(175, 167, 167);">
        <h4><i class="fas fa-clipboard-list"></i>訂單</h4>
        <hr>
        <h5>查詢結果，共 <?php echo count($orders) ?> 筆</h4>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>訂單時間</th>
                    <th>訂單類型</th>
                    <th>姓名</th>
                    <th>電話</th>
                    <th>地址</th>
                    <th>狀態</th>
                    <th>總價</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orders as $row) {
                    echo '<tr>';
                    echo '<td>' . $row["orderDate"] . '</td>';
                    echo '<td>' . ($row["type"] == '1' ? '自取' : ($row["type"] == '2' ? '外送' : '')) . '</td>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . $row["tel"] . '</td>';
                    echo '<td>' . $row["address"] . '</td>';
                    echo '<td>' . ($row["status"] == '0' ? '已下單' : ($row["status"] == '1' ? '製作中' : ($row["status"] == '2' ? '可取餐 / 外送中' : ($row["status"] == '3' ? '已完成' : '')))) . '</td>';
                    echo '<td>' . $row["amount"] . '</td>';
                    echo '<td><a class="btn btn-light btn-sm" style="color:tomato;" href="orderDetail.php?id=' . $row["id"] . '">明細</a></td>';
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