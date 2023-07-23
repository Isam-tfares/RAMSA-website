<?php
require_once('../models/ConnectDB.php');
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
            $sql = "SELECT * FROM  localites ";
            $stmt = connectToDatabase()->prepare($sql);
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
} else {
    // Méthode de requête invalide
    echo "Méthode de requête invalide.";
}
