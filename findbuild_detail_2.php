<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>บริษัทโปรสเปค แอพเพรซัล จำกัด</title>
<link rel="stylesheet" href="lib/css/bootstrap.min.css">
<link rel="stylesheet" href="lib/css/mystyle.css">
<script src="lib/js/jquery-3.3.1.min.js"></script>
<script src="lib/js/bootstrap.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfgpIhXtMr0LUMBjKoJsd6eeUYxvEUiAg&callback=initMap"
type="text/javascript"></script>

<style>
/* text of detail data in modal */
    #txt_col_head{
        font-size:0.9rem;
        color:#001a4d;
    }
    #txt_col_title{
        font-size:0.8rem;
        color:#0099ff;
    }
    #txt_col_red{
        font-size:0.8rem;
        color:#ff0000;
    }
</style>
</head>
<?php
include_once ("conn/DB.php");
$id_code = $_POST['sp_id'];
?>

<body>

<?php
// header('Content-Type: application/json');
$sql = "SELECT sp_main.*,var_value_type.type AS type1,var_users.type AS type2 FROM sp_main LEFT JOIN var_value_type ON sp_main.value_type = var_value_type.id LEFT JOIN var_users ON sp_main.val_div = var_users.id ";
$sql .="WHERE sp_main.id_code = '$id_code'";
$result = mysqli_query( $conn, $sql );
$row = mysqli_fetch_array ($result);

 $ssn = $row['t_deed'];
 $lx = $row['gis_x'];
 $ly = $row['gis_y'];
 $namepro = $row['pro_name'];
 $rest = substr($ssn, 0, 2);
 $sort = "xxx";
 $nwssn = $rest.$sort;
   $arr = array(
    'lat' =>$lx ,
    'lng' =>$ly ,
    'namepro' =>$namepro
  );
    json_encode($arr);
?>
<!-------------------------------------------------------------------->
<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">เลขที่อ้างอิง</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['r_id']?></label>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">เลขโฉนด</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$nwssn?></label>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">เลขที่ดิน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['field_num']?></label>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ฝ่ายที่ประเมินราคา</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_red"><?=$row['type2']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ประเภททรัพย์สิน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['type1']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ชื่อโครงการ</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['pro_name']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">เลขที่บ้าน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['nadd']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ซอย</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['soi']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ถนน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['road']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ระยะทางการเข้าถึง(ม.)</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=number_format($row['en_distrance'], 0, '.', ',')?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">เนื้อที่ดิน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['field_area']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">หน้ากว้างที่ดิน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['field_width']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ความกว้างผิวจราจร</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['r_width']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ระดับที่ดิน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['soil_lev']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">เนื้อที่ใช้สอย(ตรม.)</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['b_area']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">รูปแบบอาคาร</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['value_type_house']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">อายุอาคาร</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['b_old']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">การตกแต่งบำรุงรักษา</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">จำนวนห้องนอน</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['bedroom_n']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">จำนวนห้องน้ำ</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['toilet_n']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ผังเมืองโซนสี</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ค่าพิกัดที่ตั้ง</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['gis_x']?> , <?=$row['gis_y']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ราคาที่ดิน/ตรว.</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_red"><?= number_format($row['field_cost'], 0, '.', ',')?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">มูลค่าทรัพย์สินรวม</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_red"><?=number_format($row['t_cost'], 0, '.', ',')?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ข้อมูล ณ วันที่</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"><?=$row['send_date']?></label>
            </div>
        </div>
	</div>
    <div class="col-md-7">
        <div class="row">
            <div id="showmap" style="width:100%;height:600px"></div>
        </div>
        <div class="row">
            <div class="col-xl-auto">
                <label id="txt_col_head">สาธารณูปโภคพื้นฐาน</label>
            </div>
            <div class="col-xl-auto">
                <label id="txt_col_title">
                    <?
                    if($row['elect']==1){
                        echo "ไฟฟ้า, ";
                    }
                    if($row['r_elect']==1){
                        echo "ไฟถนน, ";
                    }
                    if($row['eltelephoneect']==1){
                        echo "โทรศัพท์, ";
                    }
                    if($row['water']==1){
                        echo "ประปา, ";
                    }
                    if($row['water_pipe']==1){
                        echo "ท่อระบายน้ำ";
                    }
                    ?>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <label id="txt_col_head">สภาพแวดล้อม</label>
            </div>
            <div class="col-md-auto">
                <label id="txt_col_title"><?=$row['environment']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-auto">
                <label id="txt_col_head">สิ่งอำนวยความสะดวก</label>
            </div>
            <div class="col-md-auto">
                <label id="txt_col_title"><?=$row['facilities']?></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label id="txt_col_head">ข้อกฏหมายอื่นๆ</label>
            </div>
            <div class="col-md-6">
                <label id="txt_col_title"></label>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------->
<script>

var ar = JSON.parse('<?php echo json_encode($arr) ?>');
var lat = ar.lat;
var lng = ar.lng;
var namep = ar.namepro;

// console.log(lat);
// console.log(lng);
// console.log(namep);


var marker, info;     //----------- Create Valiable


function initMap(){
  var myCenter = new google.maps.LatLng(51.508742,-0.120850); //--- defaule
  var mapCanvas = document.getElementById("showmap"); // --- ให้ไปแสดงที่ html ตาม element id
  var mapOptions = {
      center: myCenter,
    //   zoomControl: true,
      scrollwheel:true,                               // --- Option
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    create_map = new google.maps.Map(mapCanvas, mapOptions);
    myPosition = new google.maps.LatLng(lat,lng);
    var icon = {
	     url: "images/sp1.png", // url
	 };
    marker = new google.maps.Marker({
        icon: icon,
        position: myPosition,
        map: create_map
        });
    var my_Point = marker.getPosition();
	create_map.panTo(my_Point);// หน้าจอเลื่อนไปตามตำแหน่ง Markpiont
    info = new google.maps.InfoWindow({                 // --- set Title name (popup)
        content: namep
    });
    info.open(create_map,marker);
    marker.setMap(create_map);

//   infowindow.open(create_map,marker);

//     var myCity = new google.maps.Circle({
//         center: myPosition,
//         radius: 20000,
//         strokeColor: "#0000FF",
//         strokeOpacity: 0.8,
//         strokeWeight: 2,
//         fillColor: "#0000FF",
//         fillOpacity: 0.4
//     });
//     myCity.setMap(create_map);
}
</script>
</body>
</html>
