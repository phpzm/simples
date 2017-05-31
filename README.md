# Simples

Imagine ter uma estrutura de projeto simples e intuitiva com apenas um comando.. Com Simples isso é possível. Se você tem um projeto pequeno, com poucas necessidades e poucos recursos pode simplesmente usar:
```
$ composer create-project phpzm/simples
```
ou
```
$ git clone https://github.com/phpzm/simples.git {dir}
$ cd {dir}
$ rm .git
$ composer install
```

Neste momento você já tem baixada uma arquiretura básica e é preciso configurar alguns detalhes para sair usando feliz da vida recursos básicos para um desenvolver um site ou sistema em PHP.

## Configurações do Ambiente

As duas configurações que são disponibilizadas como base são direcionadas para a mesma url: `http://localhost:8080`

### Docker

Cria uma cópia do arquivo de exemplo que é disponibilizado junto com o projeto
```
$ cp docker-compose.yml.sample docker-compose.yml
$ docker-compose up
```

### Built-in Server

Para utilizar o o servidor de desenvolvimento que vem junto com o PHP utilize os comandos abaixo
```
$ composer run serve --timeout=0
```

Se deu tudo certo, ao acessar a url `http://localhost:8080` você já verá nossa página padrão de apresentação

## Configurações Básicas
### Criando rotas

A configuração de qual a primeira rota (ou quais as primeiras rotas) será chamada fica por padrão dentro de `app/configs/route.php`.

As configurações de acesso aos recursos da aplicação podem ser feitas nos arquivos de rotas. Os comandos podem ser escritos diretamente direto no corpo do arquivo (onde uma variável $router estará disponível por questões de escopo) ou usando o retorno de closures que recebem o $router como parâmetro.

Rotas simples
```php
return function($router) {

    $router->on('GET', '/', function() {
       return 'Hello World!';
    });
}
```

Rotas dinâmicas
```php
return function($router) {

    $router->get('/:controller/:method', function($controller, $method) {
       return 'Hello World!';
    });
}
```

Grupos de Rotas
```php
return function($router) {

    // lista com arquivos de rota
    $router->group('GET', '/site', ['more/files/routes.php', 'more/files/site.php']);

    // pasta que contém arquivos de rotas
    $router->group('*', '/api', 'api/routes');
}
```

Rotas com Interação com Controllers
```php
return function($router) {

    $router->post('/client/save', '\Namespace\ClientController@save');
    $router->resource('client', '\Namespace\ClientController');
}
```
Um `$router->resource` vai criar:<br>
<table>
<thead>
<tr>
  <th>Verb</th> <th>Path</th> <th>Action</th> <th>Route Name</th>
</tr>
</thead>

<tbody>
<tr>
<td>GET</td>
<td>
  <code class=" language-php">
    /route
  </code>
</td>
<td>index</td>
<td>route.index</td>
</tr>

<tr>
<td>GET</td>
<td>
  <code class=" language-php">
    /route/create
  </code>
</td>
<td>create</td>
<td>route.create</td>
</tr>

<tr>
<td>GET</td>
<td>
  <code class=" language-php">
    /route/{id}
  </code>
</td>
<td>show</td>
<td>route.show</td>
</tr>

<tr>
<td>GET</td>
<td>
  <code class=" language-php">
    /route/{id}/edit
  </code>
</td>
<td>edit</td>
<td>route.edit</td>
</tr>


<tr>
<td>POST</td>
<td>
  <code class=" language-php">
    /route
   </code>
</td>
<td>store</td>
<td>route.store</td>
</tr>

<tr>
<td>PUT/PATCH</td>
<td>
  <code class=" language-php">
    /route/{id}
  </code>
</td>
<td>update</td>
<td>route.update</td>
</tr>

<tr>
<td>DELETE</td>
<td>
  <code class=" language-php">
    /route/{id}
  </code>
</td>
<td>destroy</td>
<td>route.destroy</td>
</tr>
</tbody>
</table>
