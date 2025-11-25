# Ambiente de Desenvolvimento PHP com Docker

Este projeto fornece um ambiente completo de desenvolvimento PHP usando Docker, incluindo PHP-FPM, Nginx, MySQL e phpMyAdmin.

## Requisitos

- Docker
- Docker Compose

## Estrutura do Projeto

```
dev_php/
├── docker-compose.yml    # Configuração dos serviços Docker
├── Dockerfile            # Imagem PHP personalizada
├── nginx.conf            # Configuração do Nginx
├── php.ini               # Configuração do PHP
├── .dockerignore         # Arquivos ignorados pelo Docker
└── src/                  # Diretório do código fonte PHP
    └── index.php
```

## Serviços Disponíveis

- **PHP 8.2-FPM**: Servidor PHP na porta 9000 (interno)
- **Nginx**: Servidor web na porta 8080
- **MySQL 8.0**: Banco de dados na porta 3306
- **phpMyAdmin**: Interface web para MySQL na porta 8081

## Credenciais do Banco de Dados

- **Host**: mysql (dentro do Docker) ou localhost (do host)
- **Porta**: 3306
- **Usuário root**: root
- **Senha root**: root
- **Usuário dev**: dev_user
- **Senha dev**: dev_password
- **Database**: dev_db

## Como Usar

### 1. Iniciar o ambiente

```bash
docker-compose up -d
```

### 2. Acessar a aplicação

- **Aplicação PHP**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

### 3. Parar o ambiente

```bash
docker-compose down
```

### 4. Parar e remover volumes (limpar dados do MySQL)

```bash
docker-compose down -v
```

### 5. Ver logs

```bash
docker-compose logs -f
```

### 6. Executar comandos no container PHP

```bash
docker-compose exec php bash
```

### 7. Instalar dependências com Composer

```bash
docker-compose exec php composer install
```

## Desenvolvimento

Coloque seus arquivos PHP no diretório `src/`. As alterações são refletidas automaticamente sem precisar reconstruir os containers.

## Extensões PHP Instaladas

- pdo_mysql
- mbstring
- exif
- pcntl
- bcmath
- gd
- zip

## Personalização

- Edite `php.ini` para alterar configurações do PHP
- Edite `nginx.conf` para alterar configurações do Nginx
- Edite `docker-compose.yml` para adicionar novos serviços ou alterar portas

