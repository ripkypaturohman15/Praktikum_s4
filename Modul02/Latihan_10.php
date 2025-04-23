<?php

require_once "Latihan_06.php";

$alumni = new Alumni();

if (isset($_GET["id"])) {
    $alumni->id = $_GET["id"];

    if ($alumni->delete()) {
        header("Location: Latihan_06.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak diberikan!";
}
?>
