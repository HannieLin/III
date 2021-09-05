<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/15_林培涵_鷄渴-就是愛喝飲料/helpers/db.php');

session_start();

function phpAlert($msg)
{
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}