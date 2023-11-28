<?php

try{
    $server_name = "localhost";
    $db_name = "bonbon";
    $user_name = "root";
    $password = "root";
    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8mb4", "$user_name", "$password");

}catch(PDOException $e){
    echo "echec de connexion:" . " " . $e->getMessage();
};

?>