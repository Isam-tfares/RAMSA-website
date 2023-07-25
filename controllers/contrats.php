<?php
require('models/contrats.php');
require_once('models/clients.php');
require_once('./functions/DownloadContrat.php');

function getContratsC()
{
    $contrats = getContrats();
    return $contrats;
}
function getContratsCAll()
{
    $contrats = getContratsCAllDB();
    return $contrats;
}
function isHisContrat($id)
{
    $contrats = getContratsC();
    foreach ($contrats as $contrat) {
        if ($contrat['contrat_id'] == $id) {
            return true;
        }
    }
    return false;
}
function getActivesContartsC()
{
    $contrats = getActivesContarts();
    return $contrats;
}
function addContrat()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }

    if (isset($_POST['client_id']) && !empty($_POST['client_id']) && isset($_POST['dateBegin']) && !empty($_POST['dateBegin']) && isset($_POST['dateEnd']) && !empty($_POST['dateEnd']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['localite']) && !empty($_POST['localite'])) {
        $n = getNLastContrat($_POST['client_id']) + 1;
        $res = insertContart($_POST, $n);
        if ($res) {
            $client = getClient($_POST['client_id']);
            $content = $_SESSION['admin']['email'] . " a ajouté un contrat (contrat_id : " . $res . " ) au client " . $client['nom'] . " " . $client['prenom'];
            insertActivityAdmin($content, $_SESSION['admin']['id']);
        }
        RedirectwithPost("?page=contrats", $res, "Un Contrat a été ajouté avec succés");
    }
}

function editContrat()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['client_id']) && !empty($_POST['client_id']) && isset($_POST['dateBegin']) && !empty($_POST['dateBegin']) && isset($_POST['dateEnd']) && !empty($_POST['dateEnd']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['localite']) && !empty($_POST['localite'])) {
        $res = updateContrat($_POST);
        if ($res) {
            $client = getClient($_POST['client_id']);
            $content = $_SESSION['admin']['email'] . " a modifié les infos du  contrat (contrat_id : " . $_POST['contrat_id'] . " ) au client " . $client['nom'] . " " . $client['prenom'];
            insertActivityAdmin($content, $_SESSION['admin']['id']);
        }
        RedirectwithPost("?page=contrats", $res, "Un Contrat a été mis a jour avec succés");
    }
}

function downloadContrat()
{
    if (isset($_POST['contrat_id']) && isHisContrat($_POST['contrat_id'])) {
        download(getContrat($_POST['contrat_id']));
    } else {
        Redirect("index.php");
    }
}
