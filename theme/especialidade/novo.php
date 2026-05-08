<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Especialidade</h6>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        
        <?php if(isset($error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
        <?php } ?>
        
        <?php if(isset($success)) { ?>
        <div class="alert alert-success" role="alert">
            <?= $success; ?>
        </div>
        <?php } ?>
        
        <form action="<?= url("/especialidade/cadastrar") ?>" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="especialidade">Especialidade</label>
                    <input type="text" name="especialidade" id="especialidade" class="form-control">
                </div>

                <div class="form-group col-12 text-center">
                <input type="submit" value="Salvar" class="btn btn-primary">
                <a href="<?= url("/especialidade") ?>" class="btn btn-danger">Cancelar</a>
            </div>

            </div>
        </form>
    </div>
    </div>
</div>

<?php $this->start("js"); ?>

<?php $this->end(); ?>