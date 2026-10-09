# H+Checkount Onboarding

Esse plugin foi construído em PHP para a realização de ações na SmartPOS como um TEF via API Hubmais.
Aqui vamos mostrar como é facil a instalação e utilização.

## Requisitos

* php (versão 7.2 ou >=8.2)
* composer (mais recente)


## Instalação

O plugin pode ser adicionado a seu projeto com o comando abaixo:

```shell
composer require hubmais/h-checkout-onboarding
```

## Laravel

Esse plugin pode ser usado em Laravel, a partir da versão 10.
Após a instalação é necessário executar o comando abaixo:

```shell
php artisan vendor:publish --provider="Hubmais\HCheckoutOnboarding\Providers\HCheckoutOnboardingServiceProvider"
```

Depois é necessário configurar o arquivo de configuração, presente em config/h-client.php com as credenciais fornecidas.

***

# Inicializando sem Facade

```php
<?php

use Hubmais\HClient\Client;
use Hubmais\HCheckoutOnboarding\Services\Manager as HCheckoutOnboardingManager;

$client = new Client('<endpoint>');
$client->setMarketplaceId('');
$client->setSellerId('');
$client->setToken('');

$HCheckoutOnboarding = new HCheckoutOnboardingManager($client);

```

# Onboarding de estalecimentos
Aqui estão alguns exemplos de como usar os métodos para a manutenção de cadastro de estabelecimentos

## Listando estabelecimentos

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$response = HCheckoutOnboarding::onboarding()->list();

foreach($reponse['data'] as $seller)
{
    ...
}
```

## Exibir detalhes de um cadastro

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$seller = HCheckoutOnboarding::onboarding()->show(
    id: '...',
    with: ['address','owner','know_customer']
);
```

## Buscando estabelecimento por CPF/CNPJ

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$seller = HCheckoutOnboarding::onboarding()->findByDoc(
    doc: '...'
);
```

## Cadastrar estabelecimento Pessoa Física

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$seller = HCheckoutOnboarding::onboarding()->storePerson(
    doc: '11111111111',
    name: 'Fulano de Tal',
    birthdate: '2002-03-12',
    email: 'fulano@email.com',
    cell_number: '11988005566',
    address: [
        'postal_code' => '01200580',
        'street' => 'Rua da Flores',
        'number' => '125',
        'complement' => null,
        'neighborhood' => 'Mooca',
        'city' => 'São Paulo',
        'state' => 'SP',
    ],
    know_customer: [
        revenues: '1250.00',
        employees: 1,
        terminal_count: 1
    ],
    pep: false,
    phone_number: null,
    mother_name: 'Mame del Fulano de Tal',
    description: 'Fulaninho',
    statement_descriptor: 'Lojinha do Fulano',
);
```

## Cadastrar estabelecimento Pessoa Jurídica

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$seller = HCheckoutOnboarding::onboarding()->storeBusiness(
    doc: '99999999000199',
    name: 'Empresa do Fulano de Tal',
    birthdate: '2018-03-30',
    email: 'empresa.fulano@email.com',
    cell_number: '11988005566',
    address: [
        'postal_code' => '01200580',
        'street' => 'Rua da Flores',
        'number' => '125',
        'complement' => null,
        'neighborhood' => 'Mooca',
        'city' => 'São Paulo',
        'state' => 'SP',
    ],
    owner: [
        'doc' => '11111111111',
        'name' => 'Fulano de Tal',
        'birthdate' => '2002-03-12',
        'email' => 'fulano@email.com',
        'cell_number' => '11988005566',
        'phone_number' => null,
        'mother_name' => 'Mame del Fulano de Tal',
        'pep' => false,
    ],
    know_customer: [
        revenues: '1250.00',
        employees: 1,
        terminal_count: 1
    ],    
    phone_number: null,    
    description: 'Empresa do Fulaninho',
    statement_descriptor: 'Loja Fulaninho',
);
```
# Conta Bancária

Aqui estão os exemplos para gerenciar a conta bancária do estabelecimento

## Listar contas bancárias cadastradas
```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$response = HCheckoutOnboarding::onboarding()
    ->bankAccount()
    ->list(
        sellerId: '...'
    );

foreach($reponse['data'] as $bankAccount)
{
    ...
}
```

## Cadastrar uma conta bancária
Os dados do titular da conta devem ser o mesmo do cadastro do estabelecimento

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;
use Hubmais\HCheckoutOnboarding\Enums\BankAccountTypeEnum;

$bankAccount = HCheckoutOnboarding::onboarding()
    ->bankAccount()
    ->store(
        sellerId: '...',
        holder_name: 'Fulano de Tal',
        doc: '11111111111',
        type: BankAccountTypeEnum::CHECKING->value,
        bank_code: '260',
        account_number: '1122405',
        account_digit: '0',
        routing_number: '0001',
        routing_digit: null,
        operation_code: null,
    );
```

## Ativar uma conta bancária

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$bankAccount = HCheckoutOnboarding::onboarding()
    ->bankAccount()
    ->active(
        sellerId: '...',
        id: $bakAccount['id'],
    );
```

## Excluir uma conta bancária

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$bankAccount = HCheckoutOnboarding::onboarding()
    ->bankAccount()
    ->destroy(
        sellerId: '...',
        id: $bakAccount['id'],
    );
```

# Documentação

Aqui estão os métodos para gerenciar a documentação do estabelecimento

# Buscar tipos de documentações a serem enviadas

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$types = HCheckoutOnboarding::onboarding()
    ->documents()
    ->types();
```

# Listar os documentos enviados

```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$documents = HCheckoutOnboarding::onboarding()
    ->documents()
    ->list(sellerId: '...');
```

# Enviar um documento
```php
<?php

use Hubmais\HCheckoutOnboarding\Facades\HCheckoutOnboarding;

$documents = HCheckoutOnboarding::onboarding()
    ->documents()
    ->store(
        sellerId: '...',
        document_type_id: $types[0]['id'],
        name: 'Foto do documento',
        path: 'https://endeco.do.arquivo.png'
    );
```