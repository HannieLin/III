<!DOCTYPE html>
<html>

<head>
    <title>商品</title>
    <?php include("../sub-views/common_css.php"); ?>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/backend_header.php");

    if (isset($_POST['create']) || isset($_POST['update'])) {
        $code = $_POST['code'];
        $name = $_POST['name'];
        $size = isset($_POST['size-l']) && isset($_POST['size-m']) ? '3' : (isset($_POST['size-l']) ? '1' : (isset($_POST['size-m']) ? '2' : ''));
        $ih = isset($_POST['ih-i']) && isset($_POST['ih-h']) ? '3' : (isset($_POST['ih-i']) ? '1' : (isset($_POST['ih-h']) ? '2' : ''));
        $priceL = $size == '1' || $size == '3' ? $_POST['price-l'] : NULL;
        $priceM = $size == '2' || $size == '3' ? $_POST['price-m'] : NULL;

        if (isset($_POST['create'])) {
            $sql = "INSERT INTO product (code, name, size, ih, priceL, priceM) VALUES (?, ?, ?, ?, ?, ?);";
            $DB->execute($sql, array($code, $name, $size, $ih, $priceL, $priceM));
            phpAlert("新增成功");
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $sql = "UPDATE product SET code = ?, name = ?, size = ?, ih = ?, priceL = ?, priceM = ? WHERE id = ?;";
            $DB->execute($sql, array($code, $name, $size, $ih, $priceL, $priceM, $id));
            phpAlert("修改成功");
        }
    } else if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM product WHERE id = ?;";
        $DB->execute($sql, array($id));
        phpAlert("刪除成功");
    }

    /*
    if (isset($_POST['search-code']) || isset($_POST['search-name'])) {
        $sql = "SELECT * FROM product WHERE ";
        $params = array();
        if (isset($_POST['search-code'])) {
            $sql .= "code = ? ";
            $params . array_push("%".$_POST['search-code']."%");
        }
        if (isset($_POST['search-name'])) {
            $sql .= "name LIKE ? ";
            $params . array_push("%".$_POST['search-name']."%");
        }
    } else {
        $products = $DB->fetchAll("SELECT * FROM product;");
    }
    */

    $products = $DB->fetchAll("SELECT * FROM product ORDER BY code;");

    ?>

    <div class="container mt-5">
        <!-- <h1>商品</h1> -->
        <!--
        <form action="product.php" method="post" class="row g-3">
            <div class="col-12">
                <label for="search-code" class="form-label">商品代碼：</label>
                <input type="text" class="form-control" name="search-code">
            </div>
            <div class="col-12">
                <label for="search-name" class="form-label">商品名稱：</label>
                <input type="text" class="form-control" name="search-name">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">查詢</button>
            </div>
        </form>
        -->
        <h5 style="display: inline;">查詢結果，共 <?php echo count($products) ?> 筆</h5>
        <button style="display: inline;" class="btn btn-info btn-sm" onclick="doCreate()">新增</button>
        <table class="table table-striped table-hover mt-4 mb-5">
            <thead>
                <tr>
                    <th>商品代碼</th>
                    <th>商品名稱</th>
                    <th>大小</th>
                    <th>冰溫</th>
                    <th>大杯單價</th>
                    <th>小杯單價</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $row) {
                    echo '<tr>';
                    echo '<td>' . $row["code"] . '</td>';
                    echo '<td>' . $row["name"] . '</td>';
                    echo '<td>' . ($row["size"] == '3' ? '大(L) 小(M)' : ($row["size"] == '1' ? '大(L)' : ($row["size"] == '2' ? '小(M)' : ''))) . '</td>';
                    echo '<td>' . ($row["ih"] == '3' ? '冰(I) 熱(H)' : ($row["ih"] == '1' ? '冰(I)' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                    echo '<td>' . $row["priceL"] . '</td>';
                    echo '<td>' . $row["priceM"] . '</td>';
                    echo '<td><button class="btn btn-primary btn-sm mr-3" onclick="doUpdate(
                    ' . $row["id"] . ',
                    \'' . $row["code"] . '\',
                    \'' . $row["name"] . '\',
                    \'' . $row["size"] . '\',
                    \'' . $row["ih"] . '\',
                    ' . $row["priceL"] . ',
                    ' . $row["priceM"] . ')">編輯</button>';
                    echo '<button class="btn btn-danger btn-sm" onclick="doDelete(' . $row["id"] . ')">刪除</button></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="dialog" title="商品" class="dialog-default">
        <form action="product.php" method="post" class="row g-3">
            <input type="hidden" name="id" id="hid_id" />
            <div class="col-12 mb-4">
                <label for="txt_code" class="form-label">商品代碼：</label>
                <input type="text" class="form-control" name="code" id="txt_code">
            </div>
            <div class="col-12 mb-4">
                <label for="txt_name" class="form-label">商品名稱：</label>
                <input type="text" class="form-control" name="name" id="txt_name">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">大小：</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="size-l" type="checkbox" id="chk_l">
                    <label class="form-check-label" for="chk_l">
                        大(L)
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="size-m" type="checkbox" id="chk_m">
                    <label class="form-check-label" for="chk_m">
                        小(M)
                    </label>
                </div>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">冰溫：</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="ih-i" type="checkbox" id="chk_i">
                    <label class="form-check-label" for="chk_i">
                        冰(I)
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="ih-h" type="checkbox" id="chk_h">
                    <label class="form-check-label" for="chk_h">
                        熱(H)
                    </label>
                </div>
            </div>
            <div class="col-6">
                <label for="num_price_l" class="form-label">大杯價格</label>
                <input type="number" class="form-control" name="price-l" id="num_price_l">
            </div>
            <div class="col-6 mb-3">
                <label for="num_price_m" class="form-label">小杯價格</label>
                <input type="number" class="form-control" name="price-m" id="num_price_m">
            </div>
            <div class="col-12">
                <button id="btn_submit" type="submit" class="btn btn-primary">儲存</button>
            </div>
        </form>
    </div>

    <?php include("../sub-views/common_js.php"); ?>

    <script>
        $(function() {

        });

        var $btn = $('#btn_submit'),
            $id = $('#hid_id'),
            $code = $('#txt_code'),
            $name = $('#txt_name'),
            $chk_l = $('#chk_l'),
            $chk_m = $('#chk_m'),
            $chk_i = $('#chk_i'),
            $chk_h = $('#chk_h'),
            $price_l = $('#num_price_l'),
            $price_m = $('#num_price_m');

        function doCreate() {
            $btn.attr('name', 'create');
            $id.val("");
            $code.val("");
            $name.val("");
            $chk_l.removeAttr('checked');
            $chk_m.removeAttr('checked');
            $chk_i.removeAttr('checked');
            $chk_h.removeAttr('checked');
            $price_l.val("");
            $price_m.val("");

            $("#dialog").dialog();
        }

        function doUpdate(id, code, name, size, ih, priceL, priceM) {
            $btn.attr('name', 'update');
            $id.val(id);
            $code.val(code);
            $name.val(name);
            $chk_l.removeAttr('checked');
            $chk_m.removeAttr('checked');
            if (size == '1') {
                $chk_l.attr('checked', 'checked');
            } else if (size == '2') {
                $chk_m.attr('checked', 'checked');
            } else if (size == '3') {
                $chk_l.attr('checked', 'checked');
                $chk_m.attr('checked', 'checked');
            }
            $chk_i.removeAttr('checked');
            $chk_h.removeAttr('checked');
            if (ih == '1') {
                $chk_i.attr('checked', 'checked');
            } else if (ih == '2') {
                $chk_h.attr('checked', 'checked');
            } else if (ih == '3') {
                $chk_i.attr('checked', 'checked');
                $chk_h.attr('checked', 'checked');
            }
            $price_l.val(priceL);
            $price_m.val(priceM);

            $("#dialog").dialog();
        }

        function doDelete(id) {
            $btn.attr('name', 'delete');
            $id.val(id);
            $btn.click();
        }
    </script>
</body>

</html>