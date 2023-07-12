<?php
require_once("models/ConnectDB.php");
function Connect($email)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM clients WHERE email=:e");
    $stm->bindParam(":e", $email);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        return $stm->fetch();
    } else {
        $stm = $db->prepare("SELECT * FROM admin WHERE email=:e");
        $stm->bindParam(":e", $email);
        $stm->execute();
        if ($stm->rowCount() > 0) {
            return $stm->fetch();
        } else {
            return false;
        }
    }
}
function getPassword()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM admin LIMIT 1");
    $stm->execute();
    return $stm->fetch()['password'];
}
function updatePassword($password)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `admin` SET `password`=:p");
    $stm->bindParam(":p", $password);
    $stm->execute();
    return $stm->rowCount() > 0;
}
