<?php

/*
 * Todos os direitos reservados a Taylor David ®
 * Nome do Desenvolvedor : Taylor David
 * Contato: eu@taylordavid.com.br
 */


include('library/database.php');
include('model/locatario_model.php');
include('model/locador_model.php');
include('model/imovel_model.php');
include('library/Mensagem.php');

$locatarioModel = new locatario_model();
$locadorModel = new locador_model();
$imovelModel = new imovel_model();
$mensagem = new Mensagem();

switch ($pagina) {
    case (''):
        $listaContrato = $imovelModel->listarContrato();
        include ('view/imovel/listar_contrato.php');
        break;

    case ('locatario'):
        include ('view/locatario/cadastrar.php');
        break;

    case ('doCadastrarLocatario'):
        if ($locatarioModel->cadatrar($_POST)) {
            $mensagem->setMensagem("Cadastro efetuado com sucesso!");
            $mensagem->setUrl("listarLocatario");
            $mensagem->alerta();
        } else {
            $mensagem->setMensagem("Erro ao efetuar cadastro!\\nPor favor, tente novamente.");
            $mensagem->alerta();
        }
        break;

    case ('listarLocatario'):
        $listaLocatarios = $locatarioModel->listar();
        include ('view/locatario/listar.php');
        break;

    case ('locador'):
        include ('view/locador/cadastrar.php');
        break;

    case ('doCadastrarLocador'):
        if ($locadorModel->cadatrar($_POST)) {
            $mensagem->setMensagem("Cadastro efetuado com sucesso!");
            $mensagem->setUrl("listarLocador");
            $mensagem->alerta();
        } else {
            $mensagem->setMensagem("Erro ao efetuar cadastro!\\nPor favor, tente novamente.");
            $mensagem->alerta();
        }
        break;

    case ('listarLocador'):
        $listaLocador = $locadorModel->listar();
        include ('view/locador/listar.php');
        break;

    case ('cadastrarImovel'):
        $listaImovel = $imovelModel->listarAPI();
        $listaLocador = $locadorModel->listar();
        include ('view/imovel/cadastrar.php');
        break;

    case ('doCadastrarImovel'):
        $dadosImovel = $imovelModel->buscaImovelAPI($_POST['imo_cod']);

        $dados = [
            'lcd_id' => $_POST['lcd_id'],
            'imo_cidade' => $dadosImovel['Bairro'],
            'imo_bairro' => $dadosImovel['Cidade'],
            'imo_endereco' => $dadosImovel['Endereco'],
            'imo_cod' => $_POST['imo_cod']
        ];

        if ($imovelModel->cadatrar($dados)) {
            $mensagem->setMensagem("Cadastro efetuado com sucesso!");
            $mensagem->setUrl("listarImovel");
            $mensagem->alerta();
        } else {
            $mensagem->setMensagem("Erro ao efetuar cadastro!\\nPor favor, tente novamente.");
            $mensagem->alerta();
        }
        break;

    case ('listarImovel'):
        $listaImovel = $imovelModel->listar();
        include ('view/imovel/listar.php');
        break;
    
    case ('contratoImovel'):
        $listaImovel = $imovelModel->listar();
        $listaLocador = $locadorModel->listar();
        $listaLocatario = $locatarioModel->listar();
        include ('view/imovel/contrato.php');
        break;
    
    case ('doContratoImovel'):
        $dados = [
            'loc_id' =>  $_POST['loc_id'],
            'imo_id' =>  $_POST['imo_id'],
            'lcd_id' =>  $_POST['lcd_id'],
            'con_data_inicio' =>  implode("-",array_reverse(explode("/",$_POST['con_data_inicio']))),
            'con_data_fim' =>  implode("-",array_reverse(explode("/",$_POST['con_data_fim']))),
            'con_taxa_adm' => str_replace(",", "", $_POST['con_taxa_adm']),
            'con_aluguel' => str_replace(",", "",$_POST['con_aluguel']),
            'con_condominio' => str_replace(",", "",$_POST['con_condominio']),
            'con_iptu' => str_replace(",", "",$_POST['con_iptu'])
        ];
        
        $response = $imovelModel->cadastrarContrato($dados);
        
        if ($response['status']) {
            
            $imovelModel->gerarMensalidades($dados, $response['last_id']);

            $mensagem->setMensagem("Cadastro efetuado com sucesso!");
            $mensagem->setUrl("listarContratoImovel");
            $mensagem->alerta();
        } else {
            $mensagem->setMensagem("Erro ao efetuar cadastro!\\nPor favor, tente novamente.");
            $mensagem->alerta();
        }
        
        break;
        
    case ('listarContratoImovel'):
        $listaContrato = $imovelModel->listarContrato();
        include ('view/imovel/listar_contrato.php');
        break;
    
    case ('visualizarMenRep'):
        $listaMenRep = $imovelModel->listarMenRep($id);
        include ('view/imovel/lista_men_rep.php');
        break;
    
    case ('atualizaStatusMensalidade'):
        if ($imovelModel->atualizaStatusMensalidade($_POST)) {
            $mensagem->setMensagem("Atualização realizada com sucesso!");
            $mensagem->setUrl("visualizarMenRep/".$_POST['con_id']);
            $mensagem->alerta();
        } else {
            $mensagem->setMensagem("Erro ao atualizar!\\nPor favor, tente novamente.");
            $mensagem->alerta();
        }
    break;
    
    case ('atualizaStatusRepasse'):
        if ($imovelModel->atualizaStatusRepasse($_POST)) {
            $mensagem->setMensagem("Atualização realizada com sucesso!");
            $mensagem->setUrl("visualizarMenRep/".$_POST['con_id']);
            $mensagem->alerta();
        } else {
            $mensagem->setMensagem("Erro ao atualizar!\\nPor favor, tente novamente.");
            $mensagem->alerta();
        }
    break;
    default:
        include ('view/404.php');
        break;
}