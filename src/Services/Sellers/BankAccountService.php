<?php
namespace Hubmais\HCheckoutOnboarding\Services\Sellers;

use Hubmais\HCheckoutOnboarding\Services\BaseService;
use Hubmais\HClient\Support\EndpointBuilder;

class BankAccountService extends BaseService
{
    /**
     * Lista as conta bancárias cadastradas
     */
    function list(
        string $sellerId,
        int $page = 1,
        int $limit = 12,
    )
    {
        return $this->client->get(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$sellerId}/bank_accounts", compact('page', 'limit'));
    }

    /**
     * Cadastra uma conta bancária
     */
    function store(
        string $sellerId,
        string $holder_name,
        string $doc,
        string $type,
        string $bank_code,
        string $account_number,
        string $account_digit,
        string $routing_number,
        ?string $routing_digit = null,
        ?string $operation_code = null
    )
    {
        return $this->client->post(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$sellerId}/bank_accounts", get_defined_vars());
    }

    /**
     * Ativa uma conta bancária
     */
    function active(
        string $sellerId,
        string $id
    )
    {
        return $this->client->put(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$sellerId}/bank_accounts/{$id}");
    }

    /**
     * Exclui uma conta bancária
     */
    function destroy(
        string $sellerId,
        string $id
    )
    {
        return $this->client->delete(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$sellerId}/bank_accounts/{$id}");
    }
}