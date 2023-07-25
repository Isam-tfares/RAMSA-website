<?php
require_once('../models/clients.php');
require_once('../models/activities.php');
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
            $sql = "SELECT d.*, dt.demande_name
            FROM demandes d
            JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id WHERE d.client_id=:id";
            $stmt = connectToDatabase()->prepare($sql);
            $stmt->bindParam(":id", $client_id);
            $stmt->execute();
            $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql2 = "SELECT d.*, dt.demande_name
            FROM demandes_abonnement d
            JOIN demandes_types dt ON d.demande_type_id = dt.demande_type_id WHERE d.client_id=:id";
            $stmt = connectToDatabase()->prepare($sql2);
            $stmt->bindParam(":id", $client_id);
            $stmt->execute();
            $demandes2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $allDemandes = array_merge($demandes, $demandes2);
            $response = json_encode($allDemandes);
            header('Content-Type: application/json');
            echo $response;
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

        if (isset($data['demande_type_id']) && isset($data['client_id'])) {
            if ($data['demande_type_id'] == 1) {
                $db = connectToDatabase();
                $stm = $db->prepare("SELECT * FROM demandes_abonnement WHERE client_id=:c  and etat=0");
                $stm->bindParam(":c", $data['client_id']);
                $stm->execute();
                $res = $stm->rowCount() == 0;
                if ($res) {
                    if (isset($data['adresse']) && !empty($data['adresse']) && isset($data['localite']) && !empty($data['localite'])) {
                        $db = connectToDatabase();
                        $stm = $db->prepare("INSERT INTO demandes_abonnement (client_id,adresse_local,localite_id) VALUES (:c,:a,:l)");
                        $stm->bindParam(":c", $data['client_id']);
                        $stm->bindParam(":a", $data['adresse']);
                        $stm->bindParam(":l", $data['localite']);
                        if ($stm->execute()) {
                            $client = getClient($data['client_id']);
                            $content = $client['nom'] . " " . $client['prenom'] . " a demandé une demande d'abonnement";
                            insertActivityClient($content, $data['client_id']);
                            echo "Demande créée avec succès";
                        } else {
                            echo "Échec de la création de la demande";
                        }
                    } else {
                        echo "Échec de la création de la demande";
                    }
                } else {
                    $db = connectToDatabase();
                    $stm = $db->prepare("SELECT * FROM demandes_types WHERE demande_type_id=:id");
                    $stm->bindParam(":id", $data['demande_type_id']);
                    $stm->execute();
                    echo "Vous avez déjà demandé " . $stm->fetch()['demande_name'];
                }
            } else {
                $db = connectToDatabase();
                $stm = $db->prepare("SELECT * FROM demandes WHERE client_id=:c and demande_type_id=:t and etat=0");
                $stm->bindParam(":c", $data['client_id']);
                $stm->bindParam(":t", $data['demande_type_id']);
                $stm->execute();
                $res = $stm->rowCount() == 0;
                if ($res) {
                    if (isset($data['contrat_id']) && !empty($data['contrat_id'])) {
                        $stm = $db->prepare("INSERT INTO demandes (client_id,demande_type_id,contrat_id) VALUES (:c,:d,:con) ");
                        $stm->bindParam(":c", $data['client_id']);
                        $stm->bindParam(":d", $data['demande_type_id']);
                        $stm->bindParam(":con", $data['contrat_id']);
                        if ($stm->execute()) {
                            // Request created successfully
                            $stm = connectToDatabase()->prepare("SELECT * FROM demandes_types WHERE demande_type_id=:id");
                            $stm->bindParam(":id", $data['demande_type_id']);
                            $stm->execute();
                            $client = getClient($data['client_id']);
                            $content = $client['nom'] . " " . $client['prenom'] . " a demandé une " . $stm->fetch()['demande_name'] . " pour Contrat id: " . $data['contrat_id'];
                            insertActivityClient($content, $data['client_id']);
                            echo "Demande créée avec succès";
                        } else {
                            // Failed to create the request
                            echo "Échec de la création de la demande";
                        }
                    } else {
                        echo "Échec de la création de la demande";
                    }
                } else {
                    $db = connectToDatabase();
                    $stm = $db->prepare("SELECT * FROM demandes_types WHERE demande_type_id=:id");
                    $stm->bindParam(":id", $data['demande_type_id']);
                    $stm->execute();
                    echo "Vous avez déjà demandé " . $stm->fetch()['demande_name'];
                }
            }
        } else {
            echo "Données non valides";
        }
    } else {

        echo "Méthode de requête invalide.";
    }
} else {
    echo "Vous n'etes pas authentifiée";
}
