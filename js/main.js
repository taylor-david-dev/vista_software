$(document).ready(function() {
    
    $('.cadastro').click(function() {
        var erro = '';

        var nome = $('#nome').val();
        var sobrenome = $('#sobrenome').val();
        var telefone = $('#telefone').val();

        if (nome == "") {
            erro += 'Favor preencher campo NOME. \n';
        }
        if (sobrenome == "") {
            erro += 'Favor preencher campo SOBRENOME. \n';
        }
        if (telefone == "") {
            erro += 'Favor preencher campo TELEFONE. \n';
        }

        if (erro != "") {
            alert(erro);
        } else {
            $('#form-pessoa').submit();
        }
    });
    $('.msg').click(function() {
        $(this).slideUp();
    });
    
    $('.custom4').maskMoney();
});