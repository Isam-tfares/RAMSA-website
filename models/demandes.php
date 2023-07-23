<?php
require_once("models/ConnectDB.php");
function getDemandes()
{
    $db = connectToDatabase();
    if (isset($_SESSION['admin'])) {
        $stm = $db->prepare("SELECT d.*, c.*, dt.demande_name , con.adresse_local
    FROM demandes2 d
    JOIN clients c ON d.client_id = c.client_id
    JOIN contrats con ON d.contrat_id = con.contrat_id
    JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id ORDER BY d.etat;
    ");
        $stm->execute();
        $demandes = $stm->fetchAll();
        $stmt = $db->prepare("SELECT demandes_abonnement.*,clients.* FROM  demandes_abonnement,clients WHERE clients.client_id=demandes_abonnement.client_id ");
        $stmt->execute();
        $demandes2 = $stmt->fetchAll();
        return [$demandes, $demandes2];
    } else {
        $stm = $db->prepare("SELECT d.*, dt.demande_name
        FROM demandes2 d
        JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id WHERE d.client_id=:id
        ");
        $stm->bindParam(":id", $_SESSION['client']['client_id']);
        $stm->execute();
        $demandes = $stm->fetchAll();
        $stmt = $db->prepare("SELECT d.*
        FROM demandes_abonnement d
        WHERE d.client_id=:id 
        ");
        $stmt->bindParam(":id", $_SESSION['client']['client_id']);
        $stmt->execute();
        $demandes2 = $stmt->fetchAll();
        return [$demandes, $demandes2];
    }
}
function getDemande($demande_id, $abonnement = null)
{
    $db = connectToDatabase();
    if ($abonnement) {
        $stmt = $db->prepare("SELECT * FROM demandes_abonnement WHERE demande_id=:id");
        $stmt->bindParam(":id", $demande_id);
        $stmt->execute();
        return  $stmt->fetch();
    } else {
        $stmt = $db->prepare("SELECT * FROM demandes2 WHERE demande_id=:id");
        $stmt->bindParam(":id", $demande_id);
        $stmt->execute();
        return  $stmt->fetch();
    }
}
function demandesAbonnements()
{
    $db = connectToDatabase();
    $stmt = $db->prepare("SELECT demandes_abonnement.*,clients.* FROM  demandes_abonnement,clients WHERE clients.client_id=demandes_abonnement.client_id ");
    $stmt->execute();
    $demandes = $stmt->fetchAll();
    return $demandes;
}
function demandes($type)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT d.*, c.*, dt.demande_name,con.adresse_local
    FROM demandes2 d
    JOIN clients c ON d.client_id = c.client_id
    JOIN contrats con ON d.contrat_id = con.contrat_id
    JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id
     WHERE dt.demande_type_id=:type 
     ORDER BY d.etat;
    ");
    $stm->bindParam(":type", $type);
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
function addDemandeToDb($type, $client, $contrat_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO demandes2 (client_id,demande_type_id,contrat_id) VALUES (:c,:d,:con) ");
    $stm->bindParam(":c", $client);
    $stm->bindParam(":d", $type);
    $stm->bindParam(":con", $contrat_id);
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
function DemandeisAlreadyExisted($type, $client_id, $contrat_id = null)
{
    $db = connectToDatabase();
    if ($type == 1) {
        $stm = $db->prepare("SELECT * FROM demandes_abonnement WHERE client_id=:id and etat=0");
    } else {
        $stm = $db->prepare("SELECT * FROM demandes2 WHERE client_id=:id and etat=0 and demande_type_id=:type and contrat_id=:c");
        $stm->bindParam(":type", $type);
        $stm->bindParam(":c", $contrat_id);
    }
    $stm->bindParam(":id", $client_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function insertDemandeAbonnement($client_id, $adresse, $localite_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO demandes_abonnement (client_id,adresse_local,localite_id) VALUES (:c,:a,:l)");
    $stm->bindParam(":c", $client_id);
    $stm->bindParam(":a", $adresse);
    $stm->bindParam(":l", $localite_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function updateDemandeAbonnement($demande_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE demandes_abonnement SET `etat`=1,`date_traitement`=now(),time_traitement=now()  WHERE demande_id=:id"); // add file path
    $stm->bindParam(":id", $demande_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function updateOtherDemandes($demande_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE demandes2 SET `etat`=1,`date_traitement`=now(),time_traitement=now()  WHERE demande_id=:id"); // add file path
    $stm->bindParam(":id", $demande_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}

function updateDemandeContratAndHistory($demande_id, $file)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE demandes2 SET `etat`=1,`date_traitement`=now(),time_traitement=now(),file_path=:file  WHERE demande_id=:id"); // add file path
    $stm->bindParam(":id", $demande_id);
    $stm->bindParam(":file", $file);
    $stm->execute();
    return $stm->rowCount() > 0;
}
