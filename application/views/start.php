<h4>Acesso ao SPE</h4>
<form action="<?= base_url(); ?>start/access" method="post">
    <label for="user">Usuário:</label>
    <input type="text" name="user" maxlength="11">
    <label for="password">Senha:</label>
    <input type="password" name="password">
    <input type="submit" value="Acessar">
</form>