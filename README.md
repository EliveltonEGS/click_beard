# click_beard

### Instruções para utilização

* O usuário ADM é criado no momento em que o script do banco é executado;
* O script encontra-se em: [click_beard/docs/script_db.sql];
* Utilizei como ferramenta para gerenciar os camandos MySQL o MySQL Worckbench e também a execução do script;
* O projeto foi desenvolvido no servidor de teste Xampp, que contém o apache, php e MairaDB(MySQL);
* Deve ser movida a pasta do projeto para o diretório [C:\xampp\htdocs\click_beard] no ambiente windows que é o que utilizei;
* Para executar o projeto no navegador basta start o xampp e acessar no navegador [http://localhost:8090].

### Usuário ADM - login:
email: 
```
adm@gmail.com
```

senha: 
```
adm
```

### O usuário ADM faz as seguintes gestões no sistema

- O usuário ADM é resonsável por cadastrar/editar/excluir as especialidades;
- O usuário ADM é responsável por cadastrar os barbeiros e sua data de contratação e vincular as suas especialidades, poderá também excluir o barbeiro cadastrado;
- O usuário ADM pode visualizar e também efetuar cancelamento dos horários agendados pelos clientes;
- O usuário ADM pode finalizar o atendimento após encerrá-lo;
- O usuário ADM pode cancelar o agendamento a qualquer momento sem intervalo de tempo.

### O usuário CLIENTE faz as seguintes gestões

- Pode agendar um horário, escolher o barbeiro com suas especialidades;
- Visualizar o status do agendamento;
- Cancelar o agendamento caso desejar com duas horas de antedêcencia.

Obs: 
- Não foram realizado filtros e paginações pois acredito que o foco do mini sistema seria o gerenciamento de clientes e seus respectivos agendamentos de horários;
- O CPF no cadastro de barbeiros deve ser somente números.
- No diretório [\click_beard\docs\prints] contém alguns prints do sistema em funcionamento.
- Tem partes do sistema que foi desenvolvido somente com PHP e outras partes com JavaScript para demonstrar que pode ser feito de várias formas diferentes.
