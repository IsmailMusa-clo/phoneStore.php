<?php

include('../connect.php');
include('admin_auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>لوحة التحكم بسيطة</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="../css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="../css/custom-style.css">
    <style>
        .content-wrapper .boxes {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding-top: 30px;
        }

        .content-wrapper .boxes .card {
            height: 12rem;
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard.php" class="nav-link">الصفحة الرئيسية</a>
                </li>

            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="بحث..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../images/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">لوحة التحكم</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                        <div class="info">
                            <a href="profile.php" class="d-block"><?= $_SESSION['admin_name'] ?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    <p>
                                        قائمة الصفحات
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="products.php" class="nav-link active">
                                            <p>المنتجات</p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="users.php" class="nav-link">
                                            <p>المستخدمين</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="orders.php" class="nav-link">
                                            <p>الطلبات</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="category.php" class="nav-link">
                                            <p>التصنيفات</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="cat_add.php" class="nav-link">
                                            <p>إضافة تصنيف</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="add_products.php" class="nav-link">
                                            <p>إضافة منتج</p>
                                        </a>
                                    </li>

                            </li>
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link">
                                    <p>تغيير كلمة المرور</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fa fa-sign-in"></i>
                                <p>
                                    تسجيل خروج
                                </p>
                            </a>
                        </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="container">
                <div class="boxes">

                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> طلبات معلقة</h5>
                            <?php
                            $total_pendings = 0;
                            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                            $select_pendings->execute(['تحت المعالجة']);
                            if ($select_pendings->rowCount() > 0) {
                                while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                                    $total_pendings += $fetch_pendings['total_price'];
                                }
                            }
                            ?>
                            <h3> <?= $total_pendings; ?> \ ريال </h3>
                            <a href="orders.php" class="btn">انظر الى الطلبات</a>
                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> طلبات مكتملة</h5>
                            <?php
                            $total_completes = 0;
                            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
                            $select_completes->execute(['مكتمل']);
                            if ($select_completes->rowCount() > 0) {
                                while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                                    $total_completes += $fetch_completes['total_price'];
                                }
                            }
                            ?>
                            <h3><?= $total_completes; ?> \ ريال </h3>
                            <a href="orders.php" class="btn">انظر الى الطلبات</a>

                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> الطلبات</h5>
                            <?php
                            $select_orders = $conn->prepare("SELECT * FROM `orders`");
                            $select_orders->execute();
                            $number_of_orders = $select_orders->rowCount();
                            ?>
                            <p class="card-text">عدد الطلبات : <?= $number_of_orders ?> طلب</p>
                            <a href="orders.php" class="card-link">عرض الطلبات</a>
                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> المستخدمين</h5>
                            <?php
                            $select_users = $conn->prepare("SELECT * FROM `users`");
                            $select_users->execute();
                            $number_of_users = $select_users->rowCount();
                            ?>
                            <p class="card-text">عدد المستخدمين : <?= $number_of_orders ?> مستخدم</p>
                            <a href="users.php" class="card-link">عرض المستخدمين</a>
                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> المنتجات</h5>
                            <?php
                            $select_products = $conn->prepare("SELECT * FROM `products`");
                            $select_products->execute();
                            $number_of_products = $select_products->rowCount();
                            ?>
                            <p class="card-text">عدد المنتجات : <?= $number_of_products ?> منتج</p>
                            <a href="products.php" class="card-link">عرض المنتجات</a>
                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> المنتجات</h5>
                            <p class="card-text">إضافة منتج</p>
                            <a href="add_products.php" class="card-link">إضافة</a>
                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title"> البروفايل</h5>
                            <p class="card-text"> تعديل كلمة المرور </p>
                            <a href="profile.php" class="card-link">انتقال </a>
                        </div>
                    </div>
                    <div class="card" style="width: 14rem;padding:20px">
                        <div class="card-body">
                            <h5 class="card-title">التصنيفات</h5>
                            <?php
                            $select_cats = $conn->prepare("SELECT * FROM `tbl_category`");
                            $select_cats->execute();
                            $number_of_cats = $select_cats->rowCount();
                            ?>
                            <p class="card-text">عدد التصنيفات:<?= $number_of_cats ?> </p>
                            <a href="category.php" class="card-link">انتقال </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>CopyLeft &copy; 2018 <a href="">هاني</a>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
</body>