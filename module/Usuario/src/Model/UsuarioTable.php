<?php
namespace Usuario\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;
use Laminas\Db\Sql\Where;
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
        $rowSet = $this->tableGateway->select(['id' => $id]);
        $row = $rowSet->current();
        if(!$row){
            throw new RuntimeException(sprintf('Não foi encontrado nenhum registro com o ID: %d', $id));
        }
        return $row;
    }

    public function getUsuarioFiltro($nome){
        $where = new Where();
        $rowset = $this->tableGateway->select($where->like('nome', '%'.$nome.'%'));
        if(!$rowset){
            throw new RuntimeException(sprintf('Não foi encontrado nenhum registro com o nome: %d', $nome));
        }
        return $rowset;
    }
    
    public function saveUsuario(Usuario $usuario){
        $data = [
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
        ];
        
        $id = (int) $usuario->getId();
        
        if($id === 0){
            $this->tableGateway->insert($data);
            return;
        }
        
        try {
            $this->getUsuario($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Não é possível atualizar o usuário com o ID %d;, pois ele não existe no banco', $id));
        }
        
        $this->tableGateway->update($data, ['id' => $id]);
    }
    
    public function deleteUsuario($id){
        $this->tableGateway->delete(['id' => (int) $id]);
    }
    
}
