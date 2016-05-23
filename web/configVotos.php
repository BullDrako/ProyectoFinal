<?php
/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 20/05/16
 * Time: 19:51
 */

$db_username = 'root';
$db_password = '651995';
$db_name = 'symfony-proyecto';
$db_host = 'localhost';

$db = new mysqli($db_host, $db_username, $db_password,$db_name) or die('No puedo conectarme a la base de datos');