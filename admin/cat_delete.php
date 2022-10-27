<?php
session_start();
include('../connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_cat = $conn->prepare("DELETE FROM `tbl_category` WHERE id = ?");
    $delete_cat->execute([$delete_id]);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE category_id = ?");
    $delete_product->execute([$delete_id]);
    header('location:category.php');
}
?>