<?php while($list = $listaLocatarios->fetch_assoc()) { ?>
       <fieldset>
        <legend>Informações do Locatário:</legend>
        <div>
            <div class="formGroup">
                <span class="label">Nome:</span> 
                <span class="labelContent"><?= $list['loc_nome'] ?></span>
            </div>    
            <div class="formGroup">
                <span class="label">Email:</span> 
                <span class="labelContent"><?= $list['loc_email'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Telefone:</span> 
                <span class="labelContent"><?= $list['loc_telefone'] ?></span>
            </div>  
        </div>
        <a href="<?= $baseUrl ?>alterarLocatario/<?= $list['loc_id'] ?>" class="alterar" /> Alterar </a> 
    </fieldset>
<?php } ?>