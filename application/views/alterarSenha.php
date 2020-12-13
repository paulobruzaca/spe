<h4>Cadastrar um Usuário</h4>
<form action="<?= base_url(); ?>usuario/salvarSenha" method="post">
    <input type="hidden" name="idUsuario" value="<?= $usuario[0]->idUsuario; ?>">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" required>
    
    <input type="submit" value="Alterar Senha">
</form>