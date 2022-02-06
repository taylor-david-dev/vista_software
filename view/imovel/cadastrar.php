<form action="<?= $baseUrl ?>doCadastrarImovel" method="post">
    <fieldset>
        <legend>Cadastro Imovel:</legend>
        <div class="formGroup">
            <span class="label">Locador:</span> 
            <select name="lcd_id" >
                <option value="">Nome locador</option>
                <?php while ($list = $listaLocador->fetch_assoc()) { ?>
                    <option value="<?= $list['lcd_id'] ?>"><?= $list['lcd_nome'] ?></option>
                <?php } ?>
            </select>
        </div> 
        <div class="formGroup">
            <span class="label">Imovel:</span> 
            <select name="imo_cod" id="imovelSelect" >
                <option value="">Cod / Cidade - Bairro</option>
                <?php foreach ($listaImovel as $listImo) { ?>
                    <option value="<?= $listImo['Codigo'] ?>"><?= $listImo['Codigo'] ?> / <?= $listImo['Cidade'] ?> - <?= $listImo['Bairro'] ?> - <?= $listImo['Endereco'] ?></option>
                <?php } ?>
            </select>
        </div> 
        <input type="submit" value="Cadastrar" class="cadastro" /> 
    </fieldset>
</form>
