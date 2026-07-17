# Capital Empreendimentos

Sistema interno para gestão de empreendimentos imobiliários.

Monorepo com API Laravel (PHP) + frontend React (TypeScript) + PostgreSQL, executado via Docker.

## Requisitos

- Docker
- Docker Compose

Não é necessário instalar PHP, Composer, Node.js ou PostgreSQL na máquina local.

## Subir a aplicação

Na raiz do projeto:

```bash
docker compose up -d --build
```

Na primeira subida o container do backend já faz automaticamente:

- cria o `.env` do Laravel (se não existir)
- instala as dependências do Composer
- gera a `APP_KEY`
- roda as migrations
- popula o banco com dados de exemplo (se estiver vazio)

O frontend instala as dependências do npm e sobe o Vite.

Aguarde ~1–2 minutos na primeira vez e acesse:

| Recurso | URL |
|---------|-----|
| Frontend | http://localhost:5173 |
| Backend (API) | http://localhost:8000/api |
| Health da API (lista) | http://localhost:8000/api/enterprises |

Para acompanhar o bootstrap:

```bash
docker compose logs -f app
```

## Estrutura

```text
/
├── backend/          # API Laravel
├── frontend/         # Aplicação React + TypeScript (Vite)
├── docker/           # Dockerfile PHP, entrypoint e Nginx
├── docker-compose.yml
├── .env.example
└── README.md
```

## Configuração opcional

Os valores padrão já funcionam sem criar `.env`. Se quiser customizar portas ou banco:

```bash
cp .env.example .env
```

| Variável | Padrão | Descrição |
|----------|--------|-----------|
| `APP_PORT` | `8000` | Porta do backend (Nginx) |
| `FRONTEND_PORT` | `5173` | Porta do frontend (Vite) |
| `API_URL` | `http://localhost:8000/api` | URL da API usada pelo frontend |
| `DB_DATABASE` | `capital_db` | Nome do banco |
| `DB_USERNAME` | `capital_user` | Usuário do PostgreSQL |
| `DB_PASSWORD` | `capital_pass` | Senha do PostgreSQL |
| `DB_EXTERNAL_PORT` | `5432` | Porta do PostgreSQL no host |

## Serviços

| Serviço | Container | Função |
|---------|-----------|--------|
| `postgres` | `capital_postgres` | Banco PostgreSQL 16 |
| `app` | `capital_app` | PHP-FPM (Laravel) + bootstrap automático |
| `nginx` | `capital_nginx` | Proxy HTTP da API |
| `frontend` | `capital_frontend` | Vite (React) |

## API — endpoints principais

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/enterprises` | Lista (suporta `name`, `status`, `page`, `per_page`) |
| `GET` | `/api/enterprises/{id}` | Detalhe |
| `POST` | `/api/enterprises` | Cadastro |
| `PUT` | `/api/enterprises/{id}` | Atualização |
| `DELETE` | `/api/enterprises/{id}` | Exclusão |

Exemplos de filtros:

```text
GET /api/enterprises?name=Residencial
GET /api/enterprises?status=em_obras
GET /api/enterprises?name=Parque&status=em_lancamento&page=1&per_page=10
```

Status possíveis: `em_lancamento`, `em_obras`, `entregue`.

## Como testar a aplicação

1. Rode `docker compose up -d --build` e aguarde o bootstrap.
2. Acesse http://localhost:5173.
3. Na listagem, use a busca por nome e as abas de status.
4. Abra um empreendimento para ver os detalhes.
5. Cadastre um novo empreendimento pelo botão de criação.
6. Edite um registro existente.
7. Exclua um empreendimento e confirme a remoção na listagem.

Não há autenticação neste módulo — o acesso é aberto, conforme o escopo do desafio.

## Decisões técnicas

- **Monorepo simples**: backend e frontend no mesmo repositório para facilitar a avaliação e o setup.
- **Bootstrap no entrypoint**: `composer install`, `key:generate`, `migrate` e `seed` rodam ao subir o container `app`.
- **API REST com resource routes**: `apiResource` do Laravel para o CRUD padrão.
- **Validação em DTOs + regras de negócio no service**: entrada HTTP validada nos DTOs; regras numéricas (`gt:0`, quantidade mínima) reforçadas no service.
- **UUID como identificador**: evita exposição sequencial de IDs.
- **Status como string tipada**: valores estáveis na API (`em_lancamento`, `em_obras`, `entregue`) com labels em português no frontend.
- **React Query + Axios**: cache/invalidação da listagem e mutações sem gerenciar estado global manualmente.
- **Sem autenticação, cache distribuído, filas ou DDD completo**: fora do escopo pedido; a estrutura ficou deliberadamente enxuta para um primeiro módulo evolutivo.

## Comandos úteis

```bash
# Parar os containers
docker compose down

# Parar e remover o volume do banco
docker compose down -v

# Recriar o banco do zero
docker compose exec app php artisan migrate:fresh --seed

# Reinstalar dependências do frontend
docker compose exec frontend npm install
```

## Stack

- PHP 8.3 / Laravel
- React 19 / TypeScript / Vite
- PostgreSQL 16
- Docker / Docker Compose
- Nginx
