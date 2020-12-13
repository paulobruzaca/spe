<h4>Cadastrar um Usuário</h4>
<form action="<?= base_url(); ?>usuario/upload" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idUsuario" value="<?= $usuario[0]->idUsuario; ?>">
    <input type="hidden" name="cpf" value="<?= $usuario[0]->cpf; ?>">
    <label for="fotoUsuario">Foto:</label>
    <input type="file" name="fotoUsuario" required>
    <input type="submit" value="Cadastrar">
</form>