<?php
require_once('../models/ConnectDB.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer la liste des demandes depuis la base de données
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['client_id'])) {
        $client_id = $data['client_id'];
        $sql = "SELECT d.*, dt.demande_name
        FROM demandes d
        JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id WHERE d.client_id=:id";
        $stmt = connectToDatabase()->prepare($sql);
        $stmt->bindParam(":id", $client_id);
        $stmt->execute();

        $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Vérifier si des demandes ont été trouvés
        if (count($demandes) > 0) {
            // Convertir les résultats en format JSON
            $response = json_encode($demandes);

            // Envoyer la réponse JSON
            header('Content-Type: application/json');
            echo $response;
        } else {
            // Aucun client trouvé
            echo "Aucun Demande trouvé.";
        }
    } else {
        echo "Aucun Demande trouvé.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['demande_type_id']) && isset($data['client_id'])) {
        $db = connectToDatabase();
        $stm = $db->prepare("SELECT * FROM demandes WHERE client_id=:c and demande_type_id=:t and etat=0");
        $stm->bindParam(":c", $data['client_id']);
        $stm->bindParam(":t", $data['demande_type_id']);
        $stm->execute();
        $res = $stm->rowCount() == 0;
        if ($res) {
            // Insert the new request into the database
            $sql = "INSERT INTO demandes (demande_type_id, client_id) VALUES (:demande_type_id, :client_id)";
            $stmt = connectToDatabase()->prepare($sql);
            $stmt->bindParam(":demande_type_id", $data['demande_type_id']);
            $stmt->bindParam(":client_id", $data['client_id']);

            if ($stmt->execute()) {
                // Request created successfully
                echo "Demande créée avec succès";
            } else {
                // Failed to create the request
                echo "Échec de la création de la demande";
            }
        } else {
            echo "Vous avez déjà demandé ce type de demande";
        }
    } else {
        echo "Données non valides";
    }
} else {
    // Méthode de requête invalide
    echo "Méthode de requête invalide.";
}
