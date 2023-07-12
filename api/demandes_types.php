<?php

require_once('../models/ConnectDB.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM demandes_types";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->execute();
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($demandes) > 0) {
        $response = json_encode($demandes);
        header('Content-Type: application/json');
        echo $response;
    } else {
        echo "Aucun Demande trouvé.";
    }
} else {
    echo "Méthode de requête invalide.";
}
