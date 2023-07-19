<?php
require_once("models/ConnectDB.php");
function getDemandes()
{
    $db = connectToDatabase();
    if (isset($_SESSION['admin'])) {
        $stm = $db->prepare("SELECT d.*, c.*, dt.demande_name
    FROM demandes d
    JOIN clients c ON d.client_id = c.client_id
    JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id ORDER BY d.etat;
    ");
    } else {
        $stm = $db->prepare("SELECT d.*, dt.demande_name
        FROM demandes d
        JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id WHERE d.client_id=:id
        ");
        $stm->bindParam(":id", $_SESSION['client']['client_id']);
    }
    $stm->execute();
    $demandes = $stm->fetchAll();
    return $demandes;
}
function getDemandesNonTraites()
{
    $db = connectToDatabase();
    $stm = $db->prepare("Select * from demandes where etat=0");
    $stm->execute();
    $demandes = $stm->fetchAll();
    return $demandes;
}
function getLastDemandes()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT d.*, c.*, dt.*
    FROM demandes d
    JOIN clients c ON d.client_id = c.client_id
    JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id  ORDER BY d.date DESC LIMIT 5");
    $stm->execute();
    $demandes = $stm->fetchAll();
    return $demandes;
}
function addDemandeToDb($type)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `demandes`( `client_id`, `demande_type_id`) VALUES (:c,:d)");
    $stm->bindParam(":c", $_SESSION['client']['client_id']);
    $stm->bindParam(":d", $type);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function addDemandeResiliationToDb($type, $contrat)
{
    $db = connectToDatabase();
    $sql = "INSERT INTO demandes (demande_type_id, client_id,contrat_id) VALUES (:d, :c,:contrat)";
    $stm = $db->prepare($sql);
    $stm->bindParam(":contrat", $contrat);
    $stm->bindParam(":c", $_SESSION['client']['client_id']);
    $stm->bindParam(":d", $type);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function addDemandeHistoriqueReleveToDb($type, $debut, $fin)
{
    $db = connectToDatabase();
    $sql = "INSERT INTO demandes (demande_type_id, client_id,historique_date_debut,historique_date_fin) VALUES (:d, :c,:history_debut,:history_fin)";
    $stm = $db->prepare($sql);
    $stm->bindParam(":history_debut", $debut);
    $stm->bindParam(":history_fin", $fin);
    $stm->bindParam(":c", $_SESSION['client']['client_id']);
    $stm->bindParam(":d", $type);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function addDemandeHistoriqueEncaissementToDb($type, $date)
{
    $db = connectToDatabase();
    $sql = "INSERT INTO demandes (demande_type_id, client_id,historique_date) VALUES (:d, :c,:history)";
    $stm = $db->prepare($sql);
    $stm->bindParam(":history", $date);
    $stm->bindParam(":c", $_SESSION['client']['client_id']);
    $stm->bindParam(":d", $type);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function getDemandeByTypeandClient($type, $client = null)
{
    if ($client == null) {
        $client = $_SESSION['client']['client_id'];
    }
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM demandes WHERE client_id=:c and demande_type_id=:t and etat=0");
    $stm->bindParam(":c", $client);
    $stm->bindParam(":t", $type);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function updateDemande($id, $files)
{

    $target_dirP = "assets/Demandes/";
    $target_pdf = basename(rand(0, 100000000000) . "_" . str_replace('\'', '_', $files["file"]["name"]));

    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `demandes` SET `etat`=1,`date_de_traitement`=now(),file_path=:f WHERE demande_id=:id"); // add file path
    $stm->bindParam(":id", $id);
    $stm->bindParam(':f', $target_pdf);

    $stm->execute();

    //#################################"   Upload file  ###############################"
    if (move_uploaded_file($files["file"]["tmp_name"], $target_dirP . $target_pdf) && $stm->rowCount() > 0) {
        return 1;
    } else {
        return 0;
    }
}
function deleteDemandeDB($id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("DELETE FROM `demandes` WHERE demande_id=:id");
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
