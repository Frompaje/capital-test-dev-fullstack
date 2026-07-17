# Capital Empreendimentos

Sistema interno para gestão de empreendimentos imobiliários.

Monorepo com API Laravel (PHP) + frontend React (TypeScript) + PostgreSQL, executado via Docker.

## Requisitos

- [Docker](https://docs.docker.com/get-docker/) e Docker Compose instalados
- [Git](https://git-scm.com/) instalado (para clonar o repositório)

## Como clonar e iniciar o projeto

1. Clone o repositório:

```bash
git clone git@github.com:Frompaje/capital-test-dev-fullstack.git
```

1. Entre na pasta do projeto:

```bash
cd capital-test-dev-fullstack
```

1. Suba a aplicação com Docker:

```bash
docker compose up -d --build
```

Na primeira subida o bootstrap já cria o `.env` do Laravel, instala dependências, gera a `APP_KEY`, roda migrations e seeders. Aguarde ~1–2 minutos e acesse:


| Recurso  | URL                                                    |
| -------- | ------------------------------------------------------ |
| Frontend | [http://localhost:5173](http://localhost:5173)         |
| Backend  | [http://localhost:8000/api](http://localhost:8000/api) |


Detalhes de `.env`, reinstalação manual, migrations e seeders estão na seção **Setup técnico** abaixo.

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

## Setup técnico

### Como configurar o arquivo `.env`

Na raiz do projeto, os valores padrão do `docker-compose.yml` já funcionam sem criar `.env`. Para customizar portas ou banco:

```bash
cp .env.example .env
```

Variáveis disponíveis no `.env` da raiz:


| Variável           | Padrão                      | Descrição                      |
| ------------------ | --------------------------- | ------------------------------ |
| `APP_PORT`         | `8000`                      | Porta do backend (Nginx)       |
| `FRONTEND_PORT`    | `5173`                      | Porta do frontend (Vite)       |
| `API_URL`          | `http://localhost:8000/api` | URL da API usada pelo frontend |
| `DB_DATABASE`      | `capital_db`                | Nome do banco                  |
| `DB_USERNAME`      | `capital_user`              | Usuário do PostgreSQL          |
| `DB_PASSWORD`      | `capital_pass`              | Senha do PostgreSQL            |
| `DB_EXTERNAL_PORT` | `5432`                      | Porta do PostgreSQL no host    |


O `.env` do Laravel (`backend/.env`) é criado automaticamente pelo entrypoint a partir de `backend/.env.example` na primeira subida, se ainda não existir. Também é gerada a `APP_KEY` quando estiver vazia.

### Como iniciar os containers Docker

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


| Recurso               | URL                                                                            |
| --------------------- | ------------------------------------------------------------------------------ |
| Frontend              | [http://localhost:5173](http://localhost:5173)                                 |
| Backend (API)         | [http://localhost:8000/api](http://localhost:8000/api)                         |
| Health da API (lista) | [http://localhost:8000/api/enterprises](http://localhost:8000/api/enterprises) |


Para acompanhar o bootstrap:

```bash
docker compose logs -f app
```

### Como instalar as dependências

Na primeira subida isso já roda sozinho. Para reinstalar manualmente:

```bash
# Backend (Composer)
docker compose exec app composer install --no-interaction --prefer-dist --optimize-autoloader

# Frontend (npm)
docker compose exec frontend npm install
```

### Como executar as migrations

Na primeira subida as migrations já rodam via entrypoint. Para executar manualmente:

```bash
docker compose exec app php artisan migrate --force
```

Para recriar o banco do zero (apaga os dados e aplica as migrations novamente):

```bash
docker compose exec app php artisan migrate:fresh
```

### Como executar os seeders

Na primeira subida o seeder roda automaticamente se a tabela de empreendimentos estiver vazia. Para executar manualmente:

```bash
docker compose exec app php artisan db:seed --force
```

Para recriar o banco e já popular com os dados de exemplo:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

## Serviços


| Serviço    | Container          | Função                                   |
| ---------- | ------------------ | ---------------------------------------- |
| `postgres` | `capital_postgres` | Banco PostgreSQL 16                      |
| `app`      | `capital_app`      | PHP-FPM (Laravel) + bootstrap automático |
| `nginx`    | `capital_nginx`    | Proxy HTTP da API                        |
| `frontend` | `capital_frontend` | Vite (React)                             |


## API — endpoints principais


| Método   | Endpoint                | Descrição                                            |
| -------- | ----------------------- | ---------------------------------------------------- |
| `GET`    | `/api/enterprises`      | Lista (suporta `name`, `status`, `page`, `per_page`) |
| `GET`    | `/api/enterprises/{id}` | Detalhe                                              |
| `POST`   | `/api/enterprises`      | Cadastro                                             |
| `PUT`    | `/api/enterprises/{id}` | Atualização                                          |
| `DELETE` | `/api/enterprises/{id}` | Exclusão                                             |


Status possíveis: `em_lancamento`, `em_obras`, `entregue`.

### URLs e bodies (Postman)

Base: `http://localhost:8000/api`

#### Listar — `GET`

```text
http://localhost:8000/api/enterprises
http://localhost:8000/api/enterprises?name=Residencial
http://localhost:8000/api/enterprises?status=em_obras
http://localhost:8000/api/enterprises?name=Parque&status=em_lancamento&page=1&per_page=10
```

#### Detalhe — `GET`

```text
http://localhost:8000/api/enterprises/{id}
```

#### Cadastrar — `POST`

```text
http://localhost:8000/api/enterprises
```

```json
{
  "name": "Residencial Aurora",
  "city": "São Paulo",
  "state": "SP",
  "total_value": 15000000,
  "units_quantity": 60,
  "unit_value": 250000,
  "status": "em_lancamento"
}
```

#### Atualizar — `PUT`

```text
http://localhost:8000/api/enterprises/{id}
```

```json
{
  "name": "Residencial Aurora Atualizado",
  "city": "Campinas",
  "state": "SP",
  "total_value": 18000000,
  "units_quantity": 72,
  "unit_value": 250000,
  "status": "em_obras"
}
```

#### Excluir — `DELETE`

```text
http://localhost:8000/api/enterprises/{id}
```

## Como testar a aplicação

1. Rode `docker compose up -d --build` e aguarde o bootstrap.
2. Acesse [http://localhost:5173](http://localhost:5173).
3. Na listagem, use a busca por nome e as abas de status.
4. Abra um empreendimento para ver os detalhes.
5. Cadastre um novo empreendimento pelo botão de criação.
6. Edite um registro existente.
7. Exclua um empreendimento e confirme a remoção na listagem.

Não há autenticação neste módulo — o acesso é aberto, conforme o escopo do desafio.

## Decisões técnicas

### Infra e organização

- **Monorepo simples**: backend e frontend no mesmo repositório para facilitar a avaliação e o setup.
- **Bootstrap no entrypoint**: `composer install`, `key:generate`, `migrate` e `seed` rodam ao subir o container `app`.
- **API REST com resource routes**: `apiResource` do Laravel para o CRUD padrão.
- **UUID como identificador**: evita exposição sequencial de IDs.
- **Status como string tipada**: valores estáveis na API (`em_lancamento`, `em_obras`, `entregue`) com labels em português no frontend.
- **Defaults hardcoded no Compose (ambiente de teste)**: senha do banco, portas e URL da API têm valores padrão no `docker-compose.yml` para o avaliador subir com um único comando, sem criar `.env`. Em produto real, esses valores seriam obrigatoriamente via `.env`/secrets — o `.env` nunca iria para o versionamento.

### Stack do frontend

- **axios**: instância única em `frontend/src/lib/axios.ts` com `VITE_API_URL` e headers JSON; os services usam essa base e o React Query orquestra cache/mutações.
- **react-hook-form + zod**: schema (`enterpriseFormSchema`) via `zodResolver` tipa o form e valida formato no cliente; erros de domínio do servidor (422) são mapeados nos mesmos campos.
- **react-router-dom**: rotas de listagem/detalhe/edição e filtros da listagem em query params (`useSearchParams`), não só em `useState`.
- **Tailwind + shadcn/ui**: layout utilitário + primitives acessíveis; componentes de domínio (listagem, filtros, modais) compostam esses primitives.
- **React Query + Axios**: cache/invalidação da listagem e mutações sem estado global manual.

### Busca por nome com debounce

Sem debounce, cada tecla atualizaria a URL e dispararia um request (“R”, “Re”, “Res”…), gerando carga, race conditions e flicker.

### Paginação

A paginação foi implementada mostrando os valores numéricos das páginas diretamente na UI, não só os botões de avançar/voltar — o usuário vê 1 2 3 4 5 e pode clicar direto na página que quer, sem precisar navegar sequencialmente uma por uma.

### URL como estado (query params)

Benefícios: link compartilhável (`/?name=Residencial&status=em_obras&page=2`), histórico do navegador e refresh mantêm o contexto. Mudança de `name` ou `status` remove `page`, evitando página inválida após filtrar.

### Validações de negócio (nome duplicado)

- **Cliente (Zod)**: presença, tamanho, UF, números `gt(0)` / `min(1)` e enum de status — feedback imediato de formato. Não valida unicidade de nome no Zod (exigiria hit na API a cada digitação).
- **Servidor (DTO Laravel)**: `unique:enterprises,name` no store/update; responde **422** com `{ message, errors }`.
- **Formulário**: `applyServerErrors` cola o 422 no campo `name` via `setError`. Se houver erros de campo, não dispara toast — o feedback fica no form.

### Prototipagem de UI com Lovable

O layout inicial foi prototipado com Lovable como referência visual. A implementação versionada é React (Vite + Tailwind + shadcn), adaptada — não o export bruto do prototipador.
link - [https://lovable.dev/preview/e5ToRKmYntDnBZy2SP2V2u95nALv9lfQ](https://lovable.dev/preview/e5ToRKmYntDnBZy2SP2V2u95nALv9lfQ)

### Toasts (sonner)

Create/update/delete usam `toast.success` / `toast.error` + invalidação do React Query. Erro 422 com campos não gera toast — o formulário mostra o erro no campo. Preferível a `alert()` porque não bloqueia a UI.

### Responsividade

- **Formulário**: `grid-cols-1` → `sm:grid-cols-2`.
- **Filtro**: `flex flex-wrap` para busca e abas empilharem em viewports menores.
- **Tabela**: `table-fixed` + `colgroup` com larguras percentuais + `truncate` nas células; scroll horizontal quando necessário.

### Traits (Laravel)

`ValidatesEnterpriseRules` reutiliza regras numéricas (`total_value > 0`, `units_quantity >= 1`, `unit_value > 0`) no `EnterpriseService`, reforçando o DTO HTTP sem herança forçada entre services.

### DTOs

Controllers não passam `$request->all()` ao service. DTOs `final readonly` (`StoreEnterpriseDto`, `UpdateEnterpriseDto`, `ListEnterpriseDto`, `EnterpriseResponseDto`) validam na construção (`fromArray`) e tipam o contrato por camada. Fluxo do store: Controller → DTO → Service → Eloquent → `EnterpriseResponseDto`.

### Por que não usamos Repository Pattern

Não utilizamos Repository pelo fato de o próprio framework já fornecer os Query Scopes. Também não usamos interface no Repository, pois não há necessidade de trocar de ORM — o intuito de usar um framework opinado como o Laravel é justamente aproveitar o que ele já fornece.

### Interfaces

`EnterpriseServiceInterface` define o contrato; `EnterpriseService` implementa; binding no `AppServiceProvider`. O controller injeta a interface (Dependency Inversion), facilitando mock em testes e deixando o contrato público explícito.

### Evolução modular

Se o produto crescesse, o próximo passo arquitetural seria organizar o projeto por módulos de domínio, ao invés de uma estrutura única com todos os Controllers e Services misturados.
Exemplo: um módulo user conteria seu próprio Controller, Service, Interface (contrato do Service) e Traits, isolado do módulo enterprise, que seguiria a mesma estrutura. Isso facilita escalar o time por domínio, isolar testes por módulo, e evita que uma pasta única vire um emaranhado de arquivos sem relação clara entre si.

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

