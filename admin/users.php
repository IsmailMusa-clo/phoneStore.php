<?php
include('../connect.php');
include('admin_auth.php');
if (isset($_POST['update_user_status'])) {
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    $update_status = $conn->prepare("UPDATE `users` SET situs = ? WHERE id = ?");
    $update_status->execute([$status, $user_id]);
    setcookie('message', 'حالة المستخدم', time() + 4);
    header('location:users.php');
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
                        المستخدمين
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">اسم المستخدم</th>
                                    <th scope="col">رقم الجوال</th>
                                    <th scope="col">العنوان</th>
                                    <th scope="col">الايميل</th>
                                    <th scope="col">الصلاحية</th>
                                    <th scope="col">حذف</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_users = $conn->prepare("SELECT * FROM `users`");
                                $select_users->execute();
                                if ($select_users->rowCount() > 0) {
                                    $i = 1;
                                    while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $fetch_users['username'] ?></td>
                                            <td><?= $fetch_users['phon'] ?></td>
                                            <td><?= $fetch_users['adrees'] ?></td>
                                            <td><?= $fetch_users['email'] ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $fetch_users['id']; ?>">
                                                    <select name="status" class="select">
                                                        <option selected disabled><?= $fetch_users['situs']; ?></option>
                                                        <option value="الادارة" name="admin">الادارة</option>
                                                        <option value="عميل" name="user">عميل </option>
                                                    </select>
                                            <td>
                                                <input type="submit" value="تحديث" class="btn btn-success" name="update_user_status">
                                                <a href="user_delete.php?delete=<?= $fetch_users['id']; ?>" class=" btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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