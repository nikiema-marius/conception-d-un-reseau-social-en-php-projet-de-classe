<?php
$pdo = new PDO("mysql:host=localhost;dbname=faso_chat", "root","");

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // ELLE permet de capturer les erreures 
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ,);

