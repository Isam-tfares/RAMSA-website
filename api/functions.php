<?php
function checkToken($client_id, $token)
{
    $sql = "SELECT * FROM clients WHERE client_id=:id AND token=:token";
    $stm = connectToDatabase()->prepare($sql);
    $stm->bindParam(":id", $client_id);
    $stm->bindParam(":token", $token);
    $stm->execute();
    return $stm->rowCount() > 0;
}
