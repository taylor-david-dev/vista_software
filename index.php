<!DOCTYPE html>
<?php
/*
 * Todos os direitos reservados a Taylor David ®
 * Nome do Desenvolvedor : Taylor David
 * Contato: eu@taylordavid.com.br
 */
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$baseUrl = 'https://taylordavid.com.br/vista/';

if (!empty($_GET) && !empty($_GET['url'])) {
    $ex = explode('/', $_GET['url']);
    if (!empty($ex[0])) {
        $pagina = $ex[0];
    }
    if (!empty($ex[1])) {
        $id = $ex[1];
    }
} else {
    $pagina = '';
}
?>
<head>
    <meta charset="utf-8" />

    <title>.: Projeto Vista Software :.</title>

    <link rel="stylesheet" type="text/css" href="<?= $baseUrl ?>css/main.css" />

</head>

<body>

    <nav>
        <ul class="menu">
            <li class="firstLi"><a href="<?= $baseUrl ?>">Home</a></li>
            <li><a href="javascript.void(0)">Locatário</a>
                <ul>
                    <li><a href="<?= $baseUrl ?>listarLocatario">Listar</a></li>
                    <li><a href="<?= $baseUrl ?>locatario">Cadastrar</a></li>
                </ul>
            </li>
            <li><a href="javascript.void(0)">Locador</a>
                <ul>
                    <li><a href="<?= $baseUrl ?>listarLocador">Listar</a></li>
                    <li><a href="<?= $baseUrl ?>locador">Cadastrar</a></li>
                </ul>
            </li>
            <li><a href="javascript.void(0)">Imovel</a>
                <ul>
                    <li><a href="<?= $baseUrl ?>cadastrarImovel">Cadastrar</a></li>
                    <li><a href="<?= $baseUrl ?>listarImovel">Listar</a></li>
                    <li><a href="<?= $baseUrl ?>contratoImovel">Cadastrar Contrato</a></li>
                    <li><a href="<?= $baseUrl ?>listarContratoImovel">Listar Contrato</a></li>
                </ul>
            </li>
        </ul>
    </nav> 
    <div class="content">
        <?php
        include("controller/site.php");
        ?>
    </div>

    <footer>
        Todos os direitos reservados a Taylor David @ eu@taylordavid.com.br
    </footer>

    <script src="<?= $baseUrl ?>js/jquery.min.js"></script>
    <script src="<?= $baseUrl ?>js/jquery.mask_1.js"></script>
    <script src="<?= $baseUrl ?>js/main.js"></script>
</body>
</html>
