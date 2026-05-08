<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <input type="hidden" id="url_base" value="<?= ROOT; ?>">

        <h6 class="m-0 font-weight-bold text-primary">Barbeiros</h6>
        <?php if (isset($success)) { ?>
            <div class="alert alert-success" role="alert">
                <?= $success; ?>
            </div>
        <?php } ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="text-center">
                <a href="<?= $router->route("barbeiro.novo") ?>" class="btn btn-primary mb-3"><i class="fas fa-new"></i>Novo</a>
            </div>
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td style="width: 10%">Ações</td>
                        <td style="width: 40%">Nome</td>
                        <td style="width: 20%">Dt. Contratação</td>
                        <td style="width: 10%">Especialidade</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($barbeiros as $item) { ?>
                        <tr>
                            <td>
                                <a title="Excluir" href="<?= url("/barbeiro/deletar/{$item["barbeiro_id"]}") ?>" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-sm btn-circle"><i class="fas fa-trash"></i></a>
                            </td>
                            <td><?= $item["nome"] ?></td>
                            <td><?= $item["data_contratacao"] ?></td>
                            <td>
                                <button onclick="especialidade(<?= $item['barbeiro_id'] ?>)" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Visualisar</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body">
                <span id="especialidade"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $this->start("js"); ?>
<script src="<?= url('/theme/assets/js/barbeiro/home.js') ?>"></script>
<?php $this->end(); ?>