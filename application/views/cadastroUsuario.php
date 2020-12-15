<h4>Cadastrar um Usuário</h4>
<form action="<?= base_url(); ?>usuario/cadastrar" method="post">
    <label for="nome">Usuário:</label>
    <input type="text" name="nome" required>
    <label for="sobrenome">Sobrenome:</label>
    <input type="text" name="sobrenome" required>
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" maxlength="11" required>
    <label for="email">E-mail:</label>
    <input type="email" name="email">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" required>
    <label for="admin">Administrador:</label>
    <select name="admin" id="admin">
        <option value="1">SIM</option>
        <option value="0">NÃO</option>
    </select>
    <input type="submit" value="Cadastrar">
</form>
<div class="voltar">
    <a href="<?= base_url();?>panel"><button>Voltar</button></a>
</div>
