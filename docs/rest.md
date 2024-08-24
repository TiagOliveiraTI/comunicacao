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
                "close": "/accounts/12345/close",
            }
        }
    }
    ```