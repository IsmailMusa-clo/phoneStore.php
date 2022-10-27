<?php
include('../connect.php');
include('admin_auth.php');

if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $old_password = sha1($_POST['old_password']);
    $old_password = filter_var($old_password, FILTER_SANITIZE_STRING);
    $new_password = sha1($_POST['new_password']);
    $new_password = filter_var($new_password, FILTER_SANITIZE_STRING);

    $update_product = $conn->prepare("UPDATE `users` SET username = ?,phon=?, adrees = ? ,email = ? WHERE id = ?");
    $update_product->execute([$name, $phone, $address, $email, $id]);
    setcookie('message', 'تم ادخال التحديثات', time() + 4000);

    $select_user = $conn->prepare("SELECT pass FROM `users` WHERE username = ? AND id = ?");
    $select_user->execute([$name, $id]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    if ($select_user->rowCount() > 0) {
        if ($row['pass'] == $old_password) {
            $update_product = $conn->prepare("UPDATE `users` SET pass = ?  WHERE id = ?");
            $update_product->execute([$new_password, $id]);
            setcookie('message', 'تم ادخال التحديثات', time() + 4000);
        }
    }
    header('location:profile.php');
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
            width: 100%;
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
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="container">
                <div class="boxes">
                    <div class="card">
                        <div class="card-header">
                            تعديل البيانات الأساسية
                        </div>
                        <div class="card-body">
                            <?php
                            $user_id = $_SESSION['id'];
                            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                            $select_user->execute([$user_id]);
                            if ($select_user->rowCount() > 0) {
                                while ($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $user_id ?>">
                                        <div class="form-group">
                                            <label for="name">اسم المستخدم</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $fetch_user['username']; ?>" placeholder="اسم المستخدم">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">رقم الهاتف</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $fetch_user['phon']; ?>" placeholder="رقم الهاتف">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">العنوان </label>
                                            <input type="text" class="form-control" name="address" value="<?= $fetch_user['adrees']; ?>" placeholder=" العنوان">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">الايميل:</label>
                                            <input type="email" name="email" value="<?= $fetch_user['email']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="old_password">كلمة المرور القديمة</label>
                                            <input type="password" name="old_password" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password">كلمة المرور الجديدة</label>
                                            <input type="password" name="new_password" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="update_user" class="btn btn-success" value="تعديل" style="float:left">
                                        </div>
                                    </form>
                            <?php
                                }
                            } else {
                                echo '<p class="empty"> لا يوجد تحديث</p>';
                            }
                            ?>

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