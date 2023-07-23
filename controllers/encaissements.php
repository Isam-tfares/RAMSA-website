<?php
require_once('./models/encaissements.php');
function getAllEncaissements($month, $year)
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    return getAll($month, $year);
}
function addEncaissemnt()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    print_r($_POST);
}
function editEncaissement()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['encaissement_id']) && isset($_POST['mode_payement']) && isset($_POST['Ncheque,transaction'])) {
        $res = updateEncaissement($_POST['encaissement_id'], $_POST['mode_payement'], $_POST['Ncheque,transaction']);
        RedirectwithPost("index.php?page=encaissements", $res);
    } else {
        Redirect("index.php?page=encaissements");
    }
}
function deleteEncaissement()
{
    if (!isset($_SESSION['admin'])) {
        header("location:index.php");
        exit;
    }
    if (isset($_POST['facture_id'])) {
        $res = deleteEncaissementDB($_POST['facture_id']);
        RedirectwithPost("index.php?page=encaissements", $res);
    } else {
        Redirect("index.php?page=encaissements");
    }
}
