<form action="<?= $baseUrl?>doContratoImovel" method="post" name="form-lcdatario">
    <fieldset>
        <legend>Cadastro de Contrato:</legend>
        <div class="formGroup">
            <span class="label">Locatário:</span> 
            <select name="loc_id" >
            <option value="">Nome Locatário</option>
            <?php while($listLoc = $listaLocatario->fetch_assoc()) { ?>
                <option value="<?= $listLoc['loc_id'] ?>"><?= $listLoc['loc_nome'] ?></option>
            <?php } ?>
        </select>
        </div> 
        <div class="formGroup">
            <span class="label">Locador:</span> 
            <select name="lcd_id" >
                <option value="">Nome Locador</option>
                <?php while ($list = $listaLocador->fetch_assoc()) { ?>
                    <option value="<?= $list['lcd_id'] ?>"><?= $list['lcd_nome'] ?></option>
                <?php } ?>
            </select>
        </div> 
        <div class="formGroup">
            <span class="label">Imovel:</span> 
            <select name="imo_id" id="imovelSelect" >
            <option value="">Cod / Cidade - Bairro</option>
            <?php foreach($listaImovel as $listImo) { ?>
                <option value="<?= $listImo['imo_id'] ?>"><?= $listImo['imo_cod'] ?> / <?= $listImo['imo_cidade'] ?> - <?= $listImo['imo_bairro'] ?> - <?= $listImo['imo_endereco'] ?></option>
            <?php } ?>
        </select>
        </div> 
        <div class="formGroup">
            <span class="label">Data Inicio:</span> 
            <input type="date" name="con_data_inicio" value="<?= date('d/m/Y') ?>" />
        </div>
        <div class="formGroup">
            <span class="label">Data Fim:</span> 
            <input type="date" name="con_data_fim" value="" />
        </div>
        <div class="formGroup">
            <span class="label">Taxa Administrativa:</span> 
            <input type="text" name="con_taxa_adm" value="" class="custom4" />
        </div> 
        <div class="formGroup">
            <span class="label">Valor Aluguel:</span> 
            <input type="text" name="con_aluguel" value="" class="custom4" />
        </div> 
        <div class="formGroup">
            <span class="label">Valor Condominio:</span> 
            <input type="text" name="con_condominio" value="" class="custom4" />
        </div> 
        <div class="formGroup">
            <span class="label">Valor IPTU:</span> 
            <input type="text" name="con_iptu" value="" class="custom4" />
        </div> 
        <input type="submit" value="Cadastrar" class="cadastro" /> 
        
    </fieldset>
</form>
