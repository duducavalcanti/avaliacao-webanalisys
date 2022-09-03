<?php

namespace Usuario\Model;

class Usuario {

    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    
    function __construct($id_usuario = null, $nome = null,  $email = null, $senha = null) {
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function exchangeArray(array $data) {
        $this->id_usuario((empty($data['id_usuario'])) ? $data['id_usuario'] : null);
        $this->nome((empty($data['nome'])) ? $data['nome'] : null);
        $this->email((empty($data['email'])) ? $data['email'] : null);
        $this->senha((empty($data['senha'])) ? $data['senha'] : null);
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail(){
    	return $this->email;
    }
    
    public function setEmail($email){
    	$this->email = $email;
    }

    public function getSenha() {
        return base64_decode($this->senha);
    }

    public function setSenha($senha) {
        $this->senha = base64_encode($senha);
    }
}