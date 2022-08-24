<?php


// SQL query to select data from database
//$sql = " SELECT * FROM ios_device";
//$result = $conn->query($sql);

function db_connect(){
    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "in_house_device_farm_db";
    $conn = new mysqli($hostName, $userName, $password, $databaseName);
    // Check connection
    if ($conn->connect_error) {
        echo "Connection failed";
      die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connection Successful";
    return $conn;
}

function db_close($db){
    if(empty($db)){
        echo "!!!!!!!Database not available!!!!!!!";
        return;
    }
    $db->close();
}

function fetch_devices($type){
    if($type == "ios"){
        $tableName="ios_device";
    }elseif($type == "android"){
        $tableName="android_device";
    }
 $columns= ['device_id', 'device_name','device_os_version','device_busy'];
    $db= db_connect();
if(empty($db)){
  $msg= "Database connection error";
 }elseif (empty($columns) || !is_array($columns)) {
     
  $msg="columns Name must be defined in an indexed array";
 }elseif(empty($tableName)){
   $msg= "Table Name is empty";
}else{

$columnName = implode(", ", $columns);
$query = "SELECT ".$columnName." FROM $tableName";
$result = $db->query($query);
//echo "".$result."";
if($result == true){
 if ($result->num_rows > 0) {
    //  echo "data found";
    $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
    $msg= $row;
 } else {
    $msg= "No Data Found";
 }
}else{
  $msg= mysqli_error($db);
}
}
db_close($db);
return $msg;
}
?>
