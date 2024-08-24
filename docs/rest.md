[Voltar](../README.MD)

# REST

## Algumas coisas sobre:
* Na teoria, muitos devs sabem trabalhar
* Significa Representational State of Transfer
* Surgiu em 2000 por Roy Fielding em uma dissertação de doutorado
* Simplicidade
* Stateless (Por isso a necessidade passar tokens, o server não é obrigado a saber quem é voce, cada requisição é uma requisição diferente)
* Cacheável

## REST: Níveis de maturidade (Richardson Maturity Model)
* <b>Nível 0: The Swamp of POX</b>
    * Quando não tem uma "padronização"
    * Usa normalmente o RPC - Remote Procedure Call

* <b>Nível 1: Utilização de Resources</b>

    | Verbo | Uri | Operação |
    | --- | --- | --- |
    | GET | /products/1 | Buscar |
    | POST | /products | Inserir |
    | PUT | /products/1 | Alterar |
    | DELETE | /products/1 | Remover |

* <b>Nível 2: Verbos HTTP</b>

    | Verbo | Utilização |
    | --- | --- |
    | GET | Recuperar Informação |
    | POST | Inserir |
    | PUT | Alterar |
    | DELETE | Remover |

* <b>Nível 3: HATEOAS: Hypermedia As The Engine Of Application State</b>
    ```json
    HTTP/1.1 200 OK
    Content-Type: application/vnd.acme.account+json
    Content-Length: ...
    {
        "account": {
            "account_number": 12345,
            "balance": {
                "currency": "usd",
                "value": 100.00
            },
            "links": {
                "deposity": "/accounts/12345/deposity",
                "withdraw": "/accounts/12345/withdraw",
                "transfer": "/accounts/12345/transfer",
                "close": "/accounts/12345/close"
            }
        }
    }
    ```

## REST: Uma boa API REST
* Utiliza URIs únicas para serviços e itens expostos para esses serviços
* Utiliza todos os verbos HTTP para realizar as operações em seus recursos, incluindo
* Provê links relacionais para os recursos exemplificando o que pode ser feito

## REST: HAL, Collection+JSON e Siren
* JSON não provê um padrão de hipermidia para realizar a linkagem
* HAL: Hypermedia Application Language
    ```json
    HTTP/1.1 200 OK
    Content-Type: application/hal+json
    Content-Length: ...
    {
        "_links": {
            "self": {
                "href": "https://otao.dev.br/api/users/tiago",
            }
        },
        "id": "1qaz-2wsx-3edc",
        "name": "Tiago Oliveira",
        "_embedded": {
            "family": [
                {
                    "_links": {
                        "self": {
                            "href": "https://otao.dev.br/api/users/arielle",
                        }
                    },
                    "id": "1qaz-2wsx-3edc",
                    "name": "Arielle",
                }
            ]
        },
    }
    ```
## REST: HTTP Method Negotiation
HTTP possui um outro método: OPTIONS. Esse método nos permite informar quais métodos são permitidos ou não em determinado recurso.

```http
    OPTIONS /api/product HTTP/1.1
    Host: otao.dev.br
```

A resposta pode ser
```http
    HTTP/1.1 200 OK
    Allow: GET, POST
```

Caso envie a requisição em outro formato:
```http
    HTTP/1.1 405 Not Allowed
    Allow: GET, POST
```

## REST: Content Negotiation
O processo de content necgotiation é baseado na requisição que o client está fazendo para o server. Nesse caso, ele soliicita o que e como ele quer a resposta. O server então retornará ou não a informação no formato.

### Accept Negotiation
 * Client solicita a informação e o tipo de retorno pelo server baseado no media type informado informado por ordem de prioridade

    ```
    GET /products
    Accept: application/json
    ```
    Resposta pode ser o retorno dos dados ou:
    ```
    HTTP/1.1 406 Not Acceptable
    ```
### Content-Type Negotiation
 * Através de um content-type no header da request, o servidor consegue verificar se ele irá conseguir processar a informação desejada

     ```json
    POST /products HTTP/1.1
    Accept: application/json
    Content-Type: application/json
    {
        "nama": "Product 1"
    }
    ```
    Caso o servidor não aceite o content type, ele poderá retornar:
    ```
    HTTP/1.1 415 Unsupported Media Type
    ```