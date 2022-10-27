<?php
include('connect.php');
include('client_auth.php');
$user_id = $_SESSION['id'];
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

        .container .content .iconNav .drobDown li {
            padding: 7px 0;
        }

        .panel-body table tr th {
            text-align: right;
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
                        <li><a href="#orders" id="">الطلبات</a></li>
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
    <!-- start order table section -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-top: 20px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-ticket"> طلباتي</i>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>المشتريات</th>
                                    <th>مجموع السعر</th>
                                    <th>حالة الطلب</th>
                                    <th>تاريخ الطلب</th>
                                    <th>طريقة الدفع</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                                $select_orders->execute();
                                if ($select_orders->rowCount() > 0) {
                                    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                                        $i = 1;
                                ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $fetch_orders['total_products'] ?></td>
                                            <td><?= $fetch_orders['total_price'] ?></td>
                                            <td><?= $fetch_orders['payment_status'] ?></td>
                                            <td><?= $fetch_orders['placed_on'] ?></td>
                                            <td><?= $fetch_orders['method'] ?></td>

                                        </tr>
                                <?php
                                        $i++;
                                    }
                                } else {
                                    echo '';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end order table section -->
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