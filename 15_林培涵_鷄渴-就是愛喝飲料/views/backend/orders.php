<!DOCTYPE html>
<html>

<head>
    <title>訂單</title>
    <?php include("../sub-views/common_css.php"); ?>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/backend_header.php");

    // 查詢條件
    $orders;
    $status = 'a';
    if (isset($_POST['search'])) {
        $status = $_POST['status'];
        if ($status != 'a') {
            $orders = $DB->fetchAll("SELECT * FROM orders WHERE status = ? ORDER BY orderDate DESC;", $status);
        } else {
            $orders = $DB->fetchAll("SELECT * FROM orders ORDER BY orderDate DESC;");
        }
    } else {
        $orders = $DB->fetchAll("SELECT * FROM orders ORDER BY orderDate DESC;");
    }
    ?>

    <div class="m-5">
        <!-- <h1>訂單</h1> -->
        <form action="orders.php" method="post" class="row g-3 mt-5 mb-4">
            <div class="col-12">
                <label for="inputAddress" class="form-label">訂單狀態：</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="a" id="radioall" <?php echo ($status == 'a' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radioall">全部</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="0" id="radio0" <?php echo ($status == '0' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio0">已下單</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="1" id="radio1" <?php echo ($status == '1' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio1">製作中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="2" id="radio2" <?php echo ($status == '2' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio2">可取餐 / 外送中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="3" id="radio3" <?php echo ($status == '3' ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="radio3">已完成</label>
                </div>
                <button type="submit" name="search" class="btn btn-primary btn-sm">查詢</button>
            </div>
        </form>
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
                        echo '<td><a class="btn btn-primary btn-sm" href="orderDetail.php?id=' . $row["id"] . '">明細</a></td>';
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