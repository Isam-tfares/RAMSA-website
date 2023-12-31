<?php
require("models/clients.php");
function clients()
{
    $clients = getClients();
    return $clients;
}
function addClient()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }

    if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['tel']) && !empty($_POST['tel']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['password']) && !empty($_POST['password']) && !EmailIsExisted($_POST['email'])) {
        $res = insert($_POST);
        if ($res) {
            $content = $_SESSION['admin']['email'] . " a ajouté un client : " . $_POST['nom'] . " " . $_POST['prenom'];
            insertActivityAdmin($content, $_SESSION['admin']['id']);
        }
        RedirectwithPost("?page=clients", $res, "Un client a été ajouté avec succés");
    } else {
        RedirectwithPost("?page=clients", 0, "Verifier les données du client");
    }
}

function editClient()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['tel']) && !empty($_POST['tel']) && isset($_POST['adresse']) && !empty($_POST['adresse'])) {
        $res = update($_POST);
        if ($res) {
            $content = $_SESSION['admin']['email'] . " a modifié les infos du client " . $_POST['nom'] . " " . $_POST['prenom'];
            insertActivityAdmin($content, $_SESSION['admin']['id']);
        }
        RedirectwithPost("?page=clients", $res, "Les données du client ont été mis a jour avec succés");
    } else {
        Redirect("?page=clients");
    }
}
function deleteClient()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
        $res = delete($_POST['client_id']);
        RedirectwithPost("?page=clients", $res, "Un client a été supprimé avec succés");
    } else {
        Redirect("?page=clients");
    }
}
