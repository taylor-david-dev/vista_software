<?php
/*
 * Todos os direitos reservados a Taylor David ®
 * Nome do Desenvolvedor : Taylor David
 * Contato: eu@taylordavid.com.br
 */
//include('library/database.php');

class locador_model extends database{
    private $conn;
    
    function __construct(){
        $this->conn = $this->connect();
    }
    
    public function cadatrar($dados) {
        $sql = "INSERT INTO locador (lcd_nome, lcd_email, lcd_telefone, lcd_dia_repasse) VALUES ('$dados[lcd_nome]', '$dados[lcd_email]', '$dados[lcd_telefone]', $dados[lcd_dia_repasse])";
      
        if(mysqli_query($this->conn, $sql)){
           return true;
        }else{
           return false;
        }
    }
    
    public function listar() {
        $sql = 'select * from locador';
        return mysqli_query($this->conn, $sql);
    }
}
	