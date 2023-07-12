<?php

require_once('../models/ConnectDB.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer la liste des clients depuis la base de données
    $sql = "SELECT * FROM clients";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->execute();

    // Récupérer les résultats de la requête
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des clients ont été trouvés
    if (count($clients) > 0) {
        // Convertir les résultats en format JSON
        $response = json_encode($clients);

        // Envoyer la réponse JSON
        header('Content-Type: application/json');
        echo $response;
    } else {
        // Aucun client trouvé
        echo "Aucun client trouvé.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['password']) && !empty($data['password']) && isset($data['client_id']) && !empty($data['client_id'])) {
        $db = connectToDatabase();
        // Insert the new request into the database
        $sql = "UPDATE `clients` SET `password`=:password WHERE `client_id`=:id";
        $stmt = connectToDatabase()->prepare($sql);
        $password = sha1($data['password']);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":id", $data['client_id']);

        if ($stmt->execute()) {
            // Request created successfully
            echo "Mot de passe est mis a jour avec succés";
        } else {
            // Failed to create the request
            echo "Erreur dans le server ";
        }
    } elseif (isset($data['nom']) && !empty($data['nom']) && isset($data['prenom']) && !empty($data['prenom']) && isset($data['email']) && !empty($data['email']) && isset($data['adresse']) && !empty($data['adresse'])) {
        $db = connectToDatabase();
        // Insert the new request into the database
        $sql = "UPDATE `clients` SET nom=:nom,prenom=:prenom,email=:email,adresse=:adresse WHERE `client_id`=:id";
        $stmt = connectToDatabase()->prepare($sql);
        $stmt->bindParam(":id", $data['client_id']);
        $stmt->bindParam(":nom", $data['nom']);
        $stmt->bindParam(":prenom", $data['prenom']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":adresse", $data['adresse']);

        if ($stmt->execute()) {
            // Request created successfully
            echo "Vos données sont mis a jour avec succés";
        } else {
            // Failed to create the request
            echo "Erreur dans le server ";
        }
    } else {
        echo "Données non valides";
    }
} else {
    // Méthode de requête invalide
    echo "Méthode de requête invalide.";
}
