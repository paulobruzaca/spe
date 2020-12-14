<h4>Registrar Ponto</h4>
<form action="<?= base_url(); ?>ponto/registrar" method="post">
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" maxlength="11">
    <input type="submit" value="Registrar Ponto">
</form>
<div id="acesso">
    <a href="<?= base_url(); ?>start/login"><button>Acessar SPE</button></a>
</div>