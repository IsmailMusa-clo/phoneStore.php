<?php
session_start();
include('../connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_cart = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:orders.php');
}
