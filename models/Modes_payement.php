<?php
require_once('./models/ConnectDB.php');
function getModes()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT * FROM modes_payement");
    $stm->execute();
    return $stm->fetchAll();
}
