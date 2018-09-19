<?php

namespace Application\Administracao\Contracts\Commands\Empresas;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Interface EmpresaCreateInterface
 *
 * @package Application\Administracao\Contracts\Commands
 */
interface EmpresaCreateInterface extends CommandInterface
{
    /**
     * EmpresaCreateInterface constructor.
     *
     * @param null|string $id
     * @param string $razaoSocial
     * @param string $nomeFantasia
     * @param string $cnae
     * @param string $cnpj
     * @param string $ie
     * @param string $im
     * @param int $enquadramentoTributario
     * @param string $endereco
     * @param string $telefone
     * @param string $email
     * @param string $responsavel
     */
    public function __construct(
        ?string $id = null,
        string $razaoSocial,
        string $nomeFantasia,
        string $cnae,
        string $cnpj,
        string $ie,
        string $im,
        int $enquadramentoTributario,
        string $endereco,
        string $telefone,
        string $email,
        string $responsavel
    );

    /**
     * @return mixed
     */
    public function getId(): string;

    /**
     * @return mixed
     */
    public function getRazaoSocial();

    /**
     * @param mixed $razao_social
     * @return EmpresaCreate
     */
    public function setRazaoSocial($razao_social);

    /**
     * @return mixed
     */
    public function getNomeFantasia();

    /**
     * @param mixed $nome_fantasia
     * @return EmpresaCreate
     */
    public function setNomeFantasia($nome_fantasia);

    /**
     * @return mixed
     */
    public function getCnae();

    /**
     * @param mixed $cnae
     * @return EmpresaCreate
     */
    public function setCnae($cnae);

    /**
     * @return mixed
     */
    public function getCnpj();

    /**
     * @param mixed $cnpj
     * @return EmpresaCreate
     */
    public function setCnpj($cnpj);

    /**
     * @return mixed
     */
    public function getIe();

    /**
     * @param mixed $ie
     * @return EmpresaCreate
     */
    public function setIe($ie);

    /**
     * @return mixed
     */
    public function getIm();

    /**
     * @param mixed $im
     * @return EmpresaCreate
     */
    public function setIm($im);

    /**
     * @return mixed
     */
    public function getEnquadramentoTributario();

    /**
     * @param mixed $enquadramento_tributario
     * @return EmpresaCreate
     */
    public function setEnquadramentoTributario($enquadramento_tributario);

    /**
     * @return mixed
     */
    public function getEndereco();

    /**
     * @param mixed $endereco
     * @return EmpresaCreate
     */
    public function setEndereco($endereco);

    /**
     * @return mixed
     */
    public function getTelefone();

    /**
     * @param mixed $telefone
     * @return EmpresaCreate
     */
    public function setTelefone($telefone);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param mixed $email
     * @return EmpresaCreate
     */
    public function setEmail($email);

    /**
     * @return mixed
     */
    public function getResponsavel();

    /**
     * @param mixed $responsavel
     * @return EmpresaCreate
     */
    public function setResponsavel($responsavel);
}