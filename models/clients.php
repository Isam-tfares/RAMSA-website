<?php
require_once("models/ConnectDB.php");
function getClients()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM clients");
    $stm->execute();
    $clients = $stm->fetchAll();
    return $clients;
}
function insert($data)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `clients`(`password`, `nom`, `prenom`, `adresse`, `tel`, `email`) VALUES (:pass,:nom,:prenom,:adresse,:tel,:email)");
    $stm->bindParam(":pass", sha1($data['password']));
    $stm->bindParam(":nom", $data['nom']);
    $stm->bindParam(":prenom", $data['prenom']);
    $stm->bindParam(":adresse", $data['adresse']);
    $stm->bindParam(":tel", $data['tel']);
    $stm->bindParam(":email", $data['email']);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function update($data)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `clients` SET`password`=:pass,`nom`=:nom,`prenom`=:prenom,`adresse`=:adresse,`tel`=:tel,`email`=:email WHERE client_id=:id");
    $stm->bindParam(":pass", sha1($data['password']));
    $stm->bindParam(":nom", $data['nom']);
    $stm->bindParam(":prenom", $data['prenom']);
    $stm->bindParam(":adresse", $data['adresse']);
    $stm->bindParam(":tel", $data['tel']);
    $stm->bindParam(":email", $data['email']);
    $stm->bindParam(":id", $data['client_id']);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function delete($id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("DELETE FROM `clients` WHERE client_id=:id");
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
