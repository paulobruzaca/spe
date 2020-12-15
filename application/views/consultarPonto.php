<h4>COnsultar Registros de Ponto</h4>
<form action="<?= base_url(); ?>ponto/printPonto" method="post" target="_blank">
    <label for="cpf">CPF:</label>
    <input type="text" name="cpf" >
    <label for="dataInicio">Data de Inicio:</label>
    <input type="text" name="dataInicio" >
    <label for="dataFim">Data Final:</label>
    <input type="text" name="dataFim" >
    <input type="submit" value="Pesquisar">
</form>
<div class="voltar">
    <a href="<?= base_url();?>panel"><button>Voltar</button></a>
</div>
