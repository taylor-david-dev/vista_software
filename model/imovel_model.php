<?php
/*
 * Todos os direitos reservados a Taylor David ®
 * Nome do Desenvolvedor : Taylor David
 * Contato: eu@taylordavid.com.br
 */
//include('library/database.php');

class imovel_model extends database{
    private $conn;
    
    function __construct(){
        $this->conn = $this->connect();
    }
    
    public function cadatrar($dados) {
        $sql = "INSERT INTO imovel (lcd_id, imo_cidade, imo_bairro, imo_endereco, imo_cod) VALUES ($dados[lcd_id],'$dados[imo_cidade]', '$dados[imo_bairro]', '$dados[imo_endereco]', $dados[imo_cod])";
      
        if(mysqli_query($this->conn, $sql)){
           return true;
        }else{
           return false;
        }
    }
    
    public function listar() {
        $sql = 'select imo_id,imo_cidade,imo_bairro,imo_endereco,imo_cod,lcd_nome from imovel as imo inner join locador as lcd on lcd.lcd_id = imo.lcd_id';
        return mysqli_query($this->conn, $sql);
    }
    
    public function listarAPI() {
        $dados = array(
            'fields' => array( 'Cidade', 'Bairro', 'Endereco', 'ValorVenda' )
        );

        $key         =  'c9fdd79584fb8d369a6a579af1a8f681'; //Informe sua chave aqui
        $postFields  =  json_encode( $dados );
        $url         =  'http://sandbox-rest.vistahost.com.br/imoveis/listar?key=' . $key;
        $url        .=  '&pesquisa=' . $postFields;

        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER , array( 'Accept: application/json' ) );
        $result = curl_exec( $ch );

        return json_decode( $result, true );
    }
    
    public function buscaImovelAPI($imo_cod) {
        $dados = array(
            'fields' => array("Codigo","Endereco","Categoria","Bairro","Cidade","ValorVenda","ValorLocacao","Dormitorios","Suites","Vagas","AreaTotal","AreaPrivativa","Caracteristicas","InfraEstrutura")
        );

        $key         =  'c9fdd79584fb8d369a6a579af1a8f681'; //Informe sua chave aqui
        $postFields  =  json_encode( $dados );
        
        $url         =  'http://sandbox-rest.vistahost.com.br/imoveis/detalhes?key=' . $key . '&imovel='.$imo_cod;
        $url        .=  '&pesquisa=' . $postFields;

        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER , array( 'Accept: application/json' ) );
        $result = curl_exec( $ch );

        return json_decode( $result, true );
    }
    
     public function cadastrarContrato($dados) {
        $sql = "INSERT INTO contrato (loc_id, lcd_id, imo_id, con_data_inicio, con_data_fim, con_taxa_adm, con_aluguel, con_condominio, con_iptu) VALUES ($dados[loc_id],$dados[lcd_id],'$dados[imo_id]', '$dados[con_data_inicio]', '$dados[con_data_fim]', $dados[con_taxa_adm], $dados[con_aluguel], $dados[con_condominio], $dados[con_iptu])";
        //echo $sql;exit;
        if(mysqli_query($this->conn, $sql)){
           return ['status' => true, 'last_id' => $this->conn->insert_id];
        }else{
           return ['status' => false];
        }
    }
    
    public function gerarMensalidades($dados, $last_id){
        
        $valorMensalidade = $dados['con_taxa_adm'] + $dados['con_aluguel'] + $dados['con_condominio'] + ($dados['con_iptu'] / 12);
        
        $dataMensalidade = $dados['con_data_inicio'];
        $dataFim = $dados['con_data_fim'];
        
        //pega dia repasse do locador
        $sqlLcd = 'select lcd_dia_repasse from locador ';
        $responseLcd =  mysqli_query($this->conn, $sqlLcd);
        $responseLcd = $responseLcd->fetch_assoc();
        
        //pega diferença de meses entre o periodo de data informado
        $dif = strtotime($dataFim) - strtotime($dataMensalidade);
        $diffMeses = floor($dif / (60 * 60 * 24 * 30));
        
        //pega dia atual e mes atual da datainicial informada
        $diaAtual = explode("-", $dataMensalidade)[2] ;
        $mesAtual = explode("-", $dataMensalidade)[1] ;
        //seta em @diffDias a diferença de dias entra a data informada e o ultimo dia do mês atual pra calcular o primeiro aluguel proporcional
        $ultimoDia = date("t", mktime(0,0,0, $mesAtual,'01', date('Y')));
        $diffDias = $ultimoDia - $diaAtual;
        
        //calcula valor da primeira mensalidade de acordo com a diferenca de dias
        $valorPrimeiraMensalidade = ($valorMensalidade / $ultimoDia) * $diffDias;
        
        //montando a data da primeira mensalidade para dia 01 do proximo mês
        $datePrimeiraMensalidade = new DateTime($dataMensalidade);
        $datePrimeiraMensalidade = $datePrimeiraMensalidade->modify('+1 month');
        $datePrimeiraMensalidade = $datePrimeiraMensalidade->format('Y-m-d');
        $datePrimeiraMensalidade = explode("-", $datePrimeiraMensalidade);
        
        //monta primeira data repasse
        $datePrimeiroRepasse = $datePrimeiraMensalidade[0].'-'.$datePrimeiraMensalidade[1].'-'.$responseLcd['lcd_dia_repasse'];
        
        //monta data primeira mensalidade
        $datePrimeiraMensalidade = $datePrimeiraMensalidade[0].'-'.$datePrimeiraMensalidade[1].'-01';
        
        //verifica se a diferença de mêses é maior que 12 caso sim, trava gerando somente 12 mensalidades como citado na regra. 
        if($diffMeses > 12){
            $diffMeses = 12;
        }
        
        for($i = 0; $i <= $diffMeses; $i++){
            if($datePrimeiraMensalidade < $dataFim){
            if($i == 0){
                $valor = $valorPrimeiraMensalidade;
            }else{
                $valor = $valorMensalidade;
            }
            $sql = "INSERT INTO mensalidade (con_id, men_data, men_status, men_valor) VALUES ($last_id, '$datePrimeiraMensalidade', 0, $valor)";
            if(mysqli_query($this->conn, $sql)){
                $lastMen_id = $this->conn->insert_id;
                
                //monta data das proximas mensalidades de acordo com a quantidade de messes a ser gerado
                $date = new DateTime($datePrimeiraMensalidade);
                $datePrimeiraMensalidade = $date->modify('+1 month');
                $datePrimeiraMensalidade = $date->format('Y-m-d');
            }
            $valorRep = ($valor + ($dados['con_iptu'] / 12)) - $dados['con_taxa_adm'];
            //registro repasse
            $sqlRep = "INSERT INTO repasse (men_id, rep_data, rep_status, rep_valor) VALUES ($lastMen_id, '$datePrimeiroRepasse', 0, $valorRep)";
            mysqli_query($this->conn, $sqlRep);
            
            //monta data dos proximos repasse de acordo com a quantidade de messes a ser gerado
            $datePrimeiroRepasse = new DateTime($datePrimeiroRepasse);
            $datePrimeiroRepasse = $datePrimeiroRepasse->modify('+1 month');
            $datePrimeiroRepasse = $datePrimeiroRepasse->format('Y-m-d');
            }
        }
    }
    
    public function listarContrato(){
        $sql = 'select * from contrato as con '
                . ' inner join imovel as imo on imo.imo_id = con.imo_id'
                . ' inner join locatario as loc on loc.loc_id = con.loc_id'
                . ' inner join locador as lcd on lcd.lcd_id = con.lcd_id';
        return mysqli_query($this->conn, $sql);
    }
    
    public function listarMenRep($con_id){
        $sql = 'select * from mensalidade as men '
                . ' inner join repasse as rep on men.men_id = rep.men_id'
                . ' where men.con_id = '.$con_id;
        
        return mysqli_query($this->conn, $sql)->fetch_all(MYSQLI_ASSOC);
    }
    
    public function atualizaStatusMensalidade($dados){
        $sql = 'UPDATE mensalidade SET men_status = 1 WHERE men_id = '.$dados['men_id'];
        return mysqli_query($this->conn, $sql);
    }
    
    public function atualizaStatusRepasse($dados){
        $sql = 'UPDATE repasse SET rep_status = 1 WHERE rep_id = '.$dados['rep_id'];
        return mysqli_query($this->conn, $sql);
    }
}
	