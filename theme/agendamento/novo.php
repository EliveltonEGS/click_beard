<?php $this->layout("_theme", ["title" => "ClickBeard"]); ?>

<div id="app" class="card shadow mb-4">
    <div class="card-header py-3">
        <input type="hidden" id="url_base" value="<?= ROOT; ?>">
        <h6 class="m-0 font-weight-bold text-primary">Agendamento</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <div>
                <div class="form-row">
                    <div class="form-group col-8">
                        <label for="barbeiro">Barbeiro: <span style="font-weight: bold; font-size: 13px;" id="especialidade"></span></label>
                        <select v-model="barbeiro" name="barbeiro" id="barbeiro" class="form-control">
                            <option v-for="item in barbeiros" :value="item" v-on:click="especialidadeBarbeiro(item)">{{ item.nome }}</option>
                        </select>
                    </div>

                    <div class="form-group col-2">
                        <label for="data">Data do Agendamento</label>
                        <input v-model="data" v-on:blur="horario" type="date" name="data" id="data" class="form-control">
                    </div>

                    <div class="form-group col-2">
                        <label for="horario">Horários Disponíveis</label>
                        <select v-model="horas" name="horas" id="horas" class="form-control">
                            <option v-for="item in horarios" :value="item">{{ item.hora }}</option>
                        </select>
                    </div>

                    <div class="form-group col-12 text-center">
                        <button v-on:click="cadastrar" class="btn btn-primary">Salvar</button>
                        <a href="<?= $router->route("adm.home"); ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start("js"); ?>
<script src="<?= url('/theme/assets/js/agendamento/novo.js') ?>"></script>

<?php $this->end(); ?>