<?php
$hostname="mysql-floriaaan.alwaysdata.net";
$username="floriaaan_prphp";
$password=file_get_contents('../db_pw.txt');
$dbname="floriaaan_prphp";

try
{
    $bdd = new PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8', $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
