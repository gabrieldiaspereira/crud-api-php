# Sobre

<i>Um API Rest que realiza um CRUD de usuarios, utilizando PHP com Mysql, além de bootstrap e jquery para facilitar o desenvolvimento front-end</i><br> <br>
<b>Especificaçes Back-end:</b><br><br>
API que realiza o CRUD de usuários utilizando a linguagem PHP.<br><br>
<b>Especificações Front-end:</b><br><br>
Desenvolvida uma interface para criar, editar, deletar e listar usuários utilizando a API criada.<br>
O cadastro de usuário contem nome, e-mail, telefone, CEP, UF, bairro, cidade e rua.<br>
O endereço(UF, bairro, cidade e rua) é consumido da API https://viacep.com.br/ através do CEP.<br>
Todos os campos do front-end foram validados.<br>

# Instalação

Para utilizar você deve ter o banco de dados e a tabela onde será feito o CRUD, para criar basta executar este código SQL:

```
create database crudapi;
use crudapi;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `uf` varchar(3) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```
Caso você não esteja utilizando o usuario padrão "root", basta editar a função database_connection no arquivo de caminho `api/Api.php` <br><br>
**Observação:**<br>
Caso por algum motivo você precise alterar a estrutura atual do projeto, você deve editar a variavel $api_url no arquivo `api/Api.php`<br>
A estrutura de arquivo do projeto é a seguinte:
- crudapi
  - API
    - api.php
    - test_api.php
  - Work
    - index.php
    - fetch.php
    - action.php<br>

# Utilização
Basta digitar em seu navegador: `localhost/crudapi/work` para acessar a interface e realizar o crud normalmente.<br>

Caso queira testar a API basta pesquisar por `http://localhost/crudapi/api/test_api.php?action=fetch_all` para visualizar todos os registros por exemplo. <br>

# Futuras alterações
Back-end: Utilizar o laravel com autenticação por token na API.<br>
Front-end: Utilizar o Vue, React ou Angular.<br>


