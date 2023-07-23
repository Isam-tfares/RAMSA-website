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
            $stmt = $db->prepare("SELECT e.*, cl.nom,cl.prenom, c.adresse_local,f.*,modes_payement.*,consommations.*,localites.localite_name
            FROM encaissements e
            JOIN factures f ON e.facture_id = f.facture_id
            JOIN contrats c ON f.contrat_id = c.contrat_id
            JOIN clients cl ON c.client_id = cl.client_id
            JOIN modes_payement ON modes_payement.mode_payement_id = e.mode_payement_id
            JOIN consommations ON consommations.consommation_id=f.consommation_id
            JOIN localites ON localites.localite_id=c.localite_id
            WHERE c.contrat_id = :c
            AND
            cl.client_id=:client_id
            AND (( YEAR(e.encaissement_date) = YEAR(CURDATE()) AND MONTH(e.encaissement_date) <= MONTH(CURDATE()) )
            OR ( YEAR(e.encaissement_date) = (YEAR(CURDATE())-1) AND MONTH(e.encaissement_date) >= MONTH(CURDATE()) ))
            ORDER BY e.encaissement_id");
            $stmt->bindParam(":c", $contrat_id);
            $stmt->bindParam(":client_id", $client_id);
            $stmt->execute();
            $encaissements = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = json_encode($encaissements);
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
