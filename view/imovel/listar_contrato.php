<?php while($list = $listaContrato->fetch_assoc()) { ?>
       <fieldset>
        <legend>Informações do contrato:</legend>
        <div>
            <div class="formGroup">
                <span class="label">Cod. Contrato:</span> 
                <span class="labelContent"><?= $list['con_id'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Cod. Imovel:</span> 
                <span class="labelContent"><?= $list['imo_cod'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Nome Locatário:</span> 
                <span class="labelContent"><?= $list['loc_nome'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Nome Locador:</span> 
                <span class="labelContent"><?= $list['lcd_nome'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Data Inicio:</span> 
                <span class="labelContent"><?= implode("/", array_reverse(explode("-", $list['con_data_inicio']))) ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Data Fim:</span> 
                <span class="labelContent"><?= implode("/", array_reverse(explode("-", $list['con_data_fim']))) ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Taxa Administrativa:</span> 
                <span class="labelContent">R$ <?= $list['con_taxa_adm'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Valor Aluguel:</span> 
                <span class="labelContent">R$ <?= $list['con_aluguel'] ?></span>
            </div>  
            <div class="formGroup">
                <span class="label">Valor Condominio:</span> 
                <span class="labelContent">R$ <?= $list['con_condominio'] ?></span>
            </div> 
            <div class="formGroup">
                <span class="label">Valor Iptu:</span> 
                <span class="labelContent">R$ <?= $list['con_iptu'] ?></span>
            </div> 
        </div>
        <a href="<?= $baseUrl ?>visualizarMenRep/<?= $list['con_id'] ?>" class="alterar" /> Visualizar</a> 
    </fieldset>
<?php } ?>