<?php
//index.php

// start the session
session_start();

// include the database class
include "database.php";

require_once('header.php');
// field validation
if(isset($_POST['submit'])){

    $fields = ['naam', 'adres', 'plaats', 'postcode', 'telefoon', 'van', 'tot', 'idkamer'];

    $error = false;

    foreach($fields as $field){
        if(!isset($_POST[$field]) || empty($_POST[$field])){
         $error = true;
    }
}

if(!$error){
    // store posted form values in variables
    $naam= $_POST['naam'];
    $adres= $_POST['adres'];
    $plaats= $_POST['plaats'];
    $postcode= $_POST['postcode'];
    $telefoon= $_POST['telefoon'];
    $van= $_POST['van'];
    $tot= $_POST['tot'];
    $idkamer= $_POST['idkamer'];


        
    $database = new database();
    // reserveren function
    $database->reserveren($naam, $adres, $plaats ,$postcode, $telefoon, $van, $tot, $idkamer);
 }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body> 
<div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <img class="img-fluid blur" style="float: left;" src="image/hotel.jpg" alt="bloemenvelden">
            </div>
            <div class="col-1"></div>
        <div class="col-4 ruimte border shadow p-3 mb-5 bg-white rounded registreer">
            <form class="form-signin" action="reserveren.php" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Reserveren</h1>

                <label for="naam">naam</label>
                <input type="text" name="naam" class="form-control" required="">
                <br>

                <label for="adres">adres</label>
                <input type="text" name="adres" class="form-control" required="">
                <br>

                <label for="plaats">plaats</label>
                <input type="text" name="plaats" class="form-control" required="">
                <br>

                <label for="postcode">postcode</label>
                <input type="text" name="postcode" class="form-control" required="">
                <br>

                <label for="telefoon">telefoon</label>
                <input type="text" name="telefoon" class="form-control" required="">
                <br>

                <label for="van">van</label>
                <input type="date" name="van" class="form-control" required="">
                <br>

                <label for="tot">tot</label>
                <input type="date" name="tot" class="form-control" required="">
                <br>

                <?php
                $database = new database();
                ($kamer=$database->kamernummer());
                    echo "<select name='idkamer'>";
                 foreach ($kamer as $kamer): {
                    echo "<option value='" .$kamer['idkamer']."'> ".$kamer['idkamer'] . "</option>";
                 }
                endforeach;
                echo "</select>";
                ?>
                <br>
                <br>

                <input type="submit" name="submit" class="btn btn-lg btn btn-primary btn-block" value="Reserveer">
                <br>

                <button type="button" class="btn btn-lg btn btn-primary btn-block"><a href="reserverenpdf.php">Reserveren met PDF</a></button>

            </form>
        </div>
    </div>
</div>  
</body>

<?php
require_once('footer.php');
?>