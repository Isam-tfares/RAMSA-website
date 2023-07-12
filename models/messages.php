<?php
require_once("models/ConnectDB.php");
function getMessages()
{
    $db = connectToDatabase();
    if (isset($_SESSION['admin'])) {
        $stm = $db->prepare("SELECT messages.*,clients.* FROM messages INNER JOIN clients WHERE clients.client_id=messages.client_id ");
    } else {
        $stm = $db->prepare("SELECT messages.* FROM messages WHERE messages.client_id=:id ");
        $stm->bindParam(":id", $_SESSION['client']['client_id']);
    }
    $stm->execute();
    $messages = $stm->fetchAll();
    return $messages;
}
function getLastMessages()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT messages.*,clients.* FROM messages INNER JOIN clients WHERE clients.client_id=messages.client_id ORDER BY `messages`.`message_date` DESC LIMIT 5");
    $stm->execute();
    $messages = $stm->fetchAll();
    return $messages;
}
function insertMessage($message)
{
    $db = connectToDatabase();
    $stm = $db->prepare("INSERT INTO `messages`( `message_content`, `client_id`) VALUES (:m,:c)");
    $stm->bindParam(":c", $_SESSION['client']['client_id']);
    $stm->bindParam(":m", $message);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function updateMessage($id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("UPDATE `messages` SET `message_statut`='1' WHERE message_id=:id"); // add file path
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function deleteMessageDB($id)
{
    $db = connectToDatabase();
    $stm = $db->prepare("DELETE FROM `messages` WHERE message_id=:id");
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->rowCount() > 0;
}
function MessagesNonLues()
{
    $db = connectToDatabase();
    $stm = $db->prepare("SELECT messages.*,clients.* FROM messages INNER JOIN clients WHERE clients.client_id=messages.client_id  and messages_statut=0");
    $stm->execute();
    $messages = $stm->fetchAll();
    return $messages;
}
