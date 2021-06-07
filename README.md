
# Encurtador de Url simples desenvolvido em Laravel 8

## Requisitos
PHP >= 7.4 <br>
BCMath PHP Extension <br>
Ctype PHP Extension <br>
Fileinfo PHP extension <br>
JSON PHP Extension <br>
Mbstring PHP Extension <br>
OpenSSL PHP Extension <br>
PDO PHP Extension <br>
Tokenizer PHP Extension <br>
XML PHP Extension <br>

## Instalação

> Clone o repositório </br>
cd urlshortener </br>
composer install <br>
cp .env.example .env - configure a Url no APP_URL (Sem barra no final)<br>
php artisan key:generate


## Testes
> Atenção: Após finalizar os testes, todos os dados do banco serão excluídos, recomenda-se criar um .env.testing ou utilizar outro banco para testes.

> php artisan test ou ./vendor/bin/phpunit

- Create short link
- Create short link slug
- Create short link expires
- Create short link all
- Create short link all post
- Acess link
- Acess link expired


## Migrate/Seed
    php artisan migrate --seed

## Demo User
demo@demo.com
12345678

## Api
 A Api recebe no máximo três parâmetros, você pode especificar o link para ser encurtado, personalizar o shortlink e a data de expiração que por padrão é de 7 dias.

## Get

	- api/v1/lista listagem de todas as urls cadastradas no sistema
	- api/v1/encurtar?link=http://google.com.br informe o parametro link e a url
	- api/v1/encurtar?link=http://google.com.br&shortlink=minha-url shortlink= Permite personalizar o shortlink
	- api/v1/encurtar?link=http://google.com.br&shortlink=minha-url&expire=10/10/2020 expire= Permite personalizar a data de expiração, formato d/m/Y


## O único parametro obrigatório é ?link= o restante se deixado em branco será gerado automaticamente e o retorno sempre será em json

## Post
	- api/v1/encurtar
	- Semelhante aos comandos do Get, no entando, você irá passar os dados no body
	- link, shortlink, expire_adm

## O único campo obrigatório é Link, o restante se deixado em branco será gerado automaticamente


## Imagens
Segue em anexo alguns prints referentes a aplicação

### Lista de Shortlinks
> http://urlshortener.leo/api/v1/lista
<img src="https://i.imgur.com/B99gRB1.png" width="800">

### Criando uma shortlink via Api
> http://urlshortener.leo/api/v1/encurtar?link=https://google.com - Como não fornecemos parâmetros de shortlink e data de expiração, o sistema gerou automaticamente a url curta e definiu a data de expiração em 7 dias

<img src="https://i.imgur.com/hoZUnCo.png" width="800">

### Personalizando o shortlink

> http://urlshortener.leo/api/v1/encurtar?link=https://google.com&shortlink=gogole - Como não fornecemos data de expiração, o sistema definiu a data de expiração em 7 dias

<img src="https://i.imgur.com/we2eSE6.png" width="800">

### Definindo data de expiração/Todos os parâmetros

> http://urlshortener.leo/api/v1/encurtar?link=https://google.com&shortlink=googlebr&expire=10/10/2021 - Definimos a data de expiração para o dia 10/10/2021 escolhemos outro shortlink, porque o sistema não permite shortlinks duplicados.


<img src="https://i.imgur.com/kxHUp9Y.png" width="800">

### Criando um shortlink via post

<img src="https://i.imgur.com/IEjt1ZK.png" width="800">

## CLI Command

Adicione ao seu cronjob para limpar os shortlinks expirados todos os dias às 00:00

	 php artisan cronJob:CronJob 
> Remove todos os shortlinks expirados do banco de dados, ou seja, apaga todos os shortlinks com a data anterior a hoje.


<img src="https://i.imgur.com/IhaRF2v.png" width="800">

## Admin
Também é possível acessar e encurtar a url pelo admin, utilize o usuário demo http://urlshortener.leo/login será enviado um post para a aplicação e o sistema receberá um retorno json do shortlink

Tela encurtando Link

<img src="https://i.imgur.com/Rk34lcL.png" width="800">


Tela Lista de Urls - Listagem consumida via json /api/v1/lista

<img src="https://i.imgur.com/8QEmaYr.png" width="800">

## Cache

A listagem de shortlinks possuí um cache de 2 minutos, então, caso cadastre um novo shortlink, ele poderá demorar 2 minutos para aparecer na listagem, no entanto, seu funcionamento é instantâneo.

O redirect das urls também possuí cache.

Durante os testes, utilizei o redis, mas sinta-se a vontade para utilizar outro banco de cache ou até mesmo em arquivo.

