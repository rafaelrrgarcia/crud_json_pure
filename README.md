## CRUD JSON PURE

Sistema CRUD simples para requisição de usuários, endereços, cidades e estados feito em PHP puro.

### Tecnologias

*  PHP 7.3
*  MySQL

### Autor

[Rafael Garcia - Linkedin](https://www.linkedin.com/in/kaaiseer/)

### Endpoints

#### Users (Usuários)

```[GET] /users```
*  **Descrição**: Retorna uma lista de usuários e o ID do Endereço de cada um
*  **Parâmetros**: Nenhum.

```[POST] /users```
*  **Descrição**: Cadastra um novo usuário vinculando-o a um endereço existente.
*  **Parâmetros**: 
   *  *address_id* - ID do Endereço do usuário;
   *  *name* - Nome do usuário;

```[POST] /users/full```
*  **Descrição**: Cadastra um novo usuário, cadastrando também endereço, cidade e estado simultâneamente se necessário. Vincula automaticamente ao dado existente caso seja identificado que endereço, cidade ou estado já existam.
*  **Parâmetros**: 
   *  *name* - Nome do usuário;
   *  *address* - Endereço do usuário;
   *  *city* - Cidade do usuário;
   *  *state* - Nome do estado do usuário;
   *  *state_uf* - Sigla do estado do usuário;

```[GET] /users/{codigo}```
*  **Descrição**: Retorna um usuário específico pelo ID e o ID do Endereço dele.
*  **Parâmetros**: Nenhum.

```[POST] /users/{codigo}```
*  **Descrição**: Atualiza um usuário específico.
*  **Parâmetros**: 
   *  *address_id* - ID do Endereço do usuário;
   *  *name* - Nome do usuário;
   
```[DELETE] /users/{codigo}```
*  **Descrição**: Deleta um usuário específico.
*  **Parâmetros**: Nenhum.

---

#### Addresses (Endereços)

```[GET] /addresses```
*  **Descrição**: Retorna uma lista de endereços e o ID do Cidade de cada um
*  **Parâmetros**: Nenhum.

```[POST] /addresses```
*  **Descrição**: Cadastra um novo endereço vinculando-o a um endereço existente.
*  **Parâmetros**: 
   *  *city_id* - ID da cidade do endereço;
   *  *address* - Nome do endereço;

```[GET] /addresses/{codigo}```
*  **Descrição**: Retorna um endereço específico pelo ID e o ID da Cidade dele.
*  **Parâmetros**: Nenhum.

```[POST] /addresses/{codigo}```
*  **Descrição**: Atualiza um endereço específico.
*  **Parâmetros**: 
   *  *city_id* - ID da cidade do endereço;
   *  *address* - Nome do endereço;
   
```[DELETE] /addresses/{codigo}```
*  **Descrição**: Deleta um endereço específico.
*  **Parâmetros**: Nenhum.

---

#### Cities (Cidades)

```[GET] /cities```
*  **Descrição**: Retorna uma lista de municípios e o ID do Estado de cada um. Também retorna o número de usuários cadastrados pertencentes ao município.
*  **Parâmetros**: Nenhum.

```[POST] /cities```
*  **Descrição**: Cadastra um novo município vinculando-o a um município existente.
*  **Parâmetros**: 
   *  *state_id* - ID do estado do município;
   *  *name* - Nome do município;

```[GET] /cities/{codigo}```
*  **Descrição**: Retorna um município específico pelo ID e o ID do Estado dele. Também retorna o número de usuários cadastrados pertencentes ao município.
*  **Parâmetros**: Nenhum.

```[POST] /cities/{codigo}```
*  **Descrição**: Atualiza um município específico.
*  **Parâmetros**: 
   *  *state_id* - ID do estado do município;
   *  *name* - Nome do município;
   
```[DELETE] /cities/{codigo}```
*  **Descrição**: Deleta um município específico.
*  **Parâmetros**: Nenhum.

---

#### States (Estados)

```[GET] /states```
*  **Descrição**: Retorna uma lista de estados e o UF de cada um. Também retorna o número de usuários cadastrados pertencentes ao estado.
*  **Parâmetros**: Nenhum.

```[POST] /states```
*  **Descrição**: Cadastra um novo estado.
*  **Parâmetros**: 
   *  *name* - Nome do estado;
   *  *uf* - Sigla do estado;

```[GET] /states/{codigo}```
*  **Descrição**: Retorna um estado específico pelo ID e o UF dele. Também retorna o número de usuários cadastrados pertencentes ao estado.
*  **Parâmetros**: Nenhum.

```[POST] /states/{codigo}```
*  **Descrição**: Atualiza um estado específico.
*  **Parâmetros**: 
   *  *name* - Nome do estado;
   *  *uf* - Sigla do estado;
   
```[DELETE] /states/{codigo}```
*  **Descrição**: Deleta um estado específico.
*  **Parâmetros**: Nenhum.
