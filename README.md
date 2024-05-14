#  Desafio.PHP API RESTFul

Para o desafio, foi desenvolvido uma API em PHP usando o Framework Laravel que consiste em criar uma API RESTFul, o objetivo principal do desafio é fazer um CRUD de Usuários .

# Como utilizar
## Clonar o repositório
<pre>
<code>git clone https://github.com/RennanEckhardt/Estudo-PHP-Laravel.git</code>
</pre>
## Rodar a API
<pre>
<code>cd api</code>
<code>composer update</code>
<code>php artisan serve</code>
<code>php artisan db:seed</code>
</pre>

A aplicação irá rodar no endereço <code>http://127.0.0.1:8000</code>

# Metas
Para a entrega do desafio, foi estabelecido as Metas

**✅**• Organização do código e simplicidade na lógica de programação. 

>Utilizei de maneira simples e eficaz os metodos do laravel e minha logica.

**✅**• Criar as migrations e seeds para validação (obrigatório) 

>As tabelas de entidades foram criadas através de migrations utilizando o php php artisan assim como as seeds.

**✅**• Deixar sempre a regra de negócio o mais desacoplada possível. 

>Utilizando dos recursos do proprio laravel como Validator acredito que esse objetivo tambem foi alcançado

**✅**• JWT (não obrigatório porém será considerado diferencial)

>Foi criado rotas que demandam a autenticação e autorização utilizando o JWT.

**✅**• Criar os mocks de teste (não obrigatório porém será considerado diferencial)

>Foi Criado os testes para algumas das funçoes existentes no UserController

## Endpoints
#### POST:/ping:Usada para verificar status do servidor
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/8bfd3605-cd0b-4453-bcb2-0aaf08ddaad3)
#### POST:/auth:Usada para obter o token
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/bf3be9ad-ea59-40fc-8e80-074071b1724b)
#### GET:/user:Obter todos os usuario 
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/71192e34-fc30-4d4a-a498-d7a431ce779b)
#### POST:/user:Criar um novo usuario (REQUER TOKEN DE ACESSO NO HEADERS)
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/477651a3-8ff9-4159-b590-1664d25038d8)
#### PUT:/user:Alterar os dados de um usuario (REQUER TOKEN DE ACESSO NO HEADERS)
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/ab2d02d5-2a5f-47e7-ad2e-65d02d02e37e)
#### DELETE:/user: Deleta um usuario (REQUER TOKEN DE ACESSO NO HEADERS)
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/59c7742b-5935-463e-954f-98da968640fd)
#### GET:/user/{id}: Traz os dados de um usuario especifico (REQUER TOKEN DE ACESSO NO HEADERS)
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/c649a350-836a-4c34-a5b5-0cb622e8f44e)

## Autenticação e Autorização

 Para a realização da autenticação e autorização foi adicionado a rota <code>[POST] /Auth</code>, que retorna um token que poderá ser utilizado nas rotas de adição,remoção e alteração  de usuarios.
 
### Login
A senha padrao ao rodar a migration e password.
##### Exemplo de json para ser enviado na rota auth:
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/fe8e2ad5-7bf8-4ce2-8865-8bb877dde913)

User teste: <code>email: Email-Gerado-migration@example.org, password: password</code>

##### Exemplo Heads que deve ser montado nas rotas com proteção:
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/76e14e01-2abe-4a42-a8db-f22c533ed13d)

## Testes phpunit
Utilizando o comando `php artisan test --filter UserControllerTest` e possivel rodar o arquivo de teste, onde o mesmo testa algumas funçoes do programa
![image](https://github.com/RennanEckhardt/teste-backend-php/assets/75341121/052714b0-ad8b-4c8c-a43e-2fd285d914a9)


## Regras de Negócio Implementadas no Controlador `UserController`

### Ping

- **Método:** POST
- **Descrição:** Verifica se o servidor está online e pronto para atender solicitações.
- **Resposta:**
  - Status 200: O servidor está online e responde com uma mensagem de sucesso, incluindo o horário atual do servidor.

### Index

- **Método:** GET
- **Descrição:** Retorna todos os usuários cadastrados.
- **Resposta:**
  - Status 200: Retorna uma lista de todos os usuários no formato JSON.

### Show

- **Método:** GET
- **Descrição:** Retorna os detalhes de um usuário específico com base no ID fornecido.
- **Resposta:**
  - Status 200: Retorna os detalhes do usuário solicitado.
  - Status 404: Se o usuário não for encontrado.

### Store

- **Método:** POST
- **Descrição:** Cria um novo usuário com os dados fornecidos.
- **Validação:**
  - Nome, CPF e email são obrigatórios.
  - CPF e email devem ser únicos na base de dados.
- **Resposta:**
  - Status 201: Retorna uma mensagem de sucesso junto com os detalhes do usuário criado.

### Update

- **Método:** PUT
- **Descrição:** Atualiza os detalhes de um usuário existente com base no ID fornecido.
- **Validação:**
  - ID do usuário, nome, CPF e email são obrigatórios.
  - CPF e email devem ser únicos na base de dados, excluindo o próprio usuário.
- **Resposta:**
  - Status 200: Retorna uma mensagem de sucesso junto com os detalhes do usuário atualizado.
  - Status 404: Se o usuário não for encontrado.

### Destroy

- **Método:** DELETE
- **Descrição:** Exclui um usuário com base no ID fornecido.
- **Validação:**
  - ID do usuário é obrigatório e deve existir na base de dados.
- **Resposta:**
  - Status 200: Retorna uma mensagem de sucesso após excluir o usuário.
  - Status 404: Se o usuário não for encontrado.
