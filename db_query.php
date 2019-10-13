<?php
include_once ("conn/DB.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idrefer = $_POST["idrefer"];
  $type_person = $_POST['type_person'];
  if($type_person==""){
    $tper_sql="";
  }else{
    $tper_sql = " (OWNERTYPE_NAME = (SELECT OWNERTYPE_NAME FROM owner_type WHERE OWNER_TYPE = '{$type_person}')) and";
  }
  $prefix = $_POST['prefix'];
  if($prefix==""){
    $title_per="";
  }else{
    $title_per = " (TITLE_NAME = (SELECT TITLE_NAME FROM sys_title WHERE TITLE_ID = '{$prefix}')) and";
  }
  $name_person = $_POST['name_person'];
  $lastname_person = $_POST['lastname_person'];
  $home_no = $_POST['home_no'];
  $moo_no = $_POST['moo_no'];
  $soi = $_POST['soi'];
  $road = $_POST['road'];
  $province = $_POST['province'];
  if($province==""){
    $prov_sql="";
  }else{
    $prov_sql = " (PROVINCE_NAME = (SELECT PROVINCE_NAME FROM sys_province WHERE PROVINCE_ID = '{$province}')) and";

  }
  $amphur = $_POST['amphur'];
  if($amphur==""){
    $amp_sql="";
  }else{
    $amp_sql = " (amphoe_name = (SELECT amphoe_name FROM sys_amphoe WHERE amphoe_id = '{$amphur}')) and";
  }
  $tambon = $_POST['tambon'];
  if($tambon==""){
    $tam_sql="";
  }else{
    $tam_sql = " (TAMBON_NAME = (SELECT TAMBON_NAME FROM sys_tambon WHERE TAMBON_ID = '{$tambon}')) and";

  }
  $land_no = $_POST['land_no']; //เลขที่ดิน (land_data)
  $nod_no = $_POST['nod_no']; // เลขที่โฉนด (land_data)
  $rawang = $_POST['rawang']; //ระวาง (land_data)
}

?>
<div class="container">
  <table class="table .table-hover" width="80%">
    <thead class="thead-light">
    <tr>
      <th >รหัสเจ้าของ</th>
      <th >ชื่อ-นามสกุล</th>
      <th >ตำบล</th >
      <th >อำเภอ</th >
      <th >จังหวัด</th >
      <th >มือถือ</th >
      <th >เลขที่โฉนด</th >
      <th >หน้าสำรวจ</th >
      <th >เลขที่ดิน</th >
      <th >พื้นที่รวม(ตรว.)</th >
      <th >ราคา/ตรว.</th >
    </tr>
    </thead>
<?php
  $sql = "select * from owner LEFT JOIN land_owner ON owner.OWNER_ID = land_owner.OWNER_ID LEFT JOIN land_data ON land_owner.LAND_ID = land_data.LAND_ID ";
  $sql .=" LEFT JOIN sys_title ON owner.TITLE_ID = sys_title.TITLE_ID";
  $sql .=" LEFT JOIN owner_type ON owner.OWNER_TYPE = owner_type.OWNER_TYPE";
  $sql .=" LEFT JOIN sys_province ON owner.province_id = sys_province.PROVINCE_ID";
  $sql .=" LEFT JOIN sys_amphoe ON owner.amphoe_id = sys_amphoe.amphoe_id";
  $sql .=" LEFT JOIN sys_tambon ON owner.tambon_id = sys_tambon.TAMBON_ID";
  $sql .=" where ".$tper_sql.$title_per ;
  $sql .= $tam_sql.$amp_sql.$prov_sql;
  $sql .=" (PERS_ID like '%{$idrefer }%') and (FNAME like '%{$name_person }%') and (LNAME  like '%{$lastname_person }%') and (HOME_NO  like '%{$home_no }%') and";
  $sql .="(MOO  like '%{$moo_no}%') and (SOI  like '%{$soi}%') and (ROAD like '%{$road}%') and";
  $sql .="(land_data.DOC_NO like '%{$nod_no}%') and (land_data.LAND_NO like '%{$land_no}%') and (land_data.RAWANG like '%{$rawang}%')";

   $result = mysqli_query($conn,$sql);
   $numrows = mysqli_num_rows($result);

   echo "<span class=\"txt_normal txt_color_blue\">ผลการค้นหา ".$numrows." รายการ</span>";

if($numrows){
  while ($row = mysqli_fetch_array ($result)) {
    $ownerid = $row['OWNER_ID'];
    echo
  "<tbody>
  <tr class=\"tb_show_txt\">
    <th><a href=\"#showDetail\"  data-id=\"$ownerid\" data-toggle=\"modal\">".$ownerid."</a></th>
    <th>".$row['TITLE_NAME'].$row['FNAME']."  ".$row['LNAME']."</th>
    <th>".$row['TAMBON_NAME']."</th>
    <th>".$row['amphoe_name']."</th>
    <th>".$row['PROVINCE_NAME']."</th>
    <th>".$row['mobile']."</th>
    <th>".$row['DOC_NO']."</th>
    <th>".$row['SURVEY_NO']."</th>
    <th>".$row['LAND_NO']."</th>
    <th>".$row['TOTALWA']."</th>
    <th>".$row['PRICE_WA']."</th>
    </tr>
    </tbody>";
  }
}
?>
</table>
</div>
