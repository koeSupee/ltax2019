<?php
include ("conn/DB.php");
 			$province_id = $_POST['province_th'];
			 $sql = "select * from sys_amphoe where province_id ='$province_id' ";
			 $result =  mysqli_query($conn,$sql);

 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
  <option value="">เลือกทั้งหมด</option>
<?php
  foreach($result as $rs){
      echo '<option value="'.$rs['amphoe_id'].'">'.$rs['amphoe_name'].'</option>';
  }
?>
</body>
</html>
