# COMUNICAÇÃO

[Rest](docs/rest.md)

## Testando a api

```http
GET http://localhost:8080/users
Accept: application/json
```

## Criando usuario
```http
POST http://localhost:8080/users
Content-Type: application/json
Accept: application/json

{
    "id": 1,
    "name": "Tiago",
    "email": "contato@otao.dev.br"
}
```

```http
GET http://localhost:8080/users/1
Accept: application/json
```

[GraphQl](docs/graphql.md)