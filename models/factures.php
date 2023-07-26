<?php
require_once('./models/ConnectDB.php');

function getFacture($facture_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM factures WHERE facture_id=:id");
    $stm->bindParam(":id", $facture_id);
    $stm->execute();
    $result = $stm->fetch();
    return $result;
}
function insertFacture($montant, $consommation, $contrat)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `factures`(`montant`, `consommation_id`, `contrat_id`) VALUES (:m,:cons,:c)");
    $stm->bindParam(":m", $montant);
    $stm->bindParam(":cons", $consommation);
    $stm->bindParam(":c", $contrat);
    $stm->execute();
    $result = $stm->rowCount() > 0;
    return $result;
}
function getAllFacturesDB($year, $month)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT f.*, c.contrat_id, c.contrat_id, cl.nom, cl.prenom, c.adresse_local
    FROM factures f
    JOIN contrats c ON f.contrat_id = c.contrat_id
    JOIN clients cl ON c.client_id = cl.client_id
    JOIN consommations cons ON cons.consommation_id = f.consommation_id
    WHERE cons.consommation_mois = :month AND cons.consommation_annee = :year ORDER BY f.etat,f.facture_payement_date DESC");
    $stm->bindParam(":month", $month);
    $stm->bindParam(":year", $year);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function updateFacture($facture_id, $etat)
{
    $db = connectToDatabase();
    if ($etat) {
        $stm = $db->prepare("UPDATE `factures` SET `etat`=:etat,facture_payement_date=now() WHERE `facture_id`=:id");
    } else {
        $stm = $db->prepare("UPDATE `factures` SET `etat`=:etat,facture_payement_date=NULL WHERE `facture_id`=:id");
    }

    $stm->bindParam(":id", $facture_id);
    $stm->bindParam(":etat", $etat);
    $stm->execute();
    $result = $stm->rowCount() > 0;
    return $result;
}
function updateFactureMontant($consommation, $montant)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `factures` SET montant=:m,facture_payement_date=NULL WHERE `consommation_id`=:id");
    $stm->bindParam(":id", $consommation);
    $stm->bindParam(":m", $montant);
    $stm->execute();
    $result = $stm->rowCount() > 0;
    return $result;
}
function deleteFactureDB($facture_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("DELETE FROM `factures` WHERE `facture_id`=:id");
    $stm->bindParam(":id", $facture_id);
    $stm->execute();
    $result = $stm->rowCount() > 0;
    return $result;
}
