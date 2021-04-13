<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'database.php';
$db = new database();



if(isset($_GET['persoon_idpersoon'])){
    $db = new database();
    $persoon = $db->select("SELECT * FROM persoon WHERE idpersoon = :idpersoon", ['idpersoon'=>$_GET['persoon_idpersoon']]);
    //print_r($artikel); // uitkomst in browser: Array ( [0] => Array ( [id] => 5 [artikel] => bloesem [prijs] => 5.95 ) )
}
    
// if(isset($_POST['submit'])){
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "UPDATE persoon SET naam=:naam, adres=:adres, plaats=:plaats, postcode=:postcode, telefoon=:telefoon WHERE idpersoon=:idpersoon";

    $placeholders = [
        'naam'=>$_POST['naam'],
        'adres'=>$_POST['adres'],
        'plaats'=>$_POST['plaats'],
        'postcode'=>$_POST['postcode'],
        'telefoon'=>$_POST['telefoon'],
        'idpersoon'=>$_POST['idpersoon']
    ];

    
    $db->update_or_delete($sql, $placeholders);

}
?>


<form action="edit_persoon.php" method="POST">
<input type="hidden" name="idpersoon" value="<?php echo isset($_GET['persoon_idpersoon']) ? $_GET['persoon_idpersoon'] : '' ?>">
<input type="text" name="naam" placeholder="naam" value="<?php echo isset($persoon) ? $persoon[0]['naam'] : ''?>">
<input type="text" name="adres" placeholder="adres" value="<?php echo isset($persoon) ? $persoon[0]['adres'] : ''?>">
<input type="text" name="plaats" placeholder="plaats" value="<?php echo isset($persoon) ? $persoon[0]['plaats'] : ''?>">
<input type="text" name="postcode" placeholder="postcode" value="<?php echo isset($persoon) ? $persoon[0]['postcode'] : ''?>">
<input type="text" name="telefoon" placeholder="telefoon" value="<?php echo isset($persoon) ? $persoon[0]['telefoon'] : ''?>">
<input type="submit" value="Edit">

</form>
    
</body>
</html>