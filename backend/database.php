<?php

//Set Access-Control-Allow-Origin with PHP
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "database";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("connection failed".$conn->connect_error);
    echo 'dead';
}
$result = array('error'=>false);


if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $sql = $conn->query("select * FROM user");
    $user = array();
    while($row = $sql->fetch_assoc()){
        array_push($user,$row);
    }
    $result['user'] = $user;
    echo json_encode($result);
}
$REQUEST =$_POST['req'];
if($_SERVER["REQUEST_METHOD"] == "POST" && $REQUEST=="1"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $sql = "INSERT INTO user(name, email, phone)
    VALUES ('".$name."', '".$email."', '".$phone."')";
    $x = mysqli_query($conn, $sql);
    if ($x) {
        $result['massage']="user added successfully";
    }
    else {
        $result['error'] = true;    
        $result['massage']="failed to add user!";
        
    }
    echo json_encode($result);
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $REQUEST=="2"){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql ="UPDATE user SET name='".$name."',email='".$email."', phone='".$phone."' WHERE id='".$id."'";
    $z = mysqli_query($conn, $sql)or die(mysqli_error($conn));
    if ($z) {
        $result['massage']="user updeted successfully";
    }
     else{
        $result['error'] = true;
        $result['message']="failed to update user!";
    }
     echo json_encode($result);
     exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST" && $REQUEST=="3"){
    $id = $_POST['id'];
    $sql = "DELETE FROM user WHERE id='$id'";
    $d = mysqli_query($conn, $sql)or die(mysqli_error($conn));
    if ($d) {
        $result['massage']="user deleted successfully";
    }
     echo json_encode($result);
     exit;
}
$conn->close();

function _dd($data, $true=true) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if($true) {
        exit;
    }
}
?>
