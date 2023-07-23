<?php
require_once("models/ConnectDB.php");
require_once('./TCPDF/tcpdf.php');
function getContrats()
{
    $db = connectToDatabase();
    if (isset($_SESSION['admin'])) {
        $stm = $db->prepare("SELECT c.*, cl.*, lo.*
    FROM contrats c
    JOIN clients cl ON cl.client_id = c.client_id
    JOIN localites lo ON c.localite_id = lo.localite_id
    WHERE c.etat=1;
    ");
    } else {
        $stm = $db->prepare("SELECT c.*, lo.*
    FROM contrats c
    JOIN localites lo ON c.localite_id = lo.localite_id WHERE c.client_id=:id and c.etat=1 ORDER BY c.`numero` DESC;
    ");
        $stm->bindParam(":id", $_SESSION['client']['client_id']);
    }
    $stm->execute();
    $contrats = $stm->fetchAll();
    return $contrats;
}
function getContratsCAllDB()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT c.*, lo.*
    FROM contrats c
    JOIN localites lo ON c.localite_id = lo.localite_id WHERE c.client_id=:id  ORDER BY c.`numero` DESC;
    ");
    $stm->bindParam(":id", $_SESSION['client']['client_id']);
    $stm->execute();
    $contrats = $stm->fetchAll();
    return $contrats;
}
function getContrat($id)
{
    $db = connectToDatabase();
    if (isset($_SESSION['client']['prenom'])) {
        $stm = $db->prepare("SELECT c.*, lo.*
        FROM contrats c
        JOIN localites lo ON c.localite_id = lo.localite_id WHERE c.client_id=:id and contrat_id=:c_id ORDER BY c.`numero` DESC;
        ");
        $stm->bindParam(":c_id", $id);
        $stm->bindParam(":id", $_SESSION['client']['client_id']);
        $stm->execute();
        $contrat = $stm->fetch();
        $contrat['nom'] = $_SESSION['client']['nom'];
        $contrat['prenom'] = $_SESSION['client']['prenom'];
        return $contrat;
    } else {
        $stm = $db->prepare("SELECT c.*, lo.*,cl.nom,cl.prenom,cl.email
        FROM contrats c
        JOIN localites lo ON c.localite_id = lo.localite_id
        JOIN clients cl ON cl.client_id=c.client_id
        WHERE contrat_id=:c_id ;
        ");
        $stm->bindParam(":c_id", $id);
        $stm->execute();
        $contrat = $stm->fetch();
        return $contrat;
    }
}
function getActivesContarts()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * from contrats where etat=1");
    $stm->execute();
    $contrats = $stm->fetchAll();
    return $contrats;
}
function getActivesContartsOfClient()
{
    $db = connectToDatabase($id);
    $stm = $db->prepare("SELECT * from contrats where etat=1 and client_id=:id");
    $stm->bindParam(":id", $id);
    $stm->execute();
    $contrats = $stm->fetchAll();
    return $contrats;
}
function getNLastContrat($client)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * from contrats where client_id=:id ORDER BY numero DESC LIMIT 1");
    $stm->bindParam(":id", $client);
    $stm->execute();
    if ($stm->rowCount() > 0) {
        $contrat = $stm->fetch();
        return $contrat['numero'];
    } else {
        return 0;
    }
}
function insertContart($data, $n)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `contrats`(`client_id`, `numero`, `date_de_debut`, `date_de_fin`, `adresse_local`, `localite_id`) VALUES (:client,:numero,:dateB,:dateE,:adresse,:localite)");
    $stm->bindParam(":client", $data['client_id']);
    $stm->bindParam(":numero", $n);
    $stm->bindParam(":dateB", $data['dateBegin']);
    $stm->bindParam(":dateE", $data['dateEnd']);
    $stm->bindParam(":adresse", $data['adresse']);
    $stm->bindParam(":localite", $data['localite']);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function updateContrat($data)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `contrats` SET `client_id`=:client,`date_de_debut`=:dateB,`date_de_fin`=:dateE,`adresse_local`=:adresse,`localite_id`=:localite WHERE `contrat_id`=:id");
    $stm->bindParam(":client", $data['client_id']);
    $stm->bindParam(":dateB", $data['dateBegin']);
    $stm->bindParam(":dateE", $data['dateEnd']);
    $stm->bindParam(":adresse", $data['adresse']);
    $stm->bindParam(":localite", $data['localite']);
    $stm->bindParam(":id", $data['contrat_id']);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function isExistedAdresse($adresse)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * from contrats where adresse_local=:adresse and etat=1");
    $stm->bindParam(":adresse", $adresse);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function Resiliation($contrat_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `contrats` SET etat=0,date_de_fin=now() WHERE `contrat_id`=:id");
    $stm->bindParam(":id", $contrat_id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
