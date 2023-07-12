<?php
require_once("models/ConnectDB.php");
function getLocalities()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM localites");
    $stm->execute();
    $localites = $stm->fetchAll();
    return $localites;
}
