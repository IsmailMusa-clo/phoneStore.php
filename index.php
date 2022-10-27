<?php
include('connect.php');
session_start();
if (isset($_POST['add_to_cart'])) {
  $client_username = $_SESSION['user_name'];
  if (!isset($client_username)) {
    setcookie('message', 'سجل الدخول اولا', time() + 4);
    header('location:login.php');
  };
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الصفحة الرئيسية</title>

  <!-- Fontawesome V 4.7 Css -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Css Plugin Owl Slider Files -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <!-- Bootstrap V3 Vss File -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- My Style Css -->
  <link rel="stylesheet" href="css/style.css">
  <style>
    .search-form {
      text-align: center;
      padding: 50px 0px;
    }

    .search-form input[type='search'] {
      width: 250px;
      height: 35px;
      background-color: #fff;
      box-shadow: 0px 0px 14px 0.4px rgba(0, 0, 0, 0.1);
      border-radius: 3px;
      color: #333;
      font-size: 17px;
      padding: 10px;
      margin-right: 5px;
    }

    .search-form select {
      width: 80px;
      height: 35px;
      background-color: #fff;
      box-shadow: 0px 0px 14px 0.4px rgba(0, 0, 0, 0.1);
      border-radius: 3px;
      color: #333;
      font-size: 14px;
      padding: 8px;
      margin-right: 5px;
    }
  </style>
  <!--[if lt IE 9]>
        <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
      <![endif]-->

</head>

<body>

  <!-- Start hedar -->
  <header>
    <!-- Start nav -->
    <nav>
      <div class="container">
        <div class="content">
          <a href="index.php" title="PHONE SHOP"><img src="images/nav/logo.png" alt=""></a>
          <ul>
            <li><a href="#">الصفحة الرئيسية</a></li>
            <li><a href="#products" id="">المنتجات</a></li>
            <li><a href="login.php" id="">تسجيل دخول</a></li>
            <li><a href="#contact" id="">تواصل معنا</a></li>
          </ul>
          <div class="iconNav">
            <a href="login.php" title="تسوق الآن"><i class="fa fa-shopping-cart"></i></a>
            <a href="login.php" title="تسجيل الدخول"><i class="fa fa-sign-in"></i></a>
          </div>
          <div class="faBars">
            <i class="fa fa-bars"></i>
          </div>
        </div>
      </div>
    </nav>

    <div class="togelNav">
      <i class="fa fa-times-circle"></i>
      <ul>
        <li><a href="#">الصفحة الرئيسية</a></li>
        <li><a href="#products">المنتجات</a></li>
        <li><a href="login.php">تسجيل الدخول</a></li>
        <li><a href="#contact">تواصل معنا</a></li>
      </ul>
    </div>
    <!-- End nav -->
    <!-- Start slider -->
    <section class="sliders">
      <div class="container">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img style="background: url('images/slider/1.jpg') no-repeat;">
            </div>
            <div class="item">
              <img style="background: url('images/slider/2.jpg') no-repeat;">
            </div>
            <div class="item">
              <img style="background: url('images/slider/4.jpg') no-repeat;">
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </section>
    <!-- End slider -->
  </header>
  <!-- End hedar -->
  <!-- *********************** -->

  <!-- Start body -->
  <!-- Start section products -->
  <!-- Start section products -->
  <section id="products" class="products">
    <div class="container">
      <h1>المنـتـجــات</h1>
      <form class="search-form" method="post">
        <input type="search" name="search" id="search" placeholder="ابحث هنا">
      </form>
      <div class="content">
        <div class="boxs" id="product_list"></div>
        <div class="boxs" id="main_show">
          <?php
          $select_products = $conn->prepare("SELECT * FROM `products`");
          $select_products->execute();
          if ($select_products->rowCount() > 0) {
            $s = 1;
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
          ?>
              <div class="box">
                <img src="admin/uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                <div class="product">
                  <p>اسم المنتج: <span> <?= $fetch_products['name'] ?></span></p>
                  <p>السعر: <span> <?= $fetch_products['price'] ?></span></p>
                </div>
                <form action="" method="post">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id'] ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name'] ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price'] ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image'] ?>">
                  <input type="number" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1" name="qty" placeholder="أدخل عدد القطع التي تريد إضافتها">
                  <input type="submit" class="btn btn-info" style="width:80px" name="add_to_cart" value="إضافة ">
                </form>
                <button class="btn btn-info" style="width:100%;margin-top:10px" data-toggle="modal" data-target="#exampleModal<?=$s?>">فيديو توضيحي للمنتج</button>
                <!-- Button trigger modal -->

              </div>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?=$s?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal<?=$s?>Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModal<?=$s?>Label">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div><?= $fetch_products['video_path']?></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end modal -->
          <?php
              $s++;
            }
          } else {
            echo '<p class="empty">لا توجد منتجات مضافة</p>';
          }
          ?>
        </div>
      </div>
  </section>
  <!-- End section products -->

  <!--  Start section Connect us -->
  <section id="contact" class="ConnectUs" style="background-image: url('images/footer-bg.jpg')">
    <div class="container">
      <div class="content">
        <div class="connect">
          <img src="images/nav/logo.png" alt="">
          <p><span>
              <i class="fa fa-map-marker"></i>
            </span>
            السعودية ، الرياض ، عمارة الحسن ، الطابق الثالث.
          </p>
          <p><span>
              <i class="fa fa-phone"></i>
            </span>
            +966 55 969 7019
          </p>
          <p><span>
              <i class="fa fa-whatsapp"></i>
            </span>
            +966 55 969 7019
          </p>
          <a href="#"><span>
              <i class="fa fa-envelope"></i>
            </span>
            Hahi@gmail.com
          </a>
        </div>
        <div class="links">
          <h5>المنتجات</h5>
          <a href="#"> ▸ الجوالات</a>
          <a href="#"> ▸ الشواحن</a>
          <a href="#"> ▸ الحمايات</a>
          <a href="#"> ▸ قطع الغيار</a>
          <a href="#"> ▸ الصيانة</a>
        </div>
        <div class="around">
          <h5>حول الموقع</h5>
          <p>الموقع مخصص لبيع قطع الهواتف الذكية لماركات عالمية مثل: أبل، سامسونج، LG، هواوي، جوجل، ون بلس، وغيرها
            العديد من الشركات الأخرى. الجيد أنك ستجد أسماء الشركات على قائمة الموقع وتحت كل اسم شركة ستجد أسماء الهواتف
            الذكية التي يتوفر لديها قطع الغيار داخل الموقع، وهذا سيسهل عليك الكثير أثناء قيامك بالبحث داخل الموقع. </p>
        </div>
      </div>
    </div>
  </section>
  <!--  End section Connect us -->

  <!-- End body -->
  <!-- *********************** -->

  <!-- Start footer -->
  <footer>
    <p>&#xA9 جميع الحقوق محفوظة لدى</p>
    <a href="#">.Ha</a>
  </footer>
  <!-- End footer -->
  <!-- *********************** -->

  <!-- jquery js -->
  <script src="js/jquery.js"></script>
  <!-- js File Owl Slider -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- Bootstrap V3 js File -->
  <script src="js/bootstrap.min.js"></script>
  <!-- My Custom js -->
  <script src="js/custom.js"></script>


  <script>
    $(document).ready(function() {
      $('#search').keyup(function() {
        var query = $(this).val();
        if (query != '') {
          $('#main_show').hide();
          $.ajax({
            url: "search.php",
            method: "post",
            data: {
              query: query
            },
            success: function(data) {
              $('#product_list').fadeIn();
              $('#product_list').html(data);
            }
          });
        } else {
          $('#main_show').show();
          $('#product_list').fadeOut();
        }
      });
      $('.event_change').change(function() {
        var id = $('.event_change option:selected').val();
        if (id != '') {
          $('#main_show').hide();
          $.ajax({
            url: 'event_docs.php',
            type: 'post',
            data: {
              'id': id
            },
            success: function(data) {
              $('#product_list').fadeIn();
              $('#product_list').html(data);
            }
          });
        }
      });
    });
  </script>

</body>

</html>