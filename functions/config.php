<?php
$db = new PDO('mysql:host=localhost;dbname=wprg-project', 'root', '');
$mysql = new mysqli("localhost", "root", '', "wprg-project");
$db->query('SET NAMES utf8mb4');
