<?php
if (isset($_SESSION['client']) || isset($_SESSION['admin'])) {
    require_once("models/ConnectDB.php");
}
function insertActivityClient($activity_content, $client_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `activities`( `activity_user`, `activity_content`, `isAdmin`) VALUES (:user,:content,0)");
    $stm->bindParam(":content", $activity_content);
    $stm->bindParam(":user", $client_id);
    $stm->execute();
    $res = $stm->rowCount() > 0;
    return $res;
}
function insertActivityAdmin($activity_content, $admin_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `activities`( `activity_user`, `activity_content`, `isAdmin`) VALUES (:user,:content,1)");
    $stm->bindParam(":content", $activity_content);
    $stm->bindParam(":user", $admin_id);
    $stm->execute();
    $res = $stm->rowCount() > 0;
    return $res;
}
function getLastActivities()
{
    $db = connectToDatabase();
    $stmt = $db->prepare("SELECT activities.*,admin.* FROM activities,admin WHERE activities.isAdmin=1 and activities.activity_user=admin.id ORDER BY activities.activity_date DESC, activities.activity_time DESC LIMIT 4");
    $stmt->execute();
    $activities1 = $stmt->fetchAll();
    $stmt = $db->prepare("SELECT activities.*,clients.* FROM activities,clients WHERE activities.isAdmin=0 and activities.activity_user=clients.client_id ORDER BY activities.activity_date DESC, activities.activity_time DESC LIMIT 4");
    $stmt->execute();
    $activities2 = $stmt->fetchAll();
    return [$activities1, $activities2];
}
function getAllActivities()
{
    $db = connectToDatabase();
    $stmt = $db->prepare("SELECT activities.*,admin.* FROM activities,admin WHERE activities.isAdmin=1 and activities.activity_user=admin.id ORDER BY activities.activity_date DESC, activities.activity_time DESC");
    $stmt->execute();
    $activities1 = $stmt->fetchAll();
    $stmt = $db->prepare("SELECT activities.*,clients.* FROM activities,clients WHERE activities.isAdmin=0 and activities.activity_user=clients.client_id ORDER BY activities.activity_date DESC, activities.activity_time DESC");
    $stmt->execute();
    $activities2 = $stmt->fetchAll();
    return [$activities1, $activities2];
}
