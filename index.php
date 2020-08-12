<?php

require_once('config.php');

// $sql = new Sql();

// $usuarios = $sql->select("SELECT * FROM td_usuarios");

// echo json_encode($usuarios);

//carrega um usuario
//$root = new Usuario();
//$root->loadById(3);
//echo $root;

//carrega uma lista de usuarios
// $lista = Usuario::getList();
// echo json_encode($lista);

//carrega uma lista de usuario buscando pelo login
// $search = Usuario::search("cl");
// echo json_encode($search);

//carrega um usuario usando login e senha
// $usuario = new Usuario();
// $usuario->login("user","123456");
// echo $usuario;

//criando um novo usuario
// $aluno = new Usuario("aluno", "luno");
// $aluno->insert();
// echo $aluno;

$usuario = new Usuario();

$usuario->loadById(8);

$usuario->update("professor", "646521389");

echo $usuario;