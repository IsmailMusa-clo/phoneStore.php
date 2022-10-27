<?php
include('../connect.php');
include('admin_auth.php');
if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_payment->execute([$payment_status, $order_id]);
    setcookie('message', 'حالة الطلب', time() + 4);
    header('location:orders.php');
}

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
                            <a href="#" class="d-block"> <a href="profile.php" class="d-block"><?= $_SESSION['admin_name'] ?></a></a>
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
        <div class="content-wrapper" style="padding-top:20px ;">
            <!-- Main content -->
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        الطلبات
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">رقم الهاتف</th>
                                    <th scope="col">طريقة الدفع</th>
                                    <th scope="col">رقم الكاونتر</th>
                                    <th scope="col">الطلبية</th>
                                    <th scope="col">المجموع</th>
                                    <th scope="col">حالة الطلب</th>
                                    <th scope="col">حذف</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                                $select_orders->execute();
                                if ($select_orders->rowCount() > 0) {
                                    $i = 1;
                                    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

                                ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $fetch_orders['name'] ?></td>
                                            <td><?= $fetch_orders['number'] ?></td>
                                            <td><?= $fetch_orders['method'] ?></td>
                                            <td><?= $fetch_orders['address'] ?></td>
                                            <td><?= $fetch_orders['total_products'] ?></td>
                                            <td><?= $fetch_orders['total_price'] ?> ريال</td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                                                    <select name="payment_status" class="select">
                                                        <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                                        <option value="تحت المعالجة" name="pending">تحت المعالجة</option>
                                                        <option value="جاري التحضير" name="processing">جاري التحضير</option>
                                                        <option value="مكتمل" name="completd">مكتمل</option>
                                                    </select>
                                            <td>

                                                <div class="flex-btn">
                                                    <input type="submit" value="تحديث" class="btn btn-success" name="update_payment">
                                                    <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="btn btn-danger" onclick="return confirm('delete this order?');"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                            </form>
                                            </td>
                                        </tr>
                                <?php

                                        $i++;
                                    }
                                } else {
                                    echo '<p class="empty">لا توجد منتجات</p>';
                                }
                                ?>
                            </tbody>
                        </table>
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