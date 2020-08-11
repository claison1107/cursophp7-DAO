<?php

require_once('config.php');

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM td_usuarios");

echo json_encode($usuarios);