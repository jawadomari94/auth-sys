<?php
$servername="localhost";
$dbname="authin-sys";
$username="root";
$password="";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected successfully";

}catch(PDOException $e){
    echo "falied connection".$e->getMessage();

}

?>