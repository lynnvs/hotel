<?php

require_once __DIR__ . '/vendor/autoloas.php';

$naam = $_POST['naam'];
$adres = $_POST['adres'];
$plaats = $_POST['plaats'];
$postcode = $_POST['postcode'];
$telefoon = $_POST['telefoon'];
$van = $_POST['van'];
$tot = $_POST['tot'];
$kamernummer = $_POST['kamernummer'];

//create PDF
$mpdf = new \Mpdf\Mpdf();

$data = '';
$data .= '<h1>Reservatie overzicht</h1>';

$data .= '<strong>Naam</strong>' . $naam . '<br>';
$data .= '<strong>adres</strong>' . $adres . '<br>';
$data .= '<strong>plaats</strong>' . $plaats . '<br>';
$data .= '<strong>postcode</strong>' . $postcode . '<br>';
$data .= '<strong>telefoon</strong>' . $telefoon . '<br>';
$data .= '<strong>van</strong>' . $van . '<br>';
$data .= '<strong>tot</strong>' . $tot . '<br>';
$data .= '<strong>kamernummer</strong>' . $idkamer . '<br>';

if($message){
    $data .= '<br /><strong>Message</strong><br />' . $message;
}

$mpdf->WriteHTML($data);

$mpdf->Output('reservatie_overzicht.pdf', 'D');

?>