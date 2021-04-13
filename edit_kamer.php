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



if(isset($_GET['kamer_idkamer'])){
    $db = new database();
    $kamer = $db->select("SELECT * FROM kamer WHERE idkamer = :idkamer", ['idkamer'=>$_GET['kamer_idkamer']]);
}
    
// if(isset($_POST['submit'])){
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "UPDATE kamer SET kamernummer=:kamernummer WHERE idkamer=:idkamer";

    $placeholders = [
        'kamernummer'=>$_POST['kamernummer'],
        'idkamer'=>$_POST['idkamer']
    ];

    
    $db->update_or_delete($sql, $placeholders);

}
?>


<form action="edit_kamer.php" method="POST">
<input type="hidden" name="idkamer" value="<?php echo isset($_GET['kamer_idkamer']) ? $_GET['kamer_idkamer'] : '' ?>">
<input type="text" name="kamernummer" placeholder="kamernummer" value="<?php echo isset($kamer) ? $kamer[0]['kamernummer'] : ''?>">
<input type="submit" value="Edit">

</form>
    
</body>
</html>