<?php
require_once('../models/ConnectDB.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $password = $data['password'];

    $sql = "SELECT * FROM clients WHERE email = :email";
    $db = connectToDatabase();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($stmt->rowCount() > 0) {
        if (sha1($password) == $user['password']) {
            // Generate a unique token
            $token = bin2hex(random_bytes(32));

            $updateTokenQuery = "UPDATE clients SET token = :token WHERE client_id = :client_id";
            $updateTokenStmt = $db->prepare($updateTokenQuery);
            $updateTokenStmt->bindParam(':token', $token);
            $updateTokenStmt->bindParam(':client_id', $user['client_id']);
            $updateTokenStmt->execute();

            // Return the token in the response
            $response = [
                'message' => 'Connected',
                'token' => $token,
                'user' => [
                    'id' => $user['client_id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email' => $user['email'],
                    'adresse' => $user['adresse'],
                ]
            ];
            echo json_encode($response);
        } else {
            http_response_code(401);
            $response = ['message' => 'Mot de passe incorrect.'];
            echo json_encode($response);
        }
    } else {
        http_response_code(401);
        $response = ['message' => "L'adresse e-mail n'existe pas."];
        echo json_encode($response);
    }
}
