<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>ระบบภาษที่ดินและป้าย</title>
<link rel="stylesheet" href="lib/css/bootstrap.min.css">
<link rel="stylesheet" href="lib/css/mystyle.css">
<script src="lib/js/jquery-3.3.1.min.js"></script>
<script src="lib/js/bootstrap.min.js"></script>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        /* margin:50px auto; */
        font-size: 0.8rem;
    }
    /* Zebra striping */
    /* tr:nth-of-type(odd) {
    background: #eee;
    } */
    thead {
        background: #ff6600;
        color:#fff;
        font-weight: bold;
    }
    /* td, th {
        padding: 0.1rem;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 18px;
    } */
    /* .cof{
        color:#0059b3;
        font-weight: bold;
    } */
    #list{
      color:#cc2900;
      font-size: 0.8rem;
    }
</style>
</head>
<?php
  include_once ("conn/DB.php");
  $owner_id = $_POST['owner_id'];

  $sql = "SELECT * FROM owner ";
  $sql .=" LEFT JOIN sys_title ON owner.TITLE_ID = sys_title.TITLE_ID";
  $sql .=" LEFT JOIN owner_type ON owner.OWNER_TYPE = owner_type.OWNER_TYPE";
  $sql .=" LEFT JOIN sys_province ON owner.province_id = sys_province.PROVINCE_ID";
  $sql .=" LEFT JOIN sys_amphoe ON owner.amphoe_id = sys_amphoe.amphoe_id";
  $sql .=" LEFT JOIN sys_tambon ON owner.tambon_id = sys_tambon.TAMBON_ID";
  $sql .=" WHERE owner.OWNER_ID = '$owner_id'";
// echo $sql;
  $result = mysqli_query( $conn, $sql );
  $row = mysqli_fetch_array ($result);
  $moo = $row['MOO'];
  $soi = $row['SOI'];
  $road = $row['ROAD'];
  $tambon = $row['TAMBON_NAME'];
  $amphur = $row['amphoe_name'];
  if(!empty($moo)){
    $m = "หมู่ ".$moo;
  }else{
    $m="";
  }
  if(!empty($soi)){
    $s = "ซ. ".$soi;
  }else{
    $s = "";
  }
  if(!empty($road)){
    $r = "ถ. ".$road;
  }else{
    $r="";
  }
  if(!empty($tambon)){
    $t = "ต. ".$tambon;
  }else{
    $t = "";
  }
  if(!empty($amphur)){
    $a = "อ. ".$amphur;
  }else{
    $a = "";
  }
?>
<body>
<table class="table">
  <thead class="thead-light">
    <tr text-align="center">
      <th colspan="4">ข้อมูลบุคคล</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>ประเภทบุคคล</th>
      <td class="txt_color_blue"><?php echo $row['OWNERTYPE_NAME']?></td>
      <td>ชื่อเจ้าของทรัพย์</td>
      <td class="txt_color_blue"><?php echo $row['TITLE_NAME'].$row['FNAME']?><?php echo " "?><?php echo $row['LNAME']?></td>
    </tr>
    <tr>
      <th scope="row">ที่อยู่</th>
      <td colspan="3" class="txt_color_blue"><?php echo $row['HOME_NO']." ".$m." ".$s." ".$r." ".$t." ".$a." ".
      $row['PROVINCE_NAME']." ".$row['zipcode']?></td></td>
    </tr>
    <tr>
      <th scope="row">โทรศัพท์</th>
      <td class="txt_color_blue"><?php echo $row['telephone']?></td>
      <td>มือถือ</td>
      <td class="txt_color_blue"><?php echo $row['mobile']?></td>
    </tr>
    <tr>
      <th scope="row">แฟกซ์</th>
      <td class="txt_color_blue"><?php echo $row['fax']?></td>
      <td>Email</td>
      <td class="txt_color_blue"><?php echo $row['email']?></td>
    </tr>
  </tbody>
</table>
<?php
    $sql2 = "SELECT * FROM land_owner";
    $sql2 .=" INNER JOIN land_data ON land_owner.LAND_ID = land_data.LAND_ID";
    $sql2 .=" INNER JOIN land_used ON land_owner.LAND_ID = land_used.LAND_ID";
    $sql2 .=" WHERE land_owner.OWNER_ID = '$owner_id'";

    // echo $sql2;
    $i=0;
    $result2 = mysqli_query( $conn, $sql2);
    while ($row2 = mysqli_fetch_array ($result2)) {
      $i++;
 ?>
 <span id="list">รายการที่ <?php echo $i?></span>
 <table class="table">
     <tr>
       <th>เลขโฉนด</th>
       <td class="txt_color_blue"><?php echo $row2['DOC_NO']?></td>
       <th>เลขสำรวจ</td>
       <td class="txt_color_blue"><?php echo $row2['SURVEY_NO']?></td>
       <th>เลขที่ดิน</th>
       <td class="txt_color_blue"><?php echo $row2['LAND_NO']?></td>
       <th>ระวาง</td>
       <td class="txt_color_blue"><?php echo $row2['RAWANG']?></td>
     </tr>
     <tr>
       <th>ไร่</th>
       <td class="txt_color_blue"><?php echo $row2['RAI']?></td>
       <th>งาน</td>
       <td class="txt_color_blue"><?php echo $row2['NGAN']?></td>
       <th>วา</th>
       <td class="txt_color_blue"><?php echo $row2['WA']?></td>
       <th>พื้นที่รวม(ตรว.)</td>
       <td class="txt_color_blue"><?php echo $row2['TOTALWA']?></td>
     </tr>
     <tr>
       <th>ราคา/ตรว.</th>
       <td class="txt_color_blue"><?php echo $row2['PRICE_WA']?></td>
       <th>ราคารวม</td>
       <td class="txt_color_blue"><?php echo $row2['LAND_PRICE']?></td>
       <th>วันที่</th>
       <td class="txt_color_blue"><?php echo $row2['USER_DATE']?></td>
       <th>ปีที่</td>
       <td class="txt_color_blue"><?php echo $row2['APPLY_YEAR']?></td>
     </tr>
 </table>
<?php } ?>
</body>
</html>
