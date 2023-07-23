<?php
session_start();
// require Controllers
require("controllers/clients.php");
require("controllers/user.php");
require("functions/Redirect.php");
require("controllers/demandes.php");
require("controllers/messages.php");
require("controllers/demandesTypes.php");
require("controllers/contrats.php");
require("controllers/consommations.php");
require("controllers/factures.php");
require("controllers/encaissements.php");
require("models/demandes_types.php");
require("models/localites.php");
require("models/Modes_payement.php");
require_once("functions/DownloadContrat.php");

// LogOut
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
    exit;
}

// pages of admin

if (isset($_SESSION['admin'])) {
    $pages = ['home', 'clients', 'reclamations', 'demandes', 'contrats', 'demandesTypes', 'consommations', 'factures', 'encaissements'];
    $page = "home";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    if (in_array($page, $pages)) {
        include('views/admin/' . $page . '.php');
    } else {
        switch ($page) {
            case "addClient":
                addClient();
                break;
            case "editClient":
                editClient();
                break;
            case "deleteClient":
                deleteClient();
                break;
            case "traiterDemande":
                traiterDemande();
                break;
            case "deleteDemande":
                deleteDemande();
                break;
            case "updateMessage":
                traiterMessage();
                break;
            case "deleteMessage":
                deleteMessage();
                break;
            case "addContrat":
                addContrat();
                break;
            case "editContrat":
                editContrat();
                break;
            case "changePassword":
                changePassword();
                break;
            case "addDemandeType":
                addDemandeType();
                break;
            case "deleteDemandeType":
                deleteDemandeType();
                break;
            case "addAdmin":
                addAdmin();
                break;
            case "addConsommation":
                addConsommation();
                break;
            case "editConsommation":
                editConsommation();
                break;
            case "editFacture":
                editFacture();
                break;
            case "deleteFacture":
                deleteFacture();
                break;
            case "editEncaissement":
                editEncaissement();
                break;
            case "deleteEncaissement":
                deleteEncaissement();
                break;
            case "payFacture":
                payFacture();
                break;
            case "impayFacture":
                impayFacture();
                break;
            default:
                include('views/admin/home.php');
        }
    }
    // Client
} else if (isset($_SESSION['client'])) {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case "addDemande":
                addDemande();
                break;
            case "addMessage":
                addMessage();
                break;
            case "dContrat":
                downloadContrat();
                break;
            default:
                include('views/clients/home.php');
        }
    } elseif (isset($_POST['demande_id'])) {
        $demande_id = $_POST['demande_id'];
        $demande = getDemande($demande_id);
        if ($demande['demande_type_id'] == 4 && $demande['etat'] = 1) {
            $consommations = getHistoriqueConsommationsOfClient($demande['contrat_id']);
            include('views/clients/Consommations.php');
        } elseif ($demande['demande_type_id'] == 3 && $demande['etat'] = 1) {
            $encaissements = getHistoryEncaissemnts($demande['contrat_id']);
            include('views/clients/Encaissements.php');
        }
    } else {
        include('views/clients/home.php');
    }
} else {
    Login();
}
if (isset($_GET['page']) && !empty($_GET['page'])) {
    clients();
}
