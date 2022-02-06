<form action="<?= $baseUrl ?>doCadastrarLocatario" method="post" name="form-locatario">
    <fieldset>
        <legend>Cadastro Locatário:</legend>
        <div class="formGroup">
            <span class="label">Nome:</span> 
            <input type="text" name="loc_nome" value="" id="nome" />
        </div>  
        <div class="formGroup">
            <span class="label">Email:</span> 
            <input type="text" name="loc_email" value="" id="email" />
        </div>  
        <div class="formGroup">
            <span class="label">Telefone:</span> 
            <input type="text" name="loc_telefone" value="" id="telefone" />
        </div>  
        <input type="submit" value="Cadastrar" class="cadastro" /> 
    </fieldset>
</form>