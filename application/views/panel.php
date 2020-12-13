<div class="center">
    <h4>Bem Vindo!</h4>
    <h4><?= $this->session->userdata('nome'); ?></h4>
    
    <a href="<?= base_url();?>usuario/listar"><button>Usuários</button></a>
    <a href="<?= base_url();?>usuario"><button>Registrar Ponto</button></a>
    <a href="<?= base_url();?>usuario"><button>Consultar Batidas</button></a>
    <a href="<?= base_url();?>usuario"><button>Consultar Ocorrências</button></a>
    
</div>