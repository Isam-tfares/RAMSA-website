<?php
require_once('../models/ConnectDB.php');
require_once('./functions.php');

$headers = apache_request_headers();
$token = $headers['authorization'];
$token = str_replace('Bearer ', '', $token);
$data = json_decode(file_get_contents('php://input'), true);
if (checkToken($data["client_id"], $token)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($data['client_id']) && isset($data['contrat_id'])) {
            $client_id = $data['client_id'];
            $contrat_id = $data['contrat_id'];
            $db = connectToDatabase();
            $stmt = $db->prepare("SELECT
            consommations.*,contrats.*,clients.nom,clients.prenom,localites.localite_name
            FROM
            consommations
            JOIN contrats ON contrats.contrat_id=consommations.contrat_id
            JOIN clients ON clients.client_id=contrats.client_id
            JOIN localites ON contrats.localite_id=localites.localite_id
            WHERE
            consommations.contrat_id = :contrat_id
            AND
            clients.client_id=:client_id
            AND (( consommations.consommation_annee = YEAR(CURDATE()) AND consommations.consommation_mois <= MONTH(CURDATE()) )
            OR ( consommations.consommation_annee = (YEAR(CURDATE())-1) AND consommations.consommation_mois >= MONTH(CURDATE()) ))
            ORDER BY consommations.consommation_id");
            $stmt->bindParam(":contrat_id", $contrat_id);
            $stmt->bindParam(":client_id", $client_id);
            $stmt->execute();
            $consommations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = json_encode($consommations);
            header('Content-Type: application/json');
            echo $response;
        }
    } else {
        // Méthode de requête invalide
        echo "Méthode de requête invalide.";
    }
} else {
    echo "Vous n'etes pas authentifiée";
}
