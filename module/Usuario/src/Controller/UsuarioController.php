<?php

declare(strict_types=1);

namespace Usuario\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Usuario\Model\UsuarioTable;
use Usuario\Form\UsuarioForm;
use Usuario\Model\Usuario;

class UsuarioController extends AbstractActionController
{
    
    private $tabela;
    
    public function __construct(UsuarioTable $tabela) {
        $this->tabela = $tabela;
    }
    
    public function indexAction()
    {
        return new ViewModel(['usuarios' => $this->tabela->getAll()]);
    }
    
    public function filtarAction()
    {
        
    }
    
    public function cadastrarAction()
    {
        
        $form = new UsuarioForm();
        $request = $this->getRequest();
        
        if(!$request->isPost()){
            return new ViewModel(['form' => $form]);
        }
        
        $usuario = new Usuario;
        $form->setData($request->getPost());
        
        if(!$form->isValid()){
            return new ViewModel(['form' => $form]);    
        }
        
        $usuario->exchangeArray($form->getData());
        $usuario->setSenha(base64_encode($usuario->getSenha()));
        $this->tabela->saveUsuario($usuario);
        return $this->redirect()->toRoute('usuario');
        
    }
    
    public function editarAction()
    {
        
        $id = (int)$this->params()->fromRoute('id', 0);
        
        if($id === 0){
            $this->redirect()->toRoute('usuario', ['action', 'cadastrar']);
        }
        
        try{
            $usuario = $this->tabela->getUsuario($id);
        } catch (Exception $exec){
            $this->redirect()->toRoute('usuario', ['action', 'index']);
        }
        
        $form = new UsuarioForm();
        
        $usuario->setSenha(base64_decode($usuario->getSenha()));
        
        $form->bind($usuario);

        $request = $this->getRequest();
        
        $viewData = ['id'=>$id, 'form'=>$form];
        
        if(!$request->isPost()){
            return $viewData;
        }
        
        $form->setData($request->getPost());
        
        if(!$form->isValid()){
            return new ViewModel(['form' => $form]);    
        }
        
        $form->getData()->setSenha(base64_encode($form->getData()->getSenha()));
        
        $this->tabela->saveUsuario($form->getData());
        
        return $this->redirect()->toRoute('usuario');
          
    }
    
    public function deletarAction()
    {

        $id = (int)$this->params()->fromRoute('id', 0);

        if($id === 0){
            return $this->redirect()->toRoute('usuario');
        }
        
        $usuario = $this->tabela->getUsuario($id);
        
        $request = $this->getRequest();
        
        if($request->isPost()){
            $del = $request->getPost('del', 'Não');
            if($del == 'Sim'){
                $id = (int) $request->getPost('id');
                $this->tabela->deleteUsuario($id);
            }
            return $this->redirect()->toRoute('usuario');
        }
        
        return ['id'=>$id, 'usuario'=>$usuario];
        
    }

}
