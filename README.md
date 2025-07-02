# 🎬 Cine Art: Catálogo de Filmes

Este repositório contém o código-fonte da aplicação **Cine Art**, um catálogo de filmes interativo que permite aos usuários explorar, pesquisar e gerenciar suas coleções de filmes favoritos. A aplicação é composta por um **backend robusto em Laravel** e um **frontend dinâmico em Vue.js**.

---

## ✨ Visão Geral do Projeto e Funcionalidades

O **Cine Art** oferece um conjunto de funcionalidades voltadas à experiência do usuário com um catálogo de filmes:

### 🔐 Autenticação de Usuário
- Funcionalidades essenciais de registro e login.

### 🔎 Busca de Filmes
- Pesquise filmes pelo nome.
- Integração com a API do **The Movie Database (TMDB)**.

### ⭐ Gerenciamento de Filmes Favoritos
- **Adicionar**: Marque filmes de interesse para sua lista de favoritos (armazenamento local).
- **Visualizar**: Tela dedicada para exibir sua lista de filmes favoritos.
- **Filtrar por Gênero**: Opção para refinar a lista de favoritos por gênero.
- **Remover**: Desmarque filmes da sua lista de favoritos.

---

## ⚙️ Tecnologias Utilizadas

### Backend
- **Laravel** – Framework PHP para construção da API.
- **MySQL** – Banco de dados relacional.

### Frontend
- **Vue.js 3** – Framework JavaScript para construção de SPA (Single Page Application).
- **Pinia** – Gerenciador de estado moderno para Vue.js.
- **Tailwind CSS** – Framework utilitário para estilização.

### Ambiente
- **Docker & Docker Compose** – Utilizados para containerização dos serviços e facilitar o setup.

---

## 🚀 Como Configurar e Executar Localmente com Docker

Siga os passos abaixo para iniciar a aplicação em seu ambiente de desenvolvimento local:

### 1. Clonar o Repositório

```bash

git clone https://github.com/seu-usuario/cine-art.git
cd cine-art
```

### 2. Configurar Variáveis de Ambiente

Crie uma cópia do arquivo .env.example e renomeie para .env:

```bash

cp .env.example .env
```

Em seguida, adicione as seguintes variáveis ao seu arquivo .env:

```bash

TMDB_API_KEY=a059759bf3f6ba22d716c439e05edd03
TMDB_API_BEARER=eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhMDU5NzU5YmYzZjZiYTIyZDcxNmM0MzllMDVlZGQwMyIsIm5iZiI6MTc1MTI5MTY3OC44OTEsInN1YiI6IjY4NjI5NzFlMjMzNGJmOGM2MDdiNGUyYiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ehn6UMcSQJT1hWR3ZRJd5nPNg6k5lGWkjOO2NUHJLAQ
TMDB_API_VERSION=3
TMDB_API_BASE_URL="https://api.themoviedb.org/${TMDB_API_VERSION}/"
```

### 3. Instalar as Dependências

Execute o comando:

```bash

make install
```

### 4. Rodar as Migrações do Banco de Dados

Execute o comando:

```bash

make migrate
```
---

## 📡 Documentação da API

Abaixo estão as principais rotas disponíveis na API para autenticação de usuários.

### 🔑 POST `/auth/login`

Realiza o login do usuário e retorna o token de autenticação JWT.

#### 📥 Body (JSON)

```json
{
  "email": "lucas@gmail.com",
  "password": "12345678"
}
```
#### 📤 Resposta (200 OK)

```json
{
    "success": true,
    "message": "Login realizado com sucesso!",
    "data": {
        "access_token": "5|WIG4ecBK8ovdnp4RGmgyB2KiDlBciCDiTDaACPXQd102a9a5",
        "user": {
            "id": 1,
            "name": "lucas",
            "email": "lucas@gmail.com",
            "email_verified_at": null,
            "created_at": "2025-07-01T00:47:10.000000Z",
            "updated_at": "2025-07-01T00:47:10.000000Z"
        }
    }
}
```

### 🔑 POST `/auth/register`

Realiza o cadastro de um novo usuário.

#### 📥 Body (JSON)

```json
{
    "name": "lucas",
    "email": "lucas@gmail.com",
    "password": "12345678"
}
```
#### 📤 Resposta (200 OK)

```json
{
    "success": true,
    "message": "Cadastro realizado com sucesso!",
    "data": {
        "name": "java",
        "email": "junior@gmail.com",
        "updated_at": "2025-07-02T14:36:43.000000Z",
        "created_at": "2025-07-02T14:36:43.000000Z",
        "id": 7
    }
}
```

### 🔑 GET `/movies/popular`

Lista os filmes populares.

#### 📤 Resposta (200 OK)

```json
{
    "page": 1,
    "results": [
        {
            "adult": false,
            "backdrop_path": "/uIpJPDNFoeX0TVml9smPrs9KUVx.jpg",
            "genre_ids": [
                27,
                9648
            ],
            "id": 574475,
            "original_language": "en",
            "original_title": "Final Destination Bloodlines",
            "overview": "Atormentada por um pesadelo violento recorrente, a estudante universitária Stefanie volta para casa para encontrar a única pessoa que pode quebrar o ciclo e salvar sua família do destino horrível que inevitavelmente os aguarda.",
            "popularity": 578.4099,
            "poster_path": "/niTRdfNCT29PXU9YpPPuISrBIw7.jpg",
            "release_date": "2025-05-14",
            "title": "Premonição 6: Laços de Sangue",
            "video": false,
            "vote_average": 7.185,
            "vote_count": 1430
        },
        {
            "adult": false,
            "backdrop_path": "/7Zx3wDG5bBtcfk8lcnCWDOLM4Y4.jpg",
            "genre_ids": [
                10751,
                878,
                35,
                12
            ],
            "id": 552524,
            "original_language": "en",
            "original_title": "Lilo & Stitch",
            "overview": "Stitch, um alienígena, chega ao planeta Terra após fugir de sua prisão e tenta se passar por um cachorro para se camuflar. As coisas mudam quando Lilo, uma travessa menina, o adota de um abrigo de animais. Juntos, eles aprendem os valores da amizade e família.",
            "popularity": 385.8026,
            "poster_path": "/bLQN6DUNYN4NVzSY3Q53JwBRlgV.jpg",
            "release_date": "2025-05-17",
            "title": "Lilo & Stitch",
            "video": false,
            "vote_average": 7.093,
            "vote_count": 761
        }
    ]
}
```

### 🔑 GET `/movies/top_rated`

Lista os melhores avaliados.

#### 📤 Resposta (200 OK)

```json
{
    "page": 1,
    "results": [
        {
            "adult": false,
            "backdrop_path": "/zfbjgQE1uSd9wiPTX4VzsLi0rGG.jpg",
            "genre_ids": [
                18,
                80
            ],
            "id": 278,
            "original_language": "en",
            "original_title": "The Shawshank Redemption",
            "overview": "Em 1946, Andy Dufresne, um banqueiro jovem e bem sucedido, tem a sua vida radicalmente modificada ao ser condenado por um crime que nunca cometeu, o homicídio de sua esposa e do amante dela. Ele é mandado para uma prisão que é o pesadelo de qualquer detento, a Penitenciária Estadual de Shawshank, no Maine. Lá ele irá cumprir a pena perpétua. Andy logo será apresentado a Warden Norton, o corrupto e cruel agente penitenciário, que usa a Bíblia como arma de controle e ao Capitão Byron Hadley que trata os internos como animais. Andy faz amizade com Ellis Boyd Redding, um prisioneiro que cumpre pena há 20 anos e controla o mercado negro da instituição.",
            "popularity": 26.2504,
            "poster_path": "/xSnM4ahmz692msbMTBsfBWHvR3M.jpg",
            "release_date": "1994-09-23",
            "title": "Um Sonho de Liberdade",
            "video": false,
            "vote_average": 8.712,
            "vote_count": 28487
        },
        {
            "adult": false,
            "backdrop_path": "/tmU7GeKVybMWFButWEGl2M4GeiP.jpg",
            "genre_ids": [
                18,
                80
            ],
            "id": 238,
            "original_language": "en",
            "original_title": "The Godfather",
            "overview": "Em 1945, Don Corleone é o chefe de uma mafiosa família italiana de Nova York. Ele costuma apadrinhar várias pessoas, realizando importantes favores para elas, em troca de favores futuros. Com a chegada das drogas, as famílias começam uma disputa pelo promissor mercado. Quando Corleone se recusa a facilitar a entrada dos narcóticos na cidade, não oferecendo ajuda política e policial, sua família começa a sofrer atentados para que mudem de posição. É nessa complicada época que Michael, um herói de guerra nunca envolvido nos negócios da família, vê a necessidade de proteger o seu pai e tudo o que ele construiu ao longo dos anos.",
            "popularity": 28.2944,
            "poster_path": "/uP46DujkD3nwcisOjz9a0Xw0Knj.jpg",
            "release_date": "1972-03-14",
            "title": "O Poderoso Chefão",
            "video": false,
            "vote_average": 8.687,
            "vote_count": 21577
        }
    ]
}
```

### 🔍 GET `/movies/search`

Realiza uma busca de filmes pelo título.

#### 📥 Query Params

| Parâmetro | Tipo   | Obrigatório | Descrição                                     |
|-----------|--------|-------------|-----------------------------------------------|
| `query`   | string | Sim         | Título ou parte do título do filme a pesquisar |

#### 🧪 Exemplo de requisição

`/movies/search?query=batman`


#### 📤 Resposta (200 OK)

```json
{
    "page": 1,
    "results": [
        {
            "adult": false,
            "backdrop_path": null,
            "genre_ids": [18],
            "id": 558083,
            "original_language": "fr",
            "original_title": "Testet",
            "overview": "Inga takes a pregnancy test in the morning in her apartment and places it on the breakfast table...",
            "popularity": 0.2161,
            "poster_path": "/klFNmoEwvAhqJ6F7tszFrPqOX8r.jpg",
            "release_date": "1987-03-28",
            "title": "Testet",
            "video": false,
            "vote_average": 0,
            "vote_count": 0
        }
    ],
    "total_pages": 1,
    "total_results": 1
}
```

### 🔑 POST `/user/$userId/favorite-movie`

Adiciona um filme aos favoritos.

#### 📥 Body (JSON)

```json
{
    "movie_id": 1,
    "movie_details": {
        "adult": false,
        "backdrop_path": "/7Zx3wDG5bBtcfk8lcnCWDOLM4Y4.jpg",
        "genre_ids": [
            10751,
            878,
            35,
            12
        ],
        "id": 552524,
        "original_language": "en",
        "original_title": "Lilo & Stitch",
        "overview": "Stitch, um alienígena, chega ao planeta Terra após fugir de sua prisão e tenta se passar por um cachorro para se camuflar...",
        "popularity": 385.8026,
        "poster_path": "/bLQN6DUNYN4NVzSY3Q53JwBRlgV.jpg",
        "release_date": "2025-05-17",
        "title": "Lilo & Stitch",
        "video": false,
        "vote_average": 7.093,
        "vote_count": 761
    }
}
```
#### 📤 Resposta (200 OK)

```json
{
    "success": true,
    "message": "Filme registrado como favorito",
    "data": {
        "movie_id": 1,
        "user_id": 1,
        "movie_details": "{\"adult\":false,\"backdrop_path\":\"\\/7Zx3wDG5bBtcfk8lcnCWDOLM4Y4.jpg\",\"genre_ids\":[10751,878,35,12],\"id\":552524,\"original_language\":\"en\",\"original_title\":\"Lilo & Stitch\",\"overview\":\"Stitch, um alien\\u00edgena, chega ao planeta Terra ap\\u00f3s fugir de sua pris\\u00e3o e tenta se passar por um cachorro para se camuflar...\",\"popularity\":385.8026,\"poster_path\":\"\\/bLQN6DUNYN4NVzSY3Q53JwBRlgV.jpg\",\"release_date\":\"2025-05-17\",\"title\":\"Lilo & Stitch\",\"video\":false,\"vote_average\":7.093,\"vote_count\":761}",
        "updated_at": "2025-07-02T03:59:16.000000Z",
        "created_at": "2025-07-02T03:59:16.000000Z",
        "id": 50
    }
}
```

### 🔑 POST `/user/$userId/remove-favorite`

Remove um filme dos favoritos.

#### 📥 Body (JSON)

```json
{
    "movie_id": 1
}
```
#### 📤 Resposta (200 OK)

```json
{
    "success": true,
    "message": "Filme removido como favorito"
}
```

### 🔍 GET `/user/$userId/list-favorites`

Lista os filmes favoritados e filtra por gênero.

#### 📥 Query Params

| Parâmetro   | Tipo   | Obrigatório | Descrição    |
|-------------|--------|-------------|--------------|
| `genre_ids` | string | Não         | Id do gênero |

#### 🧪 Exemplo de requisição

`/user/1/list-favorites?genre_ids=9648,878`


#### 📤 Resposta (200 OK)

```json
{
    "success": true,
    "message": "Requisição processada com sucesso.",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "movie_id": 2,
            "created_at": null,
            "updated_at": null,
            "movie_details": {
                "id": 574475,
                "adult": false,
                "title": "Premonição 6: Laços de Sangue",
                "video": false,
                "overview": "Atormentada por um pesadelo violento recorrente, a estudante universitária Stefanie volta para casa para encontrar a única pessoa que pode quebrar o ciclo e salvar sua família do destino horrível que inevitavelmente os aguarda.",
                "genre_ids": [
                    27,
                    9648
                ],
                "popularity": 578.4099,
                "vote_count": 1417,
                "poster_path": "/niTRdfNCT29PXU9YpPPuISrBIw7.jpg",
                "release_date": "2025-05-14",
                "vote_average": 7.194,
                "backdrop_path": "/uIpJPDNFoeX0TVml9smPrs9KUVx.jpg",
                "original_title": "Final Destination Bloodlines",
                "original_language": "en"
            }
        },
        {
            "id": 4,
            "user_id": 1,
            "movie_id": 1,
            "created_at": "2025-07-01 21:10:26.000000",
            "updated_at": "2025-07-01 21:10:26.000000",
            "movie_details": {
                "id": 552524,
                "adult": false,
                "title": "Lilo & Stitch",
                "video": false,
                "overview": "Stitch, um alienígena, chega ao planeta Terra após fugir de sua prisão e tenta se passar por um cachorro para se camuflar...",
                "genre_ids": [
                    10751,
                    878,
                    35,
                    12
                ],
                "popularity": 385.8026,
                "vote_count": 761,
                "poster_path": "/bLQN6DUNYN4NVzSY3Q53JwBRlgV.jpg",
                "release_date": "2025-05-17",
                "vote_average": 7.093,
                "backdrop_path": "/7Zx3wDG5bBtcfk8lcnCWDOLM4Y4.jpg",
                "original_title": "Lilo & Stitch",
                "original_language": "en"
            }
        }
    ]
}
```

### 🔑 GET `/genres`

Lista os gêneros dos filmes.

#### 📤 Resposta (200 OK)

```json
{
    "genres": [
        {
            "id": 28,
            "name": "Ação"
        },
        {
            "id": 12,
            "name": "Aventura"
        },
        {
            "id": 16,
            "name": "Animação"
        },
        {
            "id": 35,
            "name": "Comédia"
        },
        {
            "id": 80,
            "name": "Crime"
        },
        {
            "id": 99,
            "name": "Documentário"
        },
        {
            "id": 18,
            "name": "Drama"
        },
        {
            "id": 10751,
            "name": "Família"
        },
        {
            "id": 14,
            "name": "Fantasia"
        },
        {
            "id": 36,
            "name": "História"
        },
        {
            "id": 27,
            "name": "Terror"
        },
        {
            "id": 10402,
            "name": "Música"
        },
        {
            "id": 9648,
            "name": "Mistério"
        },
        {
            "id": 10749,
            "name": "Romance"
        },
        {
            "id": 878,
            "name": "Ficção científica"
        },
        {
            "id": 10770,
            "name": "Cinema TV"
        },
        {
            "id": 53,
            "name": "Thriller"
        },
        {
            "id": 10752,
            "name": "Guerra"
        },
        {
            "id": 37,
            "name": "Faroeste"
        }
    ]
}
```
