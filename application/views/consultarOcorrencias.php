<h4>Consultar Ocorrências</h4>
<form action="<?= base_url(); ?>ponto/printOcorrencia" method="post" target="_blank">
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
