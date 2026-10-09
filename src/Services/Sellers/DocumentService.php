<?php
namespace Hubmais\HCheckoutOnboarding\Services\Sellers;

use Hubmais\HCheckoutOnboarding\Services\BaseService;
use Hubmais\HClient\Support\EndpointBuilder;

class DocumentService extends BaseService
{
    /**
     * Busca tipos de documentações a serem enviadas
     */
    function types()
    {
        return $this->client->options(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/documents");
    }

    /**
     * Lista os documentos enviados
     */
    function list(string $sellerId)
    {
        return $this->client->get(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$sellerId}/documents");
    }

    /**
     * Envia um documento
     */
    function store(
        string $sellerId,
        int $document_type_id,
        string $name,
        string $path
    )
    {
        return $this->client->post(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$sellerId}/documents", get_defined_vars());
    }
}