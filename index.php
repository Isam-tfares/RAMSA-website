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
require("models/demandes_types.php");
require("models/localites.php");

// LogOut
if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
    exit;
}

// pages of admin

if (isset($_SESSION['admin'])) {
    $pages = ['home', 'clients', 'demandes', 'contrats', 'demandesTypes'];
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
            default:
                include('views/clients/home.php');
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
