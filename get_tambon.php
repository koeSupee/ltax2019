<?php
 include ("conn/DB.php");
 			$amphoe_id = $_POST['amphur_th'];
			$sql = "select * from sys_tambon where amphoe_id='$amphoe_id' ";
			 $result =  mysqli_query($conn,$sql);
 ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



</head>

<body>

      <option value="">เลือกทั้งหมด</option>
<?php
  foreach($result as $rs){
      echo '<option value="'.$rs['TAMBON_ID'].'">'.$rs['TAMBON_NAME'].'</option>';
 }
 ?>

</body>
</html>
