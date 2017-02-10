<?php
    session_start();

    $username = $_SESSION['at_username'];
    $password = $_SESSION['at_password'];
    $dealer_id = $_SESSION['at_dealer_id'];


    $text = $_POST['text'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $occasion_id = $_POST['occasion_id'];
    $redirect_back = $_POST['redirect_back'];


    $mail = ["bericht" => $text,'proefrit' => true,'gewensteProefritdatum' => '0000-00-00','emailadres' => $email,'telefoonnummer' => $phone];


    $ch = curl_init("https://www.autotrack.nl/api/advertenties/".$_POST['occasion_id']."/contactverzoek");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    "bericht=".$text."&proefrit=true&gewensteProefritdatum=0000-00-00&emailadres=".$email."&telefoonnummer=".$phone."");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "" . $username . ":" . $password . "");
    $server_output = curl_exec($ch);
    curl_close ($ch);

    header('Location: '.$redirect_back);
    $_SESSION["thx_text"] = "true";

?>