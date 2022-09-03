<?php
namespace Usuario\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class UsuarioTable {
    
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway){
        $this->tableGateway = $tableGateway;
    }
    
    public function getAll(){
        return $this->tableGateway->select();
    }
    
    public function getUsuario($id){
        $id = (int) $id;
        $rowSet = $this->tableGateway->select(['id_usuario' => $id]);
        $row = $rowSet->current();
        if(!row){
            throw new RuntimeException(sprintf('Não foi encontrado nenhum registro com o ID: %d', $id));
        }
        return $row;
    }
    
    public function saveUsuario(Usuario $usuario){
        $data = [
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
        ];
        
        $id = (int) $usuario->getId_usuario();
        
        if($id === 0){
            $this->tableGateway->insert($data);
            return;
        }
        
        $this->tableGateway->update($data, ['id_usuario' => $id]);
    }
    
     public function deleteUsuario($id){
         $this->tableGateway->delete(['id_usuario' => (int) $id]);
     }
    
}
