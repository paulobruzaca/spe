<h4>Usuários do Sistema</h4>

<div class="usuarios">
    <a href="<?= base_url();?>usuario/cadastroUsuario"><button>Cadastrar Usuário</button></a>

    <table id="custom">
        <head>
            <tr id="titulo">
                <td>NOME</td>
                <td>SOBRENOME</td>
                <td>CPF</td>
                <td>E-MAIL</td>
                <td>ADMIN</td>
                <td>AÇÕES</td>
            </tr>
        </head>
        <body>
            <?php
                foreach($usuarios as $usuario){
                    ?>
                        <tr>
                            <td><?= $usuario->nome; ?></td>
                            <td><?= $usuario->sobrenome; ?></td>
                            <td><?= $usuario->cpf; ?></td>
                            <td><?= $usuario->email; ?></td>
                            <td class="centro">
                                <?php 
                                    if($usuario->admin == 0){
                                        echo "NÃO";
                                    }else if($usuario->admin == 1){
                                        echo "SIM";
                                    }
                                ?>
                            </td>
                            <td class="centro">
                                <a href="<?= base_url();?>usuario/uploadFoto/<?= $usuario->idUsuario; ?>">Foto</a> |
                                <a href="<?= base_url();?>usuario/alterarSenha/<?= $usuario->idUsuario; ?>">Senha</a> |
                                <a href="<?= base_url();?>usuario/editarUsuario/<?= $usuario->idUsuario; ?>">Editar</a> | 
                                <a href="<?= base_url();?>usuario/excluirUsuario/<?= $usuario->idUsuario;?>" onclick="return confirm('Deseja realmente excluir o Usuário?');">Excluir</a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </body>
    </table>
</div>