<?php
require_once('./models/ConnectDB.php');

function getAll($month, $year)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT e.*, cl.nom,cl.prenom, c.adresse_local,f.*,modes_payement.*
    FROM encaissements e
    JOIN factures f ON e.facture_id = f.facture_id
    JOIN contrats c ON f.contrat_id = c.contrat_id
    JOIN clients cl ON c.client_id = cl.client_id
    JOIN modes_payement ON modes_payement.mode_payement_id = e.mode_payement_id
    WHERE MONTH(e.encaissement_date) = :mois AND YEAR(e.encaissement_date) = :annee
    ");
    $stm->bindParam(":mois", $month);
    $stm->bindParam(":annee", $year);
    $stm->execute();
    return $stm->fetchAll();
}
function Months()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT DISTINCT MONTH(encaissement_date) as month FROM encaissements ORDER BY MONTH(encaissement_date) DESC");
    $stm->execute();
    return $stm->fetchAll();
}
function updateEncaissement($Encaissement_id, $mode_payement, $Ncheque_transaction)
{
    $db = connectToDatabase();
    $stm = $db->prepare(" UPDATE `encaissements` SET `mode_payement_id`=:mode,`Ncheque,transaction`=:ref WHERE encaissement_id=:id");
    $stm->bindParam(":mode", $mode_payement);
    $stm->bindParam(":ref", $Ncheque_transaction);
    $stm->bindParam(":id", $Encaissement_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function deleteEncaissementDB($Encaissement_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare(" DELETE FROM `encaissements` WHERE encaissement_id=:id");
    $stm->bindParam(":id", $Encaissement_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function deleteEncaissementByFactureDB($facture_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare(" DELETE FROM `encaissements` WHERE facture_id=:id");
    $stm->bindParam(":id", $facture_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function insertEncaissement($facture_id, $mode, $ref, $contrat_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare(" INSERT INTO `encaissements`(`facture_id`, `mode_payement_id`, `Ncheque,transaction`, `contrat_id`) VALUES (:f,:m,:ref,:c)");
    $stm->bindParam(":f", $facture_id);
    $stm->bindParam(":m", $mode);
    $stm->bindParam(":ref", $ref);
    $stm->bindParam(":c", $contrat_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function getHistoryEncaissemnts($contrat_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT e.*, cl.nom,cl.prenom, c.adresse_local,f.*,modes_payement.*,consommations.*,localites.localite_name
    FROM encaissements e
    JOIN factures f ON e.facture_id = f.facture_id
    JOIN contrats c ON f.contrat_id = c.contrat_id
    JOIN clients cl ON c.client_id = cl.client_id
    JOIN modes_payement ON modes_payement.mode_payement_id = e.mode_payement_id
    JOIN consommations ON consommations.consommation_id=f.consommation_id
    JOIN localites ON localites.localite_id=c.localite_id
    WHERE c.contrat_id = :c
    AND (( YEAR(e.encaissement_date) = YEAR(CURDATE()) AND MONTH(e.encaissement_date) <= MONTH(CURDATE()) )
    OR ( YEAR(e.encaissement_date) = (YEAR(CURDATE())-1) AND MONTH(e.encaissement_date) >= MONTH(CURDATE()) ))
    ORDER BY e.encaissement_id");
    $stm->bindParam(":c", $contrat_id);
    $stm->execute();
    return $stm->fetchAll();
}
