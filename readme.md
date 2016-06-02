## MoIP Subscriptions

### Introdução
**MoIP Assinaturas** (Pagamentos Recorrentes) é um produto da **[MoIP](http://moip.com.br)**.

A Presente biblioteca cliente visa facilitar a integração / implementação da API de Assinaturas em projetos PHP.

#### Sobre o Projeto
O Projeto utiliza o framework ActiveResource **[Restinga](https://github.com/artesaos/restinga)**.

#### Documentação Oficial
A documentação do pacote é uma cópia da documentação oficial, que pode ser encontra em [http://dev.moip.com.br/assinaturas-api/](http://dev.moip.com.br/assinaturas-api/)

#### Status do Projeto
Status atual da Cobertura do Pacote

| Endpoint                            | Progresso Implementação    | Progresso Documentação |
| ----------------------------------- | -------------------------- | ---------------------- |
| `coupons` (Cupons)                  | 100%                       | 100%                   |
| `plans` (Planos)                    | 100%                       | 0%                     |
| `customers` (Clientes)              | 100%                       | 0%                     |
| `subscriptions` (Assinaturas)       | 100%                       | 0%                     |
| `- invoices` (Faturas)              | 75%                        | 0%                     |
| `--- payments` (Pagamentos)         | 100%                       | 0%                     |
| `--- retries` (Re-rentativas)       | 0%                         | 0%                     |
| `users/preferences` (Preferências)  | 0%                         | 0%                     |


#### Conteúdo da Documentação
- [Primeiros Passos](#primeiros-passos)
 - [Instalação](#instalação) 
 - [Configuração](#configuração)
 - [Intruções Gerais](#instruções-gerais)
 - [Gerenciamento de Erros](#gerenciamento-de-erros)
- [Exemplos](#exemplos) 



### Primeiros Passos

#### Instalação
Para instalar a biblioteca **moip-subscriptions**, você deve utilizar o composer para incluí-la como dependência em seu projeto.

```
composer require artesaos/moip-subscriptions
```


#### Configuração

Após instalar a biblioteca, você precisará configurar seu token e chave da API, bem como indicar se as chamadas serão feitas no ambiente de produção ou não:


```php
use Artesaos\MoIPSubscriptions\MoIPSubscriptions;

$token = '0011001100110011001100110011';
$key = '10101010101010101010010101010101010';
$production = false;

// A chamada setCredentials recebe 3 parametros
// O Token da API, a Chave da API e a indicação de produção ou não (true/false)
MoIPSubscriptions::setCredentials($token, $key, $production);
```

#### Instruções Gerais:

Cada recurso / classe da API funciona praticamente da mesma forma, porem todos os métodos disponíveis estão (ou serão) documentados nesse manual.
Alguns métodos herdados da biblioteca Restinga como `$resource->destroy()` mesmo que disponíveis, não fazem efeito contra a API.


#### Gerenciamento de Erros

Para gerenciar os erros que a API poderá exibir, você pode utilizar o método `->hasErrors()` para descobrir se houve algum erro na requisição, e o método `->getErrors()` que por sua vêz tem métodos como `->first()` e `->all()`.

O exemplo a seguir de gerenciamento de erros é baseado na classe `Plan`, mas não se preocupe que essa classe ainda não está coberta, você só precisa entender o fluxo dos erros agora.

Vamos no exemplo tentar alterar um plano com valor negativo, o que já sabemos que a API não permite. Faremos isso apenas para demonstrar o tratamento de errors.

```php

use Artesaos\MoIPSubscriptions\Resources\Plan;

// Busca um Plano Já cadastrado com código 'plan123'
$plan = Plan::find('plan123');

// Configuramos um valor negativo no plano
$plan->amount = -2200;

// Se o plano não pode ser salvo
if(!$plan->save()) {
    // e se Existe alguma mensagem de erro disponível
    if ($plan->hasErrors()) {
        // Método 1: obter um array com as mensagens de erro
        $errors = $plan->getErrors()->all();
        // Método 2: obter apenas o primeiro erro (caso hajam mais de 1 erro)
        $error = $plan->getErrors()->first();
    }

}
```

### Exemplos