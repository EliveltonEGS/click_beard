<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Especialidades</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="text-center">
                <a href="<?= $router->route("especialidade.novo") ?>" class="btn btn-primary mb-3"><i class="fas fa-new"></i>Novo</a>
                <?php if (isset($success)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success; ?>
                    </div>
                <?php } ?>
            </div>
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td style="width: 20%">Ações</td>
                        <td style="width: 80%">Descrição</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($especialidades as $item) { ?>
                        <tr>
                            <td>
                                <a title="Excluir" href="<?= url("/especialidade/deletar/{$item['especialidade_id']}") ?>" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash"></i></a>
                                <a title="Editar" href="<?= url("/especialidade/editar/{$item['especialidade_id']}") ?>" class="btn btn-warning btn-sm btn-circle"><i class="fas fa-edit"></i></a>
                            </td>
                            <td><?= $item['descricao']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->start("js"); ?>

<?php $this->end(); ?>