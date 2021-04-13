<?php

if(isset($_GET['persoon_idpersoon'])){

    include 'database.php';
    $db = new database();

    $sql = "DELETE FROM persoon WHERE idpersoon =:idpersoon";

    $placeholders = [
        'idpersoon'=>$_GET['persoon_idpersoon']
    ];

    $db->update_or_delete($sql, $placeholders);
}

?>