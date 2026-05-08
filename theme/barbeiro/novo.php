<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div id="app" class="card shadow mb-4">
    <input type="hidden" id="url_base" value="<?= ROOT; ?>">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Barbeiros</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <div>
                <div class="form-row">
                    <div class="form-group col-8">
                        <label for="nome">Nome</label>
                        <input type="text" v-model="nome" name="nome" id="nome" class="form-control">
                    </div>

                    <div class="form-group col-2">
                        <label for="cfp">CPF</label>
                        <input type="text" v-model="cpf" maxlength="11" name="cfp" id="cfp" class="form-control">
                    </div>

                    <div class="form-group col-2">
                        <label for="data_contratacao">Data Contratação</label>
                        <input type="date" v-model="data_contratacao" name="data_contratacao" id="data_contratacao" class="form-control">
                    </div>

                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td colspan="3">
                                    <h6 class="m-0 font-weight-bold text-primary">Adicionar Especialidades</h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%">
                                    Ações
                                </td>
                                <td style="width: 10%">Id</td>
                                <td style="width: 70%">Descrição</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in especialidades">
                                <td>
                                    <button v-on:click="adicionar(item)" class="btn btn-primary btn-sm">Adicionar</button>
                                </td>
                                <td>{{ item.especialidade_id }}</td>
                                <td>{{ item.descricao }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <td colspan="3">
                                    <h6 class="m-0 font-weight-bold text-primary">Especialidade: {{ nome }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%">
                                    Ações
                                </td>
                                <td style="width: 10%">Id</td>
                                <td style="width: 70%">Descrição</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in especialidadeBarbeiro">
                                <td>
                                    <button v-on:click="remover(index)" class="btn btn-danger btn-sm">Remover</button>
                                </td>
                                <td>{{ item.especialidade_id }}</td>
                                <td>{{ item.descricao }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group col-12 text-center">
                        <button v-on:click="cadastrar()" class="btn btn-primary">Salvar</button>
                        <a href="<?= $router->route("barbeiro.home") ?>" class="btn btn-danger">Cancelar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start("js"); ?>
<script src="<?= url('/theme/assets/js/barbeiro/novo.js') ?>"></script>

<?php $this->end(); ?>