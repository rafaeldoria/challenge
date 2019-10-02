# Challenge
Projeto utilizando Laravel com API's para cadastro e consultas de eventos, relacionado a empresa Dito

### Tecnologias principais utilizadas
Laravel 6.0  
Docker 19.03.1  
Composer 1.9.0  

### Running the Containers
docker-compose up -d  

### Teste ambiente
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

### Criar usuário - Pegar token
Utilizar rota users -> post (criar usuário)  
Utilizar rota em auth - api/v1/auth_client -> post (pegar client_id e client_secret para acesso ao token)  
Utilizar rota em auth - oauth/token -> post (pegar acess_token do tipo Bearer)

### Authorization API's
Adicionar type 'Bearer Token' e adcionar o Token

### Npm instal
npm instal && npm run production