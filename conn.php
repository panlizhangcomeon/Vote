<?php
/**
 * Created by PhpStorm.
 * User: yixue
 * Date: 2018-11-12
 * Time: 11:49
 */
$dbs = 'mysql';
$host = 'localhost';
$dbname = 'vote';
$dns = "$dbs:host=$host;dbname=$dbname";
$user = 'root';
$pass = '123456';
try{
    $pdo = new pdo($dns,$user,$pass);
}catch(PDOException $e){
    echo "Error messege:".$e->getMessage();
}
if(!session_id()){
    session_start();
}

