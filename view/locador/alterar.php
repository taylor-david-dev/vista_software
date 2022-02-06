<?php $lista = mysql_fetch_assoc($resultado); ?>

<form action="/doAlterar/<?php echo $lista[id] ?>" method="post" name="form-pessoa" id="form-pessoa">
    <fieldset>
        <legend>Alterando informações da Pessoa:</legend>
        <label>Nome:</label> <input type="text" name="nome" value="<?php echo $lista[nome] ?>" id="nome" /><br>
        <label>Sobrenome:</label> <input type="text" name="sobrenome" value="<?php echo $lista[sobrenome] ?>" id="sobrenome" /><br>
        <label>Telefone:</label> <input type="text" name="telefone" value="<?php echo $lista[telefone] ?>" id="telefone" /><br>
        <input type="button" value="Alterar" class="cadastro" /> 
    </fieldset>
</form>