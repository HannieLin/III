<!DOCTYPE html>
<html>

<head>
    <title>菜單</title>
    <?php include("../sub-views/common_css.php"); ?>
    <link rel="stylesheet" href="/15_林培涵_鷄渴-就是愛喝飲料/assets/css/shop.css">
</head>

<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/common.php');
    include("../sub-views/frontend_header.php");
    $fruitteaList = $DB->fetchAll("SELECT * FROM product WHERE code LIKE 'FT%' ORDER BY code;");
    $taiwanList = $DB->fetchAll("SELECT * FROM product WHERE code LIKE 'TT%' ORDER BY code;");
    $spicedteaList = $DB->fetchAll("SELECT * FROM product WHERE code LIKE 'ST%' ORDER BY code;");
    $freshmilkteaList = $DB->fetchAll("SELECT * FROM product WHERE code LIKE 'FM%' ORDER BY code;");
    $milkteaList = $DB->fetchAll("SELECT * FROM product WHERE code LIKE 'MT%' ORDER BY code;");
    $vinegarteaList = $DB->fetchAll("SELECT * FROM product WHERE code LIKE 'VT%' ORDER BY code;");
    ?>
    <div id='div_session_write'></div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class=frt>
                    <h2><i class="far fa-lemon"></i>鮮&nbsp&nbsp果&nbsp&nbsp茶</h2>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($fruitteaList as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . ($row["ih"] == '3' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;"></i>&nbsp&nbsp<i class="fab fa-hotjar" style="color:red;font-size:15px;"></i>' : ($row["ih"] == '1' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;">' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                                echo '<td>' . ($row["size"] == '3' ? 'L&nbsp/&nbspM' : ($row["size"] == '1' ? 'L' : ($row["size"] == '2' ? 'M' : ''))) . '</td>';
                                echo '<td>' . $row["priceL"] . '</td>';
                                echo '<td>' . $row["priceM"] . '</td>';
                                if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                                    echo '<td><button class="btn btn-light btn-sm" style="color:tomato;" onclick="doOrder(
                                        ' . $row["id"] . ',
                                        \'' . $row["code"] . '\',
                                        \'' . $row["name"] . '\',
                                        \'' . $row["size"] . '\',
                                        \'' . $row["ih"] . '\',
                                        ' . $row["priceL"] . ',
                                        ' . $row["priceM"] . ')">點餐</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tai">
                    <h2><i class="fas fa-seedling"></i>台&nbsp&nbsp灣&nbsp&nbsp味</h2>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($taiwanList as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . ($row["ih"] == '3' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;"></i>&nbsp&nbsp<i class="fab fa-hotjar" style="color:red;font-size:15px;"></i>' : ($row["ih"] == '1' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;">' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                                echo '<td>' . ($row["size"] == '3' ? 'L&nbsp/&nbspM' : ($row["size"] == '1' ? 'L' : ($row["size"] == '2' ? 'M' : ''))) . '</td>';
                                echo '<td>' . $row["priceL"] . '</td>';
                                echo '<td>' . $row["priceM"] . '</td>';
                                if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                                    echo '<td><button class="btn btn-light btn-sm" style="color:tomato;" onclick="doOrder(
                                        ' . $row["id"] . ',
                                        \'' . $row["code"] . '\',
                                        \'' . $row["name"] . '\',
                                        \'' . $row["size"] . '\',
                                        \'' . $row["ih"] . '\',
                                        ' . $row["priceL"] . ',
                                        ' . $row["priceM"] . ')">點餐</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="mlt">
                    <h2><i class="fas fa-mug-hot"></i>嚼&nbsp&nbsp奶&nbsp&nbsp味</h2>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($milkteaList as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . ($row["ih"] == '3' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;"></i>&nbsp&nbsp<i class="fab fa-hotjar" style="color:red;font-size:15px;"></i>' : ($row["ih"] == '1' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;">' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                                echo '<td>' . ($row["size"] == '3' ? 'L&nbsp/&nbspM' : ($row["size"] == '1' ? 'L' : ($row["size"] == '2' ? 'M' : ''))) . '</td>';
                                echo '<td>' . $row["priceL"] . '</td>';
                                echo '<td>' . $row["priceM"] . '</td>';
                                if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                                    echo '<td><button class="btn btn-light btn-sm" style="color:tomato;" onclick="doOrder(
                                        ' . $row["id"] . ',
                                        \'' . $row["code"] . '\',
                                        \'' . $row["name"] . '\',
                                        \'' . $row["size"] . '\',
                                        \'' . $row["ih"] . '\',
                                        ' . $row["priceL"] . ',
                                        ' . $row["priceM"] . ')">點餐</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="fmt">
                    <h2><i class="fas fa-coffee"></i>鮮&nbsp奶&nbsp特&nbsp調</h2>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($freshmilkteaList as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . ($row["ih"] == '3' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;"></i>&nbsp&nbsp<i class="fab fa-hotjar" style="color:red;font-size:15px;"></i>' : ($row["ih"] == '1' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;">' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                                echo '<td>' . ($row["size"] == '3' ? 'L&nbsp/&nbspM' : ($row["size"] == '1' ? 'L' : ($row["size"] == '2' ? 'M' : ''))) . '</td>';
                                echo '<td>' . $row["priceL"] . '</td>';
                                echo '<td>' . $row["priceM"] . '</td>';
                                if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                                    echo '<td><button class="btn btn-light btn-sm" style="color:tomato;" onclick="doOrder(
                                        ' . $row["id"] . ',
                                        \'' . $row["code"] . '\',
                                        \'' . $row["name"] . '\',
                                        \'' . $row["size"] . '\',
                                        \'' . $row["ih"] . '\',
                                        ' . $row["priceL"] . ',
                                        ' . $row["priceM"] . ')">點餐</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="spt">
                    <h2><i class="fas fa-leaf"></i>調&nbsp&nbsp味&nbsp&nbsp茶</h2>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($spicedteaList as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . ($row["ih"] == '3' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;"></i>&nbsp&nbsp<i class="fab fa-hotjar" style="color:red;font-size:15px;"></i>' : ($row["ih"] == '1' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;">' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                                echo '<td>' . ($row["size"] == '3' ? 'L&nbsp/&nbspM' : ($row["size"] == '1' ? 'L' : ($row["size"] == '2' ? 'M' : ''))) . '</td>';
                                echo '<td>' . $row["priceL"] . '</td>';
                                echo '<td>' . $row["priceM"] . '</td>';
                                if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                                    echo '<td><button class="btn btn-light btn-sm" style="color:tomato;" onclick="doOrder(
                                        ' . $row["id"] . ',
                                        \'' . $row["code"] . '\',
                                        \'' . $row["name"] . '\',
                                        \'' . $row["size"] . '\',
                                        \'' . $row["ih"] . '\',
                                        ' . $row["priceL"] . ',
                                        ' . $row["priceM"] . ')">點餐</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="vgt">
                    <h2><i class="fas fa-glass-whiskey"></i>多&nbsp&nbsp醋&nbsp&nbsp味</h2>
                    <table class="table table-striped">
                        <tbody>
                            <?php
                            foreach ($vinegarteaList as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . ($row["ih"] == '3' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;"></i>&nbsp&nbsp<i class="fab fa-hotjar" style="color:red;font-size:15px;"></i>' : ($row["ih"] == '1' ? '<i class="bi bi-snow" style="color:blue;font-size:15px;">' : ($row["ih"] == '2' ? '熱(H)' : ''))) . '</td>';
                                echo '<td>' . ($row["size"] == '3' ? 'L&nbsp/&nbspM' : ($row["size"] == '1' ? 'L' : ($row["size"] == '2' ? 'M' : ''))) . '</td>';
                                echo '<td>' . $row["priceL"] . '</td>';
                                echo '<td>' . $row["priceM"] . '</td>';
                                if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                                    echo '<td><button class="btn btn-light btn-sm" style="color:tomato;" onclick="doOrder(
                                        ' . $row["id"] . ',
                                        \'' . $row["code"] . '\',
                                        \'' . $row["name"] . '\',
                                        \'' . $row["size"] . '\',
                                        \'' . $row["ih"] . '\',
                                        ' . $row["priceL"] . ',
                                        ' . $row["priceM"] . ')">點餐</button></td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog" title="點餐" class="dialog-default">
        <form action="shop.php" method="post" class="row g-3">
            <input type="hidden" id="hid_id" />
            <!-- <div class="col-12">
                <label class="form-label">商品代碼：</label>
                <label class="form-label" id="txt_code"></label>
            </div> -->
            <div class="col-12">
                <label for="txt_name" class="form-label">商品名稱：</label>
                <label class="form-label" id="txt_name"></label>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">大小：</label>
                <div class="form-check form-check-inline" id="div-size-l">
                    <input class="form-check-input" type="radio" name="size" value="l" id="radio-size-l">
                    <label class="form-check-label" for="radio-size-l" id="label-size-l">大(L)</label>
                </div>
                <div class="form-check form-check-inline" id="div-size-m">
                    <input class="form-check-input" type="radio" name="size" value="m" id="radio-size-m">
                    <label class="form-check-label" for="radio-size-m" id="label-size-m">小(M)</label>
                </div>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">冰溫：</label>
                <div class="form-check form-check-inline" id="div-ih-i">
                    <input class="form-check-input" type="radio" name="ih" value="i" id="radio-ih-l">
                    <label class="form-check-label" for="radio-ih-l">冰(I)</label>
                </div>
                <div class="form-check form-check-inline" id="div-ih-h">
                    <input class="form-check-input" type="radio" name="ih" value="h" id="radio-ih-m">
                    <label class="form-check-label" for="radio-ih-m">熱(H)</label>
                </div>
            </div>
            <div class="col-12">
                <label for="num" class="form-label">杯數：</label>
                <input class="form-control mb-3" type="number" id="num" min="1">
            </div>
            <div class="col-12">
                <button class="btn btn-light" type="button" onclick="goCart()" style="color: tomato; margin:0 28%;">加入購物車</button>
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
            $div_l = $('#div-size-l'),
            $div_m = $('#div-size-m'),
            $chk_l = $('#chk_l'),
            $chk_m = $('#chk_m'),
            $div_i = $('#div-ih-i'),
            $div_h = $('#div-ih-h'),
            $chk_i = $('#chk_i'),
            $chk_h = $('#chk_h'),
            $price_l = $('#label-size-l'),
            $price_m = $('#label-size-m'),
            $num = $('#num');

        function doOrder(id, code, name, size, ih, priceL, priceM) {
            $id.val(id);
            $code.text(code);
            $name.text(name);
            $div_l.removeClass('d-none');
            $div_m.removeClass('d-none');
            $chk_l.removeAttr('checked');
            $chk_m.removeAttr('checked');
            if (size == '1') {
                $chk_l.attr('checked', 'checked');
                $div_m.addClass('d-none');
                $price_l.text('L' + priceL);
            } else if (size == '2') {
                $chk_m.attr('checked', 'checked');
                $div_l.addClass('d-none');
                $price_m.text('M' + priceM);
            } else if (size == '3') {
                $chk_l.attr('checked', 'checked');
                $chk_m.attr('checked', 'checked');
                $price_l.text('L' + priceL);
                $price_m.text('M' + priceM);
            }
            $div_i.removeClass('d-none');
            $div_h.removeClass('d-none');
            $chk_i.removeAttr('checked');
            $chk_h.removeAttr('checked');
            if (ih == '1') {
                $chk_i.attr('checked', 'checked');
                $div_h.addClass('d-none');
            } else if (ih == '2') {
                $chk_h.attr('checked', 'checked');
                $div_i.addClass('d-none');
            } else if (ih == '3') {
                $chk_i.attr('checked', 'checked');
                $chk_h.attr('checked', 'checked');
            }
            $("#dialog").dialog();  
        }

        function goCart() {
            $("#dialog").dialog('close');
            jQuery('#div_session_write').load('/15_林培涵_鷄渴-就是愛喝飲料/helpers/session_write.php?type=add' +
                '&id=' + $id.val() +
                '&size=' + $('input[name=size]:checked').val() +
                '&ih=' + $('input[name=ih]:checked').val() +
                '&num=' + $num.val());
        }
    </script>
</body>

</html>