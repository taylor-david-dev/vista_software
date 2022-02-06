<?php while($list = $listaLocador->fetch_assoc()) { ?>
       <fieldset>
        <legend>Informações do Locador:</legend>
        <div>
            <div class="formGroup">
                <span class="label">Nome:</span> 
                <span class="labelContent"><?= $list['lcd_nome'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Email:</span> 
                <span class="labelContent"><?= $list['lcd_email'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Telefone:</span> 
                <span class="labelContent"><?= $list['lcd_telefone'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Dia Repasse:</span> 
                <span class="labelContent"><?= $list['lcd_dia_repasse'] ?></span>
            </div>  
        </div>
        <a href="<?= $baseUrl ?>alterarLocador/<?= $list['lcd_id'] ?>" class="alterar" /> Alterar </a> 
    </fieldset>
<?php } ?>