<?php
include('../connect.php');
include('admin_auth.php');
if (isset($_POST['update_product'])) {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $video_path = $_POST['video_path'];
    $video_path = filter_var($video_path, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $update_product = $conn->prepare("UPDATE `products` SET name = ?,category_id=?, price = ? ,video_path = ? WHERE id = ?");
    $update_product->execute([$name, $category, $price, $video_path, $pid]);
    setcookie('message', 'تم ادخال التحديثات', time() + 4000);
    if (!empty($image)) {
        if ($image_size > 2000000) {
            setcookie('message', ' image size is too large!', time() + 4000);
        } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $pid]);
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/' . $old_image);
            setcookie('message', ' image updated successfully!', time() + 4000);
        }
    }
    header('location:products.php');
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
                            إضافة منتج
                        </div>
                        <div class="card-body">
                            <?php
                            $update_id = $_GET['update'];
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_products->execute([$update_id]);
                            if ($select_products->rowCount() > 0) {
                                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                                    $select_cat = $conn->prepare("SELECT title FROM `tbl_category` WHERE id='$fetch_products[category_id]'");
                                    $select_cat->execute();
                                    $fetch_cat = $select_cat->fetch(PDO::FETCH_ASSOC);

                            ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                                        <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
                                        <div class="form-group">
                                            <label for="name">اسم المنتج</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $fetch_products['name']; ?>" placeholder="اسم المنتج">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">السعر</label>
                                            <input type="number" class="form-control" id="price" name="price" value="<?= $fetch_products['price']; ?>" placeholder="اضف السعر ">
                                        </div>
                                        <div class="form-group">
                                            <label for="video_path">رابط فيديو توضيحي </label>
                                            <input type="text" class="form-control" name="video_path" value="<?= $fetch_products['video_path']; ?>" placeholder=" رابط الفيديو المضمن من اليوتيوب">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">إضافة صورة:</label>
                                            <input type="file" name="image" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">التصنيف</label>
                                            <select class="form-control" name="category" id="category">
                                                <?php
                                                $select_category = $conn->prepare("SELECT * FROM `tbl_category`");
                                                $select_category->execute();
                                                if ($select_category->rowCount() > 0) {
                                                    while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
                                                        if ($fetch_category['id'] == $fetch_products['category_id']) {
                                                ?>
                                                            <option selected value="<?= $fetch_category['id']; ?>">
                                                                <?= $fetch_category['title']; ?>
                                                            </option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?= $fetch_category['id']; ?>">
                                                                <?= $fetch_category['title']; ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                } else {
                                                    echo '<p class="empty">لا توجد تصنيفات</p>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="update_product" class="btn btn-success" style="float:left">
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