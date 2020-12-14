<div class="center">
    <h4>Bem Vindo!</h4>
    <div class="foto">
        <img src="<?= base_url(); ?>assets/fotos/<?= $usuario[0]->fotoUsuario; ?>">
    </div>
    <h4><?= $usuario[0]->nome." ".$usuario[0]->sobrenome; ?></h4>
    
    <a href="<?= base_url();?>usuario/listar"><button>Usuários</button></a>
    <a href="<?= base_url();?>usuario"><button>Consultar Batidas</button></a>
    <a href="<?= base_url();?>usuario"><button>Consultar Ocorrências</button></a>
    <hr>
    <a href="<?= base_url();?>start/exit"><button>Sair do Sistema</button></a>
</div>