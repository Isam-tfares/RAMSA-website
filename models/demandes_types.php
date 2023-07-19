<?php
require_once("models/ConnectDB.php");
function getDemandesTypes()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM demandes_types");
    $stm->execute();
    $demandes_types = $stm->fetchAll();
    return $demandes_types;
}
function get($id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM demandes_types WHERE demande_type_id=:id");
    $stm->bindParam(":id", $id);
    $stm->execute();
    $demandes_type = $stm->fetch();
    return $demandes_type;
}
function getDemandesIds()
{
    $demandes = getDemandesTypes();
    $arr = [];
    foreach ($demandes as $d) {
        $arr[] = $d['demande_type_id'];
    }
    return $arr;
}
function insertDemandeType($name)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `demandes_types`( `demande_name`) VALUES (:demande_name)");
    $stm->bindParam(":demande_name", $name);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function getDemandeByName($name)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM `demandes_types` WHERE demande_name=:demande_name");
    $stm->bindParam(":demande_name", $name);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function deleteDemandeTypeFromDB($id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("DELETE FROM `demandes_types` WHERE demande_type_id=:id");
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
