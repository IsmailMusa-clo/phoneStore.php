<?php
$conn =mysqli_connect('localhost','root','','internet_store');
if (isset($_POST['query'])) {
    $output = "";
    $query = "SELECT * FROM products WHERE name LIKE '%" . $_POST['query'] . "%'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .=
            "<div class='box'><img src='admin/uploaded_img/".
            $row['image'].
            "' alt=''><div class='product'><p>اسم المنتج: <span>".
            $row['name'].
            "</span></p><p>السعر: <span> ".
            $row['price'].
            "</span></p></div>
            <form action='' method='post'><input type='hidden' name='pid' value='".
            $row['id'].
             "'><input type='hidden' name='name' value='".
            $row['name'].
            "'><input type='hidden' name='price' value='".
            $row['price'].
            "'><input type='hidden' name='image' value='".
            $row['image'].
            "'><input type='number' min='1' max='99' onkeypress='if(this.value.length == 2) return false;' value='1'  name='qty' placeholder='أدخل عدد القطع التي تريد إضافتها'>
              <input type='submit' class='btn btn-info' style='width:80px' name='add_to_cart' value='إضافة '>
            </form>
            <a href='#'>فيديو توضيحي للمنتج</a>
          </div>
         ";
        }
    }
    else {
        $output .= "<h3 style='text-align:center'>ليست هناك منتج بهذا الاسم</h3> ";
    }
    echo $output;
}
?>
