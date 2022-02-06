<?php
/*
 * Todos os direitos reservados a Taylor David ®
 * Nome do Desenvolvedor : Taylor David
 * Contato: eu@taylordavid.com.br
 */

//include('library/database.php');

class locatario_model extends database{
    private $conn;
    
    function __construct(){
        $this->conn = $this->connect();
    }
    
    public function cadatrar($dados) {
        $sql = "INSERT INTO locatario (loc_nome, loc_email, loc_telefone) VALUES ('$dados[loc_nome]', '$dados[loc_email]', '$dados[loc_telefone]')";
      
        if(mysqli_query($this->conn, $sql)){
           return true;
        }else{
           return false;
        }
    }
    
    public function listar() {
        $sql = 'select * from locatario';
        return mysqli_query($this->conn, $sql);
    }
    
}
	