<h4>Editar um Usuário</h4>
<form action="<?= base_url(); ?>usuario/salvarAlteracao/" method="post">
    <input type="hidden" name="idUsuario" value="<?= $usuario[0]->idUsuario; ?>">
    <label for="nome">Usuário:</label>
    <input type="text" name="nome" required value="<?= $usuario[0]->nome; ?>">
    <label for="sobrenome">Sobrenome:</label>
    <input type="text" name="sobrenome" required value="<?= $usuario[0]->sobrenome; ?>">
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" maxlength="11" required value="<?= $usuario[0]->cpf; ?>">
    <label for="email">E-mail:</label>
    <input type="email" name="email" value="<?= $usuario[0]->email; ?>">
    <label for="admin">Administrador:</label>
    <select name="admin" id="admin">
        <option value="1" <?= $usuario[0]->admin == 1 ?'selected':''; ?>>SIM</option>
        <option value="0" <?= $usuario[0]->admin == 0 ?'selected':''; ?>>NÃO</option>
    </select>
    <input type="submit" value="Alterar">
</form>