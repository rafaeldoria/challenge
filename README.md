# Challenge
Projeto utilizando Laravel com API's para cadastro e consultas de eventos, relacionado a empresa Dito

### Tecnologias principais utilizadas
Laravel 6.0  
Docker 19.03.1  
Composer 1.9.0  

### Running the Containers
docker-compose up -d  

### Teste ambiente
composer install
cp .env.example .env
docker-compose exec app php artisan key:generate  
docker-compose exec app php artisan config:cache  
Acessar localhost

### Criar usuário MySql
docker-compose exec db bash  
mysql -u root -p  
GRANT ALL ON challenge.* TO 'ditouser'@'%' IDENTIFIED BY 'asdfgh';  
FLUSH PRIVILEGES;  

### Criar tabelas no banco
docker-compose exec app php artisan migrate  

### Instalar passport
docker-compose exec app php artisan passport:install

## Utilização API's
### Criar usuário - Pegar token
Utilizar rota users -> post (criar usuário)  
Utilizar rota em auth - api/v1/auth_client -> post (pegar client_id e client_secret para acesso ao token)  
Utilizar rota em auth - oauth/token -> post (pegar acess_token do tipo Bearer)

### Authorization API's
Adicionar type 'Bearer Token' e adicionar o Token

## Utilização projeto
### Npm instal
npm instal && npm run production

### Inserir dados table events
docker-compose exec app php artisan db:seed

## Documentação API/Postman
https://web.postman.co/collections/2773038-8a1fb8b9-9cb2-4584-879f-3282fe8c0f67?version=latest&workspace=73b43a44-1ef9-42f0-81dd-7f7fb845c8c2
link collection: https://www.getpostman.com/collections/feb908f5dac47dd925e6