<?php
include('connect.php');
include('client_auth.php');
$user_id = $_SESSION['id'];
if (isset($_POST['add_to_cart'])) {
  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $qty = $_POST['qty'];
  $qty = filter_var($qty, FILTER_SANITIZE_STRING);
  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND name = ?");
  $select_cart->execute([$user_id, $name]);
  if ($select_cart->rowCount() > 0) {
    setcookie('message', 'هناك طلبات في عربة التسوق', time() + 4);
  } else {
    $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, p_id, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
    $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
    setcookie('message', 'added to cart!', time() + 4);
  }
  header('location:index_log.php');
}
if (isset($_POST['update_qty'])) {
  $cart_id = $_POST['cart_id'];
  $qty = $_POST['qty'];
  $qty = filter_var($qty, FILTER_SANITIZE_STRING);
  $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
  $update_qty->execute([$qty, $cart_id]);
  setcookie('message', 'cart quantity updated!', time() + 4);
  header('location:index_log.php');
}
if (isset($_GET['delete_cart_item'])) {
  $delete_cart_id = $_GET['delete_cart_item'];
  $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
  $delete_cart_item->execute([$delete_cart_id]);
  header('location:index_log.php');
}
if (isset($_POST['order'])) {
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $address = '' . $_POST['flat'];
  $address = filter_var($address, FILTER_SANITIZE_STRING);
  $method = $_POST['method'];
  $method = filter_var($method, FILTER_SANITIZE_STRING);
  $total_price = $_POST['total_price'];
  $total_products = $_POST['total_products'];

  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
  $select_cart->execute([$user_id]);

  if ($select_cart->rowCount() > 0) {
    $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?)");
    $insert_order->execute([$user_id, $name, $number, $method, $address, $total_products, $total_price]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$user_id]);
    setcookie('message', 'تم الطلب', time() + 4);
  } else {
    setcookie('message', 'عربة التسوق فارغة', time() + 4);
  }

  header('location:index_log.php');
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

  <!--[if lt IE 9]>
        <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
      <![endif]-->

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

    .container .content .iconNav {
      position: relative;
    }

    .container .content .iconNav .drobDown {
      display: none;
      flex-direction: column;
      width: 200px;
      position: absolute;
      background-color: #333;
      border: 1px solid #fff;
      z-index: 2;
      top: 30px;
      left: 0px;
      padding: 5px 10px;
    }

    .qty {
      width: 70%;
      padding: 5px 0;
      font-size: 15px;
    }

    .container .content .iconNav .drobDown li {
      padding: 7px 0;
    }

    .add_order {
      width: 80%;
      margin: 30px auto;
      background-color: #333;
      text-align: center;
      border-radius: 5px;
      color: #fff;
      padding: 10px;
    }

    .add_order .cart-total {
      padding: 20px;
      color: #fff;
      font-size: 20px;
      font-weight: bold;
    }

    form .flex {

      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
      justify-content: space-between;
    }

    form .flex .inputBox {
      width: 46%;
      margin: auto;
    }

    form .flex .inputBox span {
      font-size: 1.8rem;
      color: #fff;
      width: 20%;
    }

    form .flex .inputBox .box {
      width: 80%;
      background-color: #fff;
      padding: 1.4rem;
      font-size: 1.8rem;
      color: #010102;
      border-radius: .5rem;
      margin: 1rem 0;
    }
  </style>
</head>

<body>
  <!-- Start hedar -->
  <header>
    <!-- Start nav -->
    <nav>
      <div class="container">
        <div class="content">
          <a href="index_log.php" title="PHONE SHOP"><img src="images/nav/logo.png" alt=""></a>
          <ul>
            <li><a href="#">الصفحة الرئيسية</a></li>
            <li><a href="#products" id="">المنتجات</a></li>
            <li><a href="order.php" id="">الطلبات</a></li>
            <li><a href="#contact" id="">تواصل معنا</a></li>
          </ul>
          <div class="iconNav">
            <a href="#" title=""><i class="fa fa-user"></i></a>
            <ul class="drobDown">
              <li><?= $_SESSION['user_name'] ?>
              <li>
              <li><a href="#orders" title="تسوق الآن"><i class="fa fa-shopping-cart"></i> التسوق </a>
              <li>
              <li><a href="logout.php" title="تسجيل الخروج"><i class="fa fa-sign-in"></i> تسجيل الخروج</a>
              <li>
            </ul>
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
        <li><a href="#orders">الطلبات</a></li>
        <li><a href="#contact">تواصل معنا</a></li>
      </ul>
    </div>
    <!-- End nav -->
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
                <button class="btn btn-info" style="width:100%;margin-top:10px" data-toggle="modal" data-target="#exampleModal<?= $s ?>">فيديو توضيحي للمنتج</button>
                <!-- Button trigger modal -->
              </div>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?= $s ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal<?= $s ?>Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModal<?= $s ?>Label">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div><?= $fetch_products['video_path'] ?></div>
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

  <!-- start requests -->
  <div id="orders" class="requests">
    <div class="container">
      <div class="request">
        <h1>طلبـاتك</h1>
      </div>
      <div class="boxs">
        <?php
        $grand_total = 0;
        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $select_cart->execute([$user_id]);
        if ($select_cart->rowCount() > 0) {
          while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $sub_total;
            $cart_item[] = $fetch_cart['name'] . ' ( ' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ' ) - ';
            $total_products = implode($cart_item);
        ?>
            <div class="box">
              <div class="ico">
                <i class="fa fa-mobile"></i>
                <div class="par">
                  <h1> <?= $fetch_cart['name']; ?></h1>
                  <p></p>
                </div>
              </div>
              <h1>ملاحظات:</h1>
              <ul>
                <li>الكمية المطلوبة: <span><?= $fetch_cart['quantity']; ?></span></li>
                <li>إجمالي السعر: <span><?= $fetch_cart['price']; ?> ريال</span></li>
              </ul>
              <form action="" method="post" style="margin-bottom:10px ;">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" onkeypress="if(this.value.length == 2) return false;">
                <button type="submit" class="btn btn-info" name="update_qty">تعديل الكمية</button>
              </form>
              <a href="index_log.php?delete_cart_item=<?= $fetch_cart['id']; ?>" class="fa fa-times" onclick="return confirm('delete this cart item?');"></a>
            </div>
        <?php
          }
        } else {
          echo '<p class="alert-info"><span>عربة التسوق فارغة </span></p>';
        }
        ?>
      </div>
      <form action="" class="add_order" method="POST">
        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
        <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
        <div class="cart-total"> سعر الفاتورة : <span>
            <?= $grand_total; ?>\ ريال
          </span>
        </div>
        <div class="flex">
          <div class="inputBox">
            <span> اسمك :</span>
            <input type="text" name="name" class="box" value="<?= $_SESSION['user_name'] ?>" required placeholder="ادخل الاسم " maxlength="20">
          </div>
          <div class="inputBox">
            <span>رقم الهاتف :</span>
            <input type="text" name="number" class="box" required placeholder="ادخل الرقم " min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;">
          </div>
          <div class="inputBox">
            <span>طريقة الدفع</span>
            <select name="method" class="box">
              <option value="كاش">كاش </option>
              <option value="بطاقة">بطاقة </option>

            </select>
          </div>
          <div class="inputBox">
            <span>رقم الكاونتر </span>
            <input type="text" name="flat" class="box" required placeholder="رقم الطاولة" maxlength="50">
          </div>
          <div style="width: 100%;">
            <input type="submit" value="اطلب الآن" class="btn btn-info" style="width:100%;" name="order">
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End requests -->

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
    $(" .content .iconNav > a").click(function() {
      $(" .content .iconNav .drobDown").slideToggle(500);
    });
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