<?php 


$html = "";  

// Get the XML Feed
$data = "http://localhost:3000/data";


// load the xml into the object
$xml = simplexml_load_file($data);

$msg_id;
$timestamp;
$temprature=0.0;
$humidity=0.0;
$pressure=0.0;
$light_intensity=0.0;
$temprature_sd=0.0;
$humidity_sd=0.0;
$pressure_sd=0.0;
$light_intensity_sd=0.0;

function InsertDataToDatabase(
    $msg_id,
    $timestamp,
    $temprature,
    $humidity,
    $pressure,
    $light_intensity,
    $temprature_sd,
    $humidity_sd,
    $pressure_sd,
    $light_intensity_sd
){
    $servername = "localhost";
    $username = "thushani";
    $password = "password";
    $dbname= "EnviromentData";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    $sql = "INSERT INTO Readings (msg_id, timestamp_n, temprature, temprature_sd, humidity, humidity_sd, presssure, pressure_sd, light, light_sd)
    VALUES ($msg_id, $timestamp, $temprature,$temprature_sd,$humidity,$humidity_sd, $pressure,$pressure_sd,$light_intensity,$light_intensity_sd)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function readXMLdata($xml){

    foreach($xml->children() as $parameter) {
        echo $parameter->valueName . ", ";
        echo $parameter->value . ", ";
       
      }

     global $msg_id,
    $timestamp,
    $temprature,
    $humidity,
    $pressure,
    $light_intensity,
    $temprature_sd,
    $humidity_sd,
    $pressure_sd,
    $light_intensity_sd;
    
        $msg_id=$xml['identifier'];
        $timestamp=$xml['datetime'];

        $temprature = $xml['data']['temperature'];
        $humidity = $xml['data']['humidity'];
        $pressure = $xml['data']['pressure'];
        $light_intensity = $xml['data']['lightIntensity'];
        $temprature_sd = $xml['data']['temperature_sd'];
        $humidity_sd = $xml['data']['humidity_sd'];
        $pressure_sd = $xml['data']['pressure_sd'];
        $light_intensity_sd = $xml['data']['lightIntensity_sd'];


}


echo $html;
?>