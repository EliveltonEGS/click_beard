<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div id="app" class="card shadow mb-4">
    <input type="hidden" id="url_base" value="<?= ROOT; ?>">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Perfil</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="nome">Nome</label>
                        <input type="text" readonly name="nome" id="nome" value="<?= $usuario["nome"] ?>" class="form-control">
                    </div>

                    <div class="form-group col-6">
                        <label for="cfp">CPF</label>
                        <input readonly type="text" name="email" id="email" value="<?= $usuario["email"] ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start("js"); ?>
<script src="<?= url('/theme/assets/js/barbeiro/novo.js') ?>"></script>

<?php $this->end(); ?>