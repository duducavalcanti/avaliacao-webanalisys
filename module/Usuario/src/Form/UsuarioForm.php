<?php
namespace Usuario\Form;

use Laminas\Form\Form;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Button;

use Usuario\Model\Usuario;


class UsuarioForm extends Form{
    public function __construct() {
        parent::__construct('usuario', []);
        
        $id = new Hidden('id');
        $id->setAttribute('class', 'form-control')->setAttribute('id', 'id')->setAttribute('name', 'id');
        $this->add($id);
        
        $nome = new Text('nome');
        $nome->setAttribute('class', 'form-control')->setAttribute('id', 'nome')->setAttribute('name', 'nome');
        $this->add($nome);
        
        $email = new Text('email');
        $email->setAttribute('class', 'form-control')->setAttribute('id', 'email')->setAttribute('name', 'email');
        $this->add($email);
        
        $senha = new Text('senha');
        $senha->setAttribute('class', 'form-control')->setAttribute('id', 'senha')->setAttribute('name', 'senha');
        $this->add($senha);
        
//        $submit = new Submit('cadastrar');
//        $submit->setValue('Cadastrar')
//            ->setAttribute('class', 'btn btn-success')
//            ->setAttribute('id', 'cadastrar');
//        $this->add($submit);
        
    }
}
