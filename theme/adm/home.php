<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div id="app" class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Horários Marcados</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if (isset($_SESSION["USUARIO"]) && $_SESSION["USUARIO"]["tipo"] == "C") { ?>
                <div class="text-center mb-3">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 20%;">
                                Pesquisar Por Nome
                            </td>
                            <td style="width: 60%;">
                                <input type="text" id="nome" name="nome" v-model="nome" class="form-control">
                            </td>
                            <td style="width: 20%; text-align: left;">
                                <button v-on:click="listaAgendamentos" class="btn btn-primary">Pesquisar</button>
                                <a href="<?= $router->route("agendamento.novo") ?>" class="btn btn-primary"><i class="fas fa-new"></i>Novo</a>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php } else { ?>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 20%;">
                            Pesquisar Por Nome
                        </td>
                        <td style="width: 60%;">
                            <input type="text" id="nome" name="nome" v-model="nome" class="form-control">
                        </td>
                        <td style="width: 20%; text-align: left;">
                            <button v-on:click="listaAgendamentos" class="btn btn-primary">Pesquisar</button>
                        </td>
                    </tr>
                </table>
            <?php } ?>
            <input type="hidden" id="url_base" value="<?= ROOT; ?>">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td style="width: 20%">Ações</td>
                        <td style="width: 30%">Nome</td>
                        <td style="width: 30%">Barbeiro</td>
                        <td style="width: 20%">Data - Horário</td>
                        <td style="width: 10%">Status</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in agendamentos">
                        <td>
                            <button v-if="item.status == 'Agendado'" v-on:click="cancelar(item)" class="btn btn-danger btn-sm">Cancelar</button>
                            <?php if (isset($_SESSION["USUARIO"]) && $_SESSION["USUARIO"]["tipo"] == "A") { ?>
                                <button v-if="item.status == 'Agendado'" v-on:click="concluirAgendamento(item)" class="btn btn-primary btn-sm">Finalizar</button>
                            <?php } ?>
                        </td>
                        <td>{{ item.cliente }}</td>
                        <td>{{ item.barbeiro }}</td>
                        <td><span style="font-weight: bold;">{{ item.data }}</span></td>
                        <td>
                            <span v-if="item.status == 'Agendado'" style="color: green; font-weight: bold;">{{ item.status }}</span>
                            <span v-else-if="item.status == 'Finalizado'" style="color: blue; font-weight: bold;">{{ item.status }}</span>
                            <span v-else style="color: red; font-weight: bold;">{{ item.status }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->start("js"); ?>
<script src="<?= url('/theme/assets/js/agendamento/home.js') ?>"></script>

<?php $this->end(); ?>