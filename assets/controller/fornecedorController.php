<?php
require_once __DIR__ . '/../model/pdo/DataBase.php';
require_once __DIR__ . '/../model/Fornecedor.php';

class ControladorFornecedor{
    private $bd;
    public function __construct() {
        $this->bd = new Database();
    }
    public function cadastrarFornecedor($nome, $endereco , $telefone, $whatsapp, $email, $ramo_atuacao, $data_criacao){
        $this->bd->insert("fornecedores", (object)[
            "nome" => $nome,
            "endereco" => $endereco,
            "telefone" => $telefone,
            "whatsapp" => $whatsapp,
            "email" => $email,
            "ramo_atuacao" => $ramo_atuacao,
            "data_criacao" => $data_criacao
        ]);
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Fornecedor cadastrado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }
    public function verFornecedor(){
        $todosFornecedores = $this->bd->read("fornecedores");
        $arr = [];
        foreach($todosFornecedores as $fornecedor){
            $novoFornecedor = new Fornecedor($fornecedor['id'], $fornecedor['nome'],$fornecedor['endereco'], $fornecedor['telefone'], $fornecedor['whatsapp'], $fornecedor['email'], $fornecedor['ramo_atuacao'], $fornecedor['data_criacao']);
            $arr[] = $novoFornecedor;
        }
        return $arr;
    }
    public function editarFornecedor($id, $nome, $endereco , $telefone, $whatsapp, $email, $ramo_atuacao){
        $this->bd->update("fornecedores", (object)[
            "nome" => $nome,
            "endereco" => $endereco,
            "telefone" => $telefone,
            "whatsapp" => $whatsapp,
            "email" => $email,
            "ramo_atuacao" => $ramo_atuacao,
        ], $id);
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Fornecedor editado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }
    public function deletarFornecedor($id){
        $this->bd->delete("fornecedores", $id);
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Fornecedor deletado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
              </script>";
    }
    
    public function verFornecedorPorId($id) {
        // Supondo que você tenha um método para obter todos os fornecedores
        $fornecedores = $this->verFornecedor();
        
        foreach ($fornecedores as $fornecedor) {
            if ($fornecedor->getId() == $id) {
                return $fornecedor;
            }
        }
        
        return null; // Retorna null se o fornecedor não for encontrado
    }
}
?>