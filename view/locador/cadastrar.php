<form action="<?= $baseUrl?>doCadastrarLocador" method="post" name="form-lcdatario">
    <fieldset>
        <legend>Cadastro Locador:</legend>
        <div class="formGroup">
            <span class="label">Nome:</span> 
            <input type="text" name="lcd_nome" value="" id="nome" />
        </div>  
        <div class="formGroup">
            <span class="label">Email:</span> 
            <input type="text" name="lcd_email" value="" id="email" />
        </div>  
        <div class="formGroup">
            <span class="label">Telefone:</span> 
            <input type="text" name="lcd_telefone" value="" id="telefone" />
        </div>          
        <div class="formGroup">
            <span class="label">Dia Repasse:</span> 
            <input type="text" name="lcd_dia_repasse" value="" id="telefone" />
        </div>          
        <input type="submit" value="Cadastrar" class="cadastro" /> 
    </fieldset>
</form>