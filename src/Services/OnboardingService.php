<?php
namespace Hubmais\HCheckoutOnboarding\Services;

use Hubmais\HCheckoutOnboarding\Services\Sellers\BankAccountService;
use Hubmais\HCheckoutOnboarding\Services\Sellers\DocumentService;
use Hubmais\HClient\Support\EndpointBuilder;

class OnboardingService extends BaseService
{
    /**
     * Lista os estabelecimentos cadastrados
     * 
     * @param int $page Número da página
     * @param int $limit Quantidade limite de registros por pagina
     * @param ?string $search Busca por CPF, CNPJ, Nome/Razão Social e Apelido/Nome Fantasia
     * @param ?string $doc CPF ou CNPJ com ou sem mascara
     * @param ?array $with Aceita os parâmetros address, owner e know_customer
     */
    function list(
        int $page = 1,
        int $limit = 12,
        ?string $search = null,
        ?string $doc = null,
        ?array $with = null
    )
    {
        return $this->client->get(EndpointBuilder::marketplacePath($this->client, 'onboarding'), get_defined_vars());
    }

    /**
     * Exibe os dados de um estabelecimento pelo identificador
     * 
     * @param string $id Identificador de 32 caracteres
     * @param ?array $with Aceita os parâmetros address, owner e know_customer
     */
    function show(
        string $id,
        ?array $with = null
    )
    {
        return $this->client->get(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/{$id}", compact('with'));
    }

    /**
     * Busca um estabelecimento pelo CPF ou CNPJ
     * 
     * @param ?string $doc CPF ou CNPJ com ou sem mascara
     */
    function findByDoc(string $doc): ?array
    {
        $response = $this->list(limit: 1, doc: $doc);
        $data = current($response['data']);

        if($doc == str_replace(['.','/','-'], '', $data['doc']))
            return $data;

        return null;
    }

    /**
     * Cadastra um Estabelecimento de Pesso Física
     * 
     * @param string $doc CPF com ou sem mascara
     * @param string $name Nome
     * @param string $birthdate Data de Nascimento no formato Y-m-d
     * @param string $email E-mail principal
     * @param string $cell_number Numero do celular somente digitos ex: 11988001122
     * @param array{postal_code:string,street:string,number:string,complement:?string,neighborhood:string,city:string,state:string} $address Endereço
     * @param array{revenues:string,employees:int,terminal_count:int} $know_customer Conheça seu cliente
     * @param bool $pep É pessoa politicamente exposta?
     * @param ?string $phone_number Número de telefone fixo ex: 1130034500
     * @param ?string $mother_name Nome da Mãe
     * @param ?string $description Apelido
     * @param ?string $statement_descriptor Identificação na fatura do cartão
     */
    function storePerson(
        string $doc,
        string $name,
        string $birthdate,
        string $email,
        string $cell_number,
        array $address,
        array $know_customer,
        bool $pep = false,
        ?string $phone_number = null,
        ?string $mother_name = null,
        ?string $description = null,
        ?string $statement_descriptor = null,
    )
    {
        return $this->client->post(EndpointBuilder::marketplacePath($this->client, 'onboarding'), get_defined_vars());
    }

    /**
     * Cadastra um Estabelecimento de Pesso Física
     * 
     * @param string $doc CNPJ com ou sem mascara
     * @param string $name Razão Social
     * @param string $birthdate Data de Abertura no formato Y-m-d
     * @param string $email E-mail principal
     * @param string $cell_number Numero do celular somente digitos ex: 11988001122
     * @param array{postal_code:string,street:string,number:string,complement:?string,neighborhood:string,city:string,state:string} $address Endereço
     * @param array{doc:string,name:string,birthdate:string,email:string,cell_number:string,phone_number:?string,mother_name:?string,pep:?bool} $owner Titular
     * @param array{revenues:string,employees:int,terminal_count:int} $know_customer Conheça seu cliente
     * @param ?string $phone_number Número de telefone fixo ex: 1130034500
     * @param ?string $description Nome Fantasia
     * @param ?string $statement_descriptor Identificação na fatura do cartão
     * @param ?string $state_registration Inscrição Estatual 
     */
    function storeBusiness(
        string $doc,
        string $name,
        string $birthdate,
        string $email,
        string $cell_number,
        array $address,
        array $owner,
        array $know_customer,
        ?string $phone_number = null,
        ?string $description = null,
        ?string $statement_descriptor = null,
        ?string $state_registration = null,
    )
    {
        return $this->client->post(EndpointBuilder::marketplacePath($this->client, 'onboarding'), get_defined_vars());
    }

    /**
     * Atualiza um Estabelecimento de Pesso Física
     * 
     * @param string $id ID do Estabelecimento
     * @param string $doc CPF com ou sem mascara
     * @param string $name Nome
     * @param string $birthdate Data de Nascimento no formato Y-m-d
     * @param string $email E-mail principal
     * @param string $cell_number Numero do celular somente digitos ex: 11988001122
     * @param array{postal_code:string,street:string,number:string,complement:?string,neighborhood:string,city:string,state:string} $address Endereço
     * @param array{revenues:string,employees:int,terminal_count:int} $know_customer Conheça seu cliente
     * @param bool $pep É pessoa politicamente exposta?
     * @param ?string $phone_number Número de telefone fixo ex: 1130034500
     * @param ?string $mother_name Nome da Mãe
     * @param ?string $description Apelido
     * @param ?string $statement_descriptor Identificação na fatura do cartão
     */
    function updatePerson(
        string $id,
        string $doc,
        string $name,
        string $birthdate,
        string $email,
        string $cell_number,
        array $address,
        array $know_customer,
        bool $pep = false,
        ?string $phone_number = null,
        ?string $mother_name = null,
        ?string $description = null,
        ?string $statement_descriptor = null,
    )
    {
        return $this->client->put(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/$id", get_defined_vars());
    }

    /**
     * Atualiza um Estabelecimento de Pesso Física
     * 
     * @param string $id ID do Estabelecimento
     * @param string $doc CNPJ com ou sem mascara
     * @param string $name Razão Social
     * @param string $birthdate Data de Abertura no formato Y-m-d
     * @param string $email E-mail principal
     * @param string $cell_number Numero do celular somente digitos ex: 11988001122
     * @param array{postal_code:string,street:string,number:string,complement:?string,neighborhood:string,city:string,state:string} $address Endereço
     * @param array{doc:string} $owner Titular
     * @param array{revenues:string,employees:int,terminal_count:int} $know_customer Conheça seu cliente
     * @param ?string $phone_number Número de telefone fixo ex: 1130034500
     * @param ?string $description Nome Fantasia
     * @param ?string $statement_descriptor Identificação na fatura do cartão
     * @param ?string $state_registration Inscrição Estatual 
     */
    function updateBusiness(
        string $id,
        string $doc,
        string $name,
        string $birthdate,
        string $email,
        string $cell_number,
        string $phone_number,
        array $address,
        array $owner,
        array $know_customer,
        ?string $description = null,
        ?string $statement_descriptor = null,
        ?string $state_registration = null,
    )
    {
        return $this->client->put(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/$id", get_defined_vars());
    }

    /**
     * Exclui um Estabelecimento
     * 
     * @param string $id ID do Estabelecimento
     */
    function destroy(string $id)
    {
        return $this->client->delete(EndpointBuilder::marketplacePath($this->client, 'onboarding')."/$id");
    }

    /**
     * Módulos para a conta bancária do estabelecimento
     */
    public function bankAccounts(): BankAccountService
    {
        return new BankAccountService($this->client);
    }

    /**
     * Módulos para a documentação do estabelecimento
     */
    public function documents(): DocumentService
    {
        return new DocumentService($this->client);
    }
}