<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($deslogin){
        $this->deslogin = $deslogin;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($dessenha){
        $this->dessenha = $dessenha;
    }

    public function getDtCadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($dtCadastro){
        $this->dtcadastro = $dtCadastro;
    }

    public function loadById($id){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM td_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($result) > 0){

            $this->setData($result[0]);

        }
    }

    public static function getList(){
        
        $sql = new Sql();

       return $sql->select("SELECT * FROM td_usuarios ORDER BY deslogin;");
    }

    public static function search($login){
        
        $sql = new Sql();

        return $sql->select("SELECT * FROM td_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%" . $login . "%"
        ));
    }

    public function login($login, $password){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM td_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($result) > 0){

            $this->setData($result[0]);

        }else {

            throw new Exception("Login ou senha invalidos");
            

        }
    }

    public function insert(){
        $sql = new Sql();

        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":SENHA"=>$this->getDessenha()
        ));

        if(count($result) > 0){

            $this->setData($result[0]);

        }
    }

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);
        
        $sql = new Sql();

        $sql->query("UPDATE td_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));

    }

    public function __construct($login="", $password=""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtCadastro"=>$this->getDtCadastro()->format("d/m/y H:i:s")
        ));
    }
}