<?php
// database.php
class database{
    private $servername;
    private $database;
    private $username;
    private $password;
    private $conn;

function __construct() {
    $this->servername ='localhost';
    $this->database ='hotel';
    $this->username ='root';
    $this->password ='';

    try{
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password,);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo"<br>";
        echo"connected successfully";
        echo"<br>";
    }   catch(PDOException $e) {
        echo "connection failed" . $e->getMessage();
    }
        
}

// insert medewerker accout voor inloggen 
function insert_admin(){
    
    $sql = "INSERT INTO medewerkers VALUE (:medewerkerscode, :voorletters, :voorvoegsel, :achternaam, :gebruikersnaam, :wachtwoord);";

    // Prepere
    $stmt = $this->conn->prepare($sql);


    // execute
    $stmt->execute([
        'medewerkerscode'=>NULL,
        'voorletters' => 'L',
        'voorvoegsel' => '',
        'achternaam' => 'nanne',
        'gebruikersnaam' => 'lynn',
        'wachtwoord' => password_hash('admin', PASSWORD_DEFAULT)
    ]);
}

// reserveren van pesoon
public function reserveren($naam, $adres, $plaats ,$postcode, $telefoon, $van, $tot, $idkamer){

    try{
        //insert persoon 
        $sql = "INSERT INTO persoon (naam, adres, plaats, postcode, telefoon) VALUES (:naam, :adres, :plaats, :postcode, :telefoon)";

        $stmt = $this->conn->prepare($sql); // checkt syntax van sql string en prepared op server

        // executes prepared statements, passes values to named placeholders from sql string on line 51
        $stmt->execute(
        array(
            'naam' => $naam,
            'adres' => $adres,
            'plaats' => $plaats,
            'postcode' => $postcode,
            'telefoon' => $telefoon
            )
        );
        //laats geinserte id geeft hij mee 
        $last_id = $this->conn->lastInsertId();
        //insert in reservatie
        $sql1 = "INSERT INTO reservering (van, tot, persoon_idpersoon, kamer_idkamer) VALUES (:van, :tot, :persoon_idpersoon, :kamer_idkamer)";
        $stmt1 = $this->conn->prepare($sql1); // checkt syntax van sql string en prepared op server

        // executes prepared statements, passes values to named placeholders from sql string on line 51
        $stmt1->execute(
        array(
            'van' => $van,
            'tot' => $tot,
            'persoon_idpersoon' => $last_id,
            'kamer_idkamer' => $idkamer
            )
        );
         // redirect to login page
        header("location:index.php");
        }catch(PDOException $error){
            echo $error->getMessage();
            exit("An error occured");
        }
    }


// login medewerker
public function loginmedewerker($uname, $psw){
    //sql statment om gegevens optehalen
    $sql = "SELECT medewerkerscode, gebruikersnaam, wachtwoord FROM medewerkers WHERE gebruikersnaam = :gebruikersnaam";

    //prepare
    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        'gebruikersnaam' => $uname
    ]);

    // pakt de resultaten uit de sql maar allen van 1 record
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($result);

    if(is_array($result)){

        if(count($result) > 0){
            // als username en wachtwoord kloppen met wat er in de database staat gaat hij verder
            if ($uname == $result['gebruikersnaam'] && password_verify($psw, $result['wachtwoord'])) {

                session_start();
                $_SESSION['medewerkerscode'] = $result['id'];
                $_SESSION['uname'] = $result['gebruikersnaam'];

                header('location: medewerker.php');

            }
        }else{
            echo 'faild to login.';
        }

    }else{
        echo 'Faild to login. please check you input and try again.';
    }

}

public function select($statment, $named_placeholder){

    $stmt = $this->conn->prepare($statment);
    $stmt->execute($named_placeholder);
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    return $result;
}

public function update_or_delete($statement, $named_placeholder){
        
    $stmt = $this->conn->prepare($statement);
    $stmt->execute($named_placeholder);
    header('location:overzicht_kamer.php');
    header('location:overzicht_persoon.php');
    
    exit();

}
// drop douwn menu voor kamers 
public function kamernummer(){
    // get all kamernummers from data base
    $this->stmt = $this->conn->prepare("SELECT idkamer, kamernummer FROM kamer");

    $result = $this->stmt->execute();
    // if query fails $result returnt error code
    if (!$result) {
        die('<pre>oops, ERROR execute query ' . $result . '</pre><br><pre>'. 'result code' . $result .'</pre>');
    }

    $this->resultSet = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    //stores data for use
    $result = $this->resultSet;
    //returnt resultaat
    return $result;
}


// key constraint werkt niet kan niet meer verwijdern omdat het gelinkt is
// public function reserver(){
//     $sql = "INSERT INTO reservering VALUES (van, tot, persoon_idpersoon) SELECT van, tot, idpersoon FROM persoon";

//         $stmt = $this->conn->prepare($sql); // checkt syntax van sql string en prepared op server

//         // executes prepared statements, passes values to named placeholders from sql string on line 51
//         $stmt->execute([
//         ]);
// }
}