<?php
try{
    $db = new PDO('mysql:host=localhost;dbname=wprg-project', 'root', '');
}
catch (PDOException $e){
    die ("Nie udało połączyć się z bazą danych");
}