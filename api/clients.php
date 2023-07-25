<?php
require_once('../models/clients.php');
require_once('../models/activities.php');
require_once('../models/ConnectDB.php');
require_once('./functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    $data = json_decode(file_get_contents('php://input'), true);

    //get Token
    $headers = apache_request_headers();
    $token = $headers['authorization'];
    $token = str_replace('Bearer ', '', $token);
    if (checkToken($data['client_id'], $token)) {
        if (isset($data['password']) && !empty($data['password']) && isset($data['client_id']) && !empty($data['client_id'])) {
            $db = connectToDatabase();
            // Insert the new request into the database
            $sql = "UPDATE `clients` SET `password`=:password WHERE `client_id`=:id";
            $stmt = connectToDatabase()->prepare($sql);
            $password = sha1($data['password']);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":id", $data['client_id']);

            if ($stmt->execute()) {
                $client = getClient($data['client_id']);
                $content = $client['nom'] . " " . $client['prenom'] . " a changé sont mot de passe";
                insertActivityClient($content, $data['client_id']);
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
                $client = getClient($data['client_id']);
                $content = $client['nom'] . " " . $client['prenom'] . " a changé ses informations";
                insertActivityClient($content, $data['client_id']);
                echo "Vos données sont mis a jour avec succés";
            } else {
                // Failed to create the request
                echo "Erreur dans le server ";
            }
        } else {
            echo "Données non valides";
        }
    } else {
        echo "Erreur dans le server ";
    }
} else {
    // Méthode de requête invalide
    echo "Méthode de requête invalide.";
}
