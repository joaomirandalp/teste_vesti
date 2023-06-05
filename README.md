# Nome do Projeto

Teste técnico da Vesti

## Descrição

Hub com objetivo de intermediar o consumo de api's de sistemas ERP's e inserir os dados nas api's da Vesti.

## Pré-requisitos

- PHP 8.1.4
- Laravel 10

## Instalação e uso local

1. Clone o repositório: `git clone https://github.com/joaomirandalp/teste_vesti.git`
2. Navegue até o diretório do projeto: `cd teste_vesti`
3. Instale as dependências do Composer: `composer install`
4. Copie o arquivo .env.example para .env: `cp .env.example .env`
5. Configure o arquivo .env com as informações do seu ambiente
6. Inicie o servidor local: `php artisan serve`

Após iniciar o servidor local, acesse a rota base para produtos 'https://url_local/produtos'.

## Instalação e uso com docker

1. Clone o repositório: `git clone https://github.com/joaomirandalp/teste_vesti.git`
2. Navegue até o diretório do projeto: `cd teste_vesti`
3. Execute o comando `docker-compose up --build`

Após iniciar o container docker, acesse a rota base para produtos 'https://url_local/produtos'.

## Autor

João Pedro Souza Miranda
