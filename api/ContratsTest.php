<?php
require_once('../models/ConnectDB.php');

// $headers = apache_request_headers();
// $token = $headers['Authorization'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $headers = apache_request_headers();
    $token = $headers['authorization'];
    $token = str_replace('Bearer ', '', $token);
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['client_id'])) {
        $client_id = $data['client_id'];

        // Check token
        $sql1 = "SELECT * FROM clients WHERE client_id=:id AND token=:token";
        $stm = connectToDatabase()->prepare($sql1);
        $stm->bindParam(":id", $client_id);
        $stm->bindParam(":token", $token);
        $stm->execute();

        if ($stm->rowCount() > 0) {
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
            echo json_encode([[
                "contrat_id" => 2,
                "client_id" => 2,
                "numero" => 1,
                "date_de_debut" => "2023-07-06",
                "date_de_fin" => "2024-07-15",
                "adresse_local" => "token ghalt",
                "localite_id" => 1,
                "etat" => 1,
                "localite_name" => "Agadir"
            ]]);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode([[
            "contrat_id" => 2,
            "client_id" => 2,
            "numero" => 1,
            "date_de_debut" => "2023-07-06",
            "date_de_fin" => "2024-07-15",
            "adresse_local" => "else lakhra",
            "localite_id" => 1,
            "etat" => 1,
            "localite_name" => "Agadir"
        ]]);
    }
}
