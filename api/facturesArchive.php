<?php
require_once('../models/ConnectDB.php');
require_once('./functions.php');

$headers = apache_request_headers();
$token = $headers['authorization'];
$token = str_replace('Bearer ', '', $token);
$data = json_decode(file_get_contents('php://input'), true);
if (checkToken($data["client_id"], $token)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($data['client_id'])) {
            $client_id = $data['client_id'];
            $db = connectToDatabase();
            $stmt = $db->prepare("SELECT f.*, c.*,cons.*
            FROM factures f
            JOIN contrats c ON f.contrat_id = c.contrat_id
            JOIN clients cl ON c.client_id = cl.client_id
            JOIN consommations cons ON cons.consommation_id = f.consommation_id
            WHERE cl.client_id=:client_id AND f.etat=1
            ORDER BY f.facture_id DESC");
            $stmt->bindParam(":client_id", $client_id);
            $stmt->execute();
            $factures = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = json_encode($factures);
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
