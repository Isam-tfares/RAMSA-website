<?php
require_once('../models/ConnectDB.php');
require_once('../functions/DownloadContrat.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer la liste des demandes depuis la base de données
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['client_id'])) {
        $client_id = $data['client_id'];
        $sql = "SELECT contrats.*,localites.* FROM contrats,localites WHERE localites.localite_id=contrats.localite_id and contrats.client_id=:id and contrats.etat=1 ";
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
        echo "Aucun Contrat trouvé.";
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
