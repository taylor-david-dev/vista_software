<?php while($list = $listaImovel->fetch_assoc()) { ?>
       <fieldset>
        <legend>Informações do Imovel:</legend>
        <div>
            <div class="formGroup">
                <span class="label">Cod. Imovel:</span> 
                <span class="labelContent"><?= $list['imo_cod'] ?></span>
            </div> 
            <div class="formGroup">
                <span class="label">Nome Locador:</span> 
                <span class="labelContent"><?= $list['lcd_nome'] ?></span>
            </div> 
            <div class="formGroup">
                <span class="label">Cidade:</span> 
                <span class="labelContent"><?= $list['imo_cidade'] ?></span>
            </div> 
            <div class="formGroup">
                <span class="label">Bairro:</span> 
                <span class="labelContent"><?= $list['imo_bairro'] ?></span>
            </div> 
            <div class="formGroup">
                <span class="label">Endereço:</span> 
                <span class="labelContent"><?= $list['imo_endereco'] ?></span>
            </div> 
        </div>
<!--        <a href="javascript:void(0)" onclick="confirmaExclusao('<?= $baseUrl ?>doExcluirImovel/<?= $list['imo_id'] ?>')" class="alterar" /> Excluir </a> -->
    </fieldset>
<?php } ?>

<script>
    function confirmaExclusao(url){
        var resultado = confirm("Desejá excluir o Locatário?");
        if (resultado == true) {
          window.location.href = url;      
        }
    }
    
</script>