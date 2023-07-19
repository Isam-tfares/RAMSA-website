<?php
require_once('./models/ConnectDB.php');
function getConsommationsOfLastMonth($lastMonthNumber, $lastMonthYear)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT c.contrat_id,c.adresse_local, cl.nom,cl.prenom, cons.consommation_index2
    FROM contrats c
    JOIN clients cl ON c.client_id = cl.client_id
    JOIN (
        SELECT contrat_id, MAX(consommation_mois) AS last_month
        FROM consommations
        WHERE consommation_mois = :month AND consommation_annee = :year
        GROUP BY contrat_id
    ) last_cons ON c.contrat_id = last_cons.contrat_id
    JOIN consommations cons ON last_cons.contrat_id = cons.contrat_id AND last_cons.last_month = cons.consommation_mois ORDER BY c.contrat_id");
    $stm->bindParam(":month", $lastMonthNumber);
    $stm->bindParam(":year", $lastMonthYear);
    $stm->execute();
    return $stm->fetchAll();
}
function Years()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT DISTINCT consommation_annee FROM consommations ORDER BY consommation_annee DESC");
    $stm->execute();
    return $stm->fetchAll();
}
function Mounths()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT DISTINCT consommation_mois FROM consommations ORDER BY consommation_mois DESC");
    $stm->execute();
    return $stm->fetchAll();
}
function getHistoriqueConsommationsDB($year, $mounth)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT c.contrat_id,c.adresse_local, cl.nom,cl.prenom, cons.*
    FROM contrats c
    JOIN clients cl ON c.client_id = cl.client_id
    JOIN (
        SELECT contrat_id, MAX(consommation_mois) AS last_month
        FROM consommations
        WHERE consommation_mois = :month AND consommation_annee = :year
        GROUP BY contrat_id
    ) last_cons ON c.contrat_id = last_cons.contrat_id
    JOIN consommations cons ON last_cons.contrat_id = cons.contrat_id AND last_cons.last_month = cons.consommation_mois");
    $stm->bindParam(":month", $mounth);
    $stm->bindParam(":year", $year);
    $stm->execute();
    return $stm->fetchAll();
}
function getLastIndex($contrat_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT MAX(consommation_index2) as max FROM `consommations` WHERE contrat_id=:c;");
    $stm->bindParam(":c", $contrat_id);
    $stm->execute();
    return $stm->fetch()['max'];
}
function addConsommationDB($contrat_id, $index2, $index1, $mounth, $year)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `consommations`(`contrat_id`, `consommation_mois`, `consommation_annee`, `consommation_index1`, `consommation_index2`) VALUES (:c,:m,:y,:i1,:i2)");
    $stm->bindParam(":c", $contrat_id);
    $stm->bindParam(":m", $mounth);
    $stm->bindParam(":y", $year);
    $stm->bindParam(":i1", $index1);
    $stm->bindParam(":i2", $index2);
    $stm->execute();
    if ($stm->rowCount() == 0) {
        return false;
    }
    $consommationId = $db->lastInsertId();
    return $consommationId;
}
function ConsommationOfMounthAndYearOfContrat($mounth, $year, $contrat_id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM `consommations` WHERE `contrat_id`=:c AND  `consommation_mois`=:m AND  `consommation_annee`=:y");
    $stm->bindParam(":c", $contrat_id);
    $stm->bindParam(":m", $mounth);
    $stm->bindParam(":y", $year);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function getConsommationsOfCMDB($monthNumber, $year)
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT c.contrat_id, c.adresse_local, cl.nom, cl.prenom, 
    IFNULL(cons.consommation_index2, NULL) AS consommation_index2,
    IFNULL(cons.consommation_index1, NULL) AS consommation_index1,cons.consommation_id
    FROM contrats c
    JOIN clients cl ON c.client_id = cl.client_id
    LEFT JOIN consommations cons ON c.contrat_id = cons.contrat_id 
        AND cons.consommation_mois = :month AND cons.consommation_annee = :year ORDER BY c.contrat_id
    ");
    $stm->bindParam(":month", $monthNumber);
    $stm->bindParam(":year", $year);
    $stm->execute();

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function updateConsommation($id, $index2)
{
    $db = connectToDatabase();
    $stm = $db->prepare(" UPDATE `consommations` SET `consommation_index2`=:index2 WHERE `consommation_id`=:id");
    $stm->bindParam(":index2", $index2);
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
