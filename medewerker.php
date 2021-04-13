<?php
// this inserts the header
    require_once('header.php');

   // include the database class
    include "database.php";
    session_start();

$db = new database();
echo $_SESSION['uname'];


?>


<body>
<div class="containter-fluid">
    <div class="row ruim">
        <div class="col-4 ruimte"></div>

        <div class="col-2">
            <button type="button" class="btn btn-primary btn-lg btn btn-primary"><a href="overzicht_kamer.php">Overzicht kamer</a></button>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn btn-primary btn-lg btn btn-primary"><a href="overzicht_persoon.php">Overzicht persoon</a></button>
        </div>

        <div class="col-4"></div>
    </div>
</div>
</body>




    

<?php
// this inserts the header
    require_once('footer.php');
?>