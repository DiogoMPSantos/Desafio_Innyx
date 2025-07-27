# 🛍️ Laravel API - Produtos e Categorias

API RESTful desenvolvida com Laravel, utilizando autenticação via Sanctum. O projeto é containerizado com Docker e já inclui migrations e seeders para facilitar a inicialização.

---

## 🚀 Tecnologias

- PHP 8.1
- Laravel 11
- Sanctum (autenticação)
- MySQL
- Docker + Docker Compose
- Vue.js (em desenvolvimento - frontend)

---

## ⚙️ Requisitos

- Docker
- Docker Compose

---

## 🧑‍💻 Como executar

1. Clone este repositório:

```bash
git clone https://github.com/DiogoMPSantos/Desafio_Innyx
cd seu-repo
```

2. Crie o arquivo `.env`:

```bash
cp .env.example .env
```

Antes de subir os containers, configure as variáveis de ambiente no arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

3. Suba os containers:

```bash
docker-compose up -d
```

4. Acesse o container Laravel e rode as migrations + seeders:

```bash
docker exec -it laravel-api bash
php artisan migrate --seed
```

---

## 🔐 Autenticação

A autenticação é feita via Laravel Sanctum.

- Rota pública para registro: `POST /api/auth/register`
- Rota pública para login: `POST /api/auth/login`
- Demais rotas protegidas com `auth:sanctum`

---

## 📦 Endpoints principais

- `POST /api/auth/register` — Cadastro de usuário
- `POST /api/auth/login` — Login do usuário
- `GET /api/auth/me` — Perfil autenticado
- `POST /api/auth/logout` — Logout

### Recursos protegidos:

#### 📦 Categorias

- `GET /api/categorias` — Listar todas as categorias
- `POST /api/categorias` — Cadastrar nova categoria
- `GET /api/categorias/{id}` — Visualizar uma categoria
- `PUT /api/categorias/{id}` — Atualizar uma categoria
- `DELETE /api/categorias/{id}` — Deletar uma categoria

#### 🛒 Produtos

- `GET /api/produtos` — Listar todos os produtos
- `POST /api/produtos` — Cadastrar novo produto
- `GET /api/produtos/{id}` — Visualizar um produto
- `PUT /api/produtos/{id}` — Atualizar um produto
- `DELETE /api/produtos/{id}` — Deletar um produto
- `GET /api/produtos/search/{termo}` — Buscar produtos por nome ou descrição

---

## 🧪 Dados de teste

Ao executar `php artisan migrate --seed`, serão inseridos:

- ✅ Usuário inicial:
  - **Email**: `admin@example.com`
  - **Senha**: `password123`

- ✅ Categorias e produtos de exemplo com imagens falsas.

---

## 📝 Observações

- O projeto está pronto para rodar com `docker-compose up -d` sem necessidade de setup manual.
- As imagens dos produtos são salvas com nomes únicos no disco e acessíveis via storage público.
- O diretório `/storage` está com permissões ajustadas no `entrypoint.sh`.


## 👨‍💻 Autor

Desenvolvido por [Diogo Santos](https://github.com/DiogoMPSantos)