# Simples

O Simples é um projeto que reúne um conjunto de pacotes para trabalhar com PHP de forma rápida e minimalista. Menos é mais!

## Instalação
Para começar a usar o Simples você pode usar o comando:
```shell
$ composer create-project phpzm/simples
```
ou fazer uma cópia da branch master do repositório
```shell
$ git clone https://github.com/phpzm/simples.git <dir>
$ cd <dir>
$ rm .git
$ composer install
```

Neste momento você já tem baixada uma arquitetura básica, e é preciso configurar alguns detalhes para sair usando feliz da vida recursos básicos para um desenvolver um site ou sistema em PHP.

## Configurações do Ambiente

As duas configurações que são disponibilizadas como base que vamos citar abaixo são direcionadas para a mesma url: `http://localhost:8080`
Antes de iniciar qualquer um dos modos do servidor, faça uma cópia do arquivo de exemplo do `.env` que é disponibilizado com o projeto
```shell
$ composer run env:init
```

### Docker

Cria uma cópia do arquivo de exemplo que é disponibilizado junto com o projeto
```shell
$ composer run docker:init
```

Em seguida você pode usar o comando que está acostumado para rodar os containers ou usar
```shell
$ composer run docker:serve --timeout=0
```

### Built-in Server

Para utilizar o o servidor de desenvolvimento que vem junto com o PHP utilize os comandos abaixo

```shell
$ composer run php:serve --timeout=0
```

Se deu tudo certo, ao acessar a url `http://localhost:8080` você já verá nossa página padrão de apresentação

## Visão Geral

Certo, a url que deveria funcionar está ok, mas vamos fazer um apanhado geral do que aconteceu para ela rodar.

### /public
Nesta pasta você encontrará o único ponto de entrada para requisições que sua aplicação terá. Ao abrir o arquivo `index.php` que tem dentro dela encontramos a primeira interação com os arquivos do Simples. Além do arquivo PHP, nela também ficam arquivos que costumamos chamar de `assets`. São eles as imagens, arquivos de estilo e recursos usados para aprimorar a visualização dos recursos da aplicação. Esta pasta será usada para deixar expostos documentos que podem ser acessados por qualquer pessoa. 

### /config
Este diretório contém uma lista de arquivos PHP que são usados para configurar comportamentos da aplicação. Enquanto estiver dando uma olhada nesses arquivos verá que existe por lá uma função chamada `env` sendo utilizada para definir algumas propriedades. Esta função recupera os valores que estão definidos no `.env`. 

### /app
Finalmente chegamos onde a festa acontece. O Simples vem com as configurações adequadas para usar este diretório para consultar os documentos que você irá criar. Como você poderá fazer muita coisa, dividimos tudo em partes.

#### /app/resources
Abriga os documentos relacionados a composição dos recursos de forma indireta. Ele vem configurado inicialmente com 3 diretórios (email, locales, view), mas você pode crescer ele a vontade. É possível ver no arquivo `config/app.php` uma instrução de configuração semelhante a essa abaixo. Com base no exemplo, podemos usar o helper `config('app.resources.root')` que será retornado o valor `app/resources` e é assim que o Simples localiza os recursos que usa.

`[config/app.php]`
```php
<?php
    (...)
    'resources' => [
        'root' => 'app/resources',
    ]
    (...)
```
Veremos mais sobre essa parte das `views` e sobre sua utilização da seção de Templates.

#### /app/routes
Esse é um caminho sugerido para utilização das rotas. Ele está descrito em `config/route.php` onde é possível informar um array de arquivos que serão inicializados para compor as rotas da aplicação.

`[config/route.php]`
```php
<?php
    (...)
    'files' => [
        'app/routes/index.php'
    ]
    (...)
```
Sendo assim, quando uma requisição HTTP for enviada para o `public/index.php` ele irá começar a procurar por rotas no arquivo `app/routes/index.php`. Mais pra frente, na seção de criação de rotas, veremos como criar rotas de forma organizada utilizando o Simples.

#### /app/src
Esta pasta está diretamente relacionada ao `autoloader` do `Composer` através da configuração no `composer.json`

`[composer.json]`
```
  (...)
  "autoload": {
    "psr-4": {
      "App\\": "app/src/"
    }
  }
  (...)
```
Ou seja, o namespace padrão que você irá utilizar é o `App` e o arquivo deverá estar dentro da pasta descrita acima. Obviamente você pode modificar isso. Note que usando a convenção `PSR-4` quando você criar um documento com o `namespace` adequado poderá usá-lo de forma transparente. Entraremos em mais detalhes sobre isso na seção de composição de estruturas.

## /storage
Como forma de indicar um caminho inicial sugerimos essa pasta chamada `storage` na raiz do projeto para a manutenção de documentos que não podem ficar abertos ao acesso público.

## /vendor
A pasta `vendor` é criada automaticamente pelo `Composer`. Ela tem as dependências que seu projeto irá utilizar e as configurações de carregamentos de arquivos. Ela está por padrão configurada no arquivo `.gitignore` para ser ignorada pelo `Git`

## Iniciando os Trabalhos
### Criando rotas

A configuração de qual a primeira rota (ou quais as primeiras rotas) será chamada fica por padrão dentro de `app/config/route.php`.

As configurações de acesso aos recursos da aplicação podem ser feitas nos arquivos de rotas. Os comandos podem ser escritos diretamente no corpo do arquivo (onde uma variável $router estará disponível por questões de escopo) ou usando o retorno de closures que recebem o $router como parâmetro.

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
<table style="width: 100%">
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
