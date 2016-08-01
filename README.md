## 1. Dependência

Usando o <a href="https://getcomposer.org/" target="_blank">composer</a>, execute o comando a seguir para instalar automaticamente `composer.json`:

```shell
composer require gilsonsouza/lara-cors
```

ou manualmente no seu arquivo `composer.json`

```json
{
    "require": {
        "composer require gilsonsouza/lara-cors": "^1.0"
    }
}
```

## 2. Middlewares
Para utilizá-los é necessário registrá-los no seu arquivo app/Http/Kernel.php.

```php
 protected $middleware = [
        // other middleware ommited
    	\LaraCors\Cors\CorsMiddleware::class,
 ];
```

## 3. Provider (opcional)

Selecionar os domínios permitidos no Laraver-Cors em sua aplicação Laravel, é necessário registrar o package no seu arquivo `config/app.php`. Adicione o seguinte código no fim da seção `providers`

```php
// file START ommited
    'providers' => [
        // other providers ommited
        \LaraCors\Cors\CorsServiceProvider::class,
    ],
// file END ommited
```

### 3.1 Publicando o arquivo de configuração (somente se tiver feito o passo 3)

Para publicar o arquivo de configuração padrão que acompanham o package, execute o seguinte comando:

```shell
php artisan vendor:publish  --provider="LaraCors\Cors\CorsServiceProvider"
```


## 4 Configurações (somente se tiver feito o passo 3, e 3.1)

Configure o arquivo com os domínios que dejeja liberar

`config/cors.php`

## 5 Requisições Ajax
Se estiver usando o guard do laravel e a autenticação via middleware (Authenticate), em suas requisições via ajax, adicione os seguintes parâmetros (nesse caso eu estou utilizando o ajax do jquery, mas utilize o método que preferir, somente lembre de adicionar os parâmetros conforme definidos no seu método)
```
crossDomain : true,
xhrFields: {
    withCredentials: true
}
```

Ex.:

```
$.ajax({
    type: "GET",
    dataType: 'json',
    url: API_ENDPOINT,
    crossDomain : true,
    xhrFields: {
        withCredentials: true
    }
})
.done(function( data ) {
    console.log(data);
});
```

## 6 Bônus

Caso seu servidor seje apache, talvez seja necessário adicionar estas linhas abaixo ao .htaccess
```
    <IfModule mod_rewrite.c>
        <IfModule mod_negotiation.c>
            Options -MultiViews
        </IfModule>
    </IfModule>
```
