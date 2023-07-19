<?php
require_once('../models/ConnectDB.php');
require_once('../functions/DownloadContrat.php');
require_once('../TCPDF/tcpdf.php');
require_once('./functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $headers = apache_request_headers();
    $token = $headers['authorization'];
    $token = str_replace('Bearer ', '', $token);
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['client_id'])) {
        $client_id = $data['client_id'];
        if (checkToken($client_id, $token)) {
            // Valid token, proceed with retrieving contrats
            $sql = "SELECT contrats.*, localites.* FROM contrats, localites WHERE localites.localite_id=contrats.localite_id AND contrats.client_id=:id AND contrats.etat=1";
            $stmt = connectToDatabase()->prepare($sql);
            $stmt->bindParam(":id", $client_id);
            $stmt->execute();

            $contrats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($contrats) > 0) {
                $response = json_encode($contrats);
                header('Content-Type: application/json');
                echo $response;
            } else {
                header('Content-Type: application/json');
                echo json_encode([]);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode([]);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode([]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT contrats.*,localites.*,clients.* FROM contrats,localites,clients WHERE localites.localite_id=contrats.localite_id and contrats.contrat_id=:id and contrats.client_id=clients.client_id ";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->bindParam(":id", $_GET['contrat_id']);
    $stmt->execute();

    $demande = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si des demandes ont été trouvés
    if (count($demande) > 0) {
        download($demande);
    } else {
        // Aucun client trouvé
        echo "Aucun Contrat trouvé.";
    }
} else {
    // Méthode de requête invalide
    echo "Méthode de requête invalide.";
}
