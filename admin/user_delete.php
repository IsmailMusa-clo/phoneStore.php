<?php
session_start();
include('../connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    $delete_user->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:users.php');
}
?>