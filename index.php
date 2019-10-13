<!DOCTYPE html>
<html lang="en">
<?php
  include_once ("conn/DB.php");
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบภาษีที่ดินและป้าย</title>
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/css/mystyle.css">
  <link rel="stylesheet" href="lib/css/mymodal.css">
  <script src="lib/js/jquery-3.3.1.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>

  </head>
  <body>
  <div class="headtitle">
      <span class="txt_title">ฐานข้อมูลทรัพย์สิน</span>
  </div>
  <div class="mainarea">
  <div class="container">
    <form id="myform">
      <div class="row">
        <div class="col-md-3">
         <label class="txt_normal txt_color_red">เลขประจำตัวประชาชน</label>
         <input type="text"  name="idcard" id="idcard"  class="form-control" disabled>
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_red">รหัสชื่อ</label>
         <input type="text"  name="idrefer" id="idrefer" class="form-control">
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">ประเภทบุคคล</label>
         <select name="type_person" id="type_person" class="form-control">
           <option value="" class="txt_normal">เลือกทั้งหมด</option>
           <?php
             $sql="select * from owner_type";
             $result = mysqli_query( $conn, $sql);
             while ($row = mysqli_fetch_array ($result)) {
               $id=$row['OWNER_TYPE'];
               $name=$row['OWNERTYPE_NAME'];
                 echo  "<option value='$id'>".$name."</option>";
             }
           ?>
         </select>
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">คำนำหน้าชื่อ/หน่วยงาน  </label>
         <select name="prefix" id="prefix" class="form-control">
           <option value="">เลือกทั้งหมด</option>
           <?php
           $sql="select * from sys_title";
           $result = mysqli_query( $conn, $sql);
           while ($row = mysqli_fetch_array ($result)) {
             $id=$row['TITLE_ID'];
             $name=$row['TITLE_NAME'];
               echo  "<option value='".$id."'>".$name."</option>";
           }
           ?>
         </select>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
         <label  class="txt_normal txt_color_blue">ชื่อเจ้าของทรัพย์สิน  </label>
         <input type="text"  name="name_person"  class="form-control">
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">นามสกุล  </label>
         <input type="text"  name="lastname_person" class="form-control">
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">บ้านเลขที่  </label>
         <input type="text"  name="home_no" class="form-control">
        </div>
        <div class="col-md-3">
        <label class="txt_normal txt_color_blue">หมู่ที่  </label>
        <input type="text"  name="moo_no" class="form-control">
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">ตรอก/ซอย  </label>
         <input type="text"  name="soi"  class="form-control">

        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">ถนน  </label>
         <input type="text"  name="road"  class="form-control">

        </div>
        <div class="col-md-3">
        <label class="txt_normal txt_color_blue">จังหวัด  </label>

        <select name="province" class="form-control" id="province">
        <option value="" class="txt_normal">เลือกทั้งหมด</option>
        <?php
          $sql_pr = "SELECT * FROM sys_province ORDER BY PROVINCE_NAME ASC";
          $res_pr = $conn->query($sql_pr);

          while ($rowsd = mysqli_fetch_array ($res_pr)) {
            echo "<option value='".$rowsd['PROVINCE_ID']."'>".$rowsd['PROVINCE_NAME']."</option>";
          }
        ?>
        </select>
        </div>

        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">อำเภอ  </label>
         <select name="amphur" id="amphur" class="form-control">
          <option value="" class="txt_normal">เลือกทั้งหมด</option>
        </select>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
         <label class="txt_normal txt_color_blue">ตำบล </label>
         <select name="tambon" id="tambon" class="form-control">
          <option value="" class="txt_normal">เลือกทั้งหมด</option>
        </select>
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_red">เลขที่ดิน  </label>
         <input type="text"  name="land_no"  class="form-control">

        </div>
        <div class="col-md-3">
        <label class="txt_normal txt_color_red">เลขที่โฉนด  </label>
        <input type="text"  name="nod_no" class="form-control">
        </div>
        <div class="col-md-3">
         <label class="txt_normal txt_color_red">ระวาง  </label>
         <input type="text"  name="rawang" class="form-control">
        </div>
        </div>
        <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4"  style="text-align:center">
         <button type="submit"  name="submit" id="submit" class="bt">ค้นหา</button>
        </div>
        </div>
        </div>
   </form>
  </div>
  <hr class="line">
  </div>
  <div id="search_show_here"></div>
<!-- #footer -->
<!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->
</body>
<!---------------- Modal ---------------->
<div id="showDetail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h6 class="modal-title">รายละเอียดทรัพย์สิน</h6>
      </div>
      <div class="modal-body">
        <div class="container">
          <div id="showContent"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal"> ปิด </button>
      </div>
    </div>
    <!-- End -------------->
  </div>
</div>
<script>
$(document).ready(function(){
  $('#myform').submit(function(){
    $('#search_show_here').html('<p><center><img src="images/ajax_loader_gray_256.gif"></center></p>');
      // var data = $('#myform').serialize();
      var form_data = $(this).serialize();
      $.ajax({
          type: "POST",
          url:	"db_query.php",
          data: form_data,
           // dataType: 'json',
          success:function(result){
            $('#search_show_here').html(result);
          }

      });
      return false;
  });

    $('#showDetail').on('show.bs.modal', function (e) {
         var owner_id = $(e.relatedTarget).data('id');
         $.ajax({
              url:"search_detail.php",
              method:"post",
              data:'owner_id='+ owner_id,
              success:function(data){
                $('#showContent').html(data);
                $('#showDetail').modal("show");

              }
         });
    });
  });
    ///////////////////////////////////////////
      $(document).ready(function(){

          $('#province').on('click', function() {
            province_th = ( this.value ); // or $(this).val()

                $.ajax({
                  type: "POST",
                  url:"get_amphur.php" ,
                  data: "province_th="+province_th,

                  success: function(data){
                  $("#amphur").html(data);
                  $('#tambon').html('<option value="">เลือกทั้งหมด</option>');
                }
            });
          });

          $('#amphur').on('change', function() {
            amphur_th = ( this.value ); // or $(this).val()
              $.ajax({
                type: "POST",
                  url:"get_tambon.php" ,
                  data: "amphur_th="+amphur_th,
                success: function(data){
                  $("#tambon").html(data);
                }
            });
          });
      });
 </script>
</html>
