<?php
require('models/contrats.php');

function getContratsC()
{
    $contrats = getContrats();
    return $contrats;
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
        RedirectwithPost("?page=contrats", $res, "Un Contrat a été mis a jour avec succés");
    }
}
