<?php

namespace Domain\Entities;

use \Domain\Contracts\Entities\EntityInterface;

/**
 * Book Entity
 * */
class Empresa implements EntityInterface
{
    public $id;

    /**
     * @var string
     */
    private $razaoSocial;

    /**
     * @var string
     */
    private $nomeFantasia;

    /**
     * @var string
     */
    private $cnae;

    /**
     * @var string
     */
    private $cnpj;

    /**
     * @var string
     */
    private $ie;

    /**
     * @var string
     */
    private $im;

    /**
     * @var int
     */
    private $enquadramentoTributario;

    /**
     * @var string
     */
    private $endereco;

    /**
     * @var string
     */
    private $telefone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $responsavel;

    /**
     * @inheritdoc
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
    )
    {
        $this->id = $id;
        $this->razaoSocial = $razaoSocial;
        $this->nomeFantasia = $nomeFantasia;
        $this->cnae = $cnae;
        $this->cnpj = $cnpj;
        $this->ie = $ie;
        $this->im = $im;
        $this->enquadramentoTributario = $enquadramentoTributario;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->responsavel = $responsavel;
    }

    /**
     * @return string
     */
    public function getRazaoSocial(): string
    {
        return $this->razaoSocial;
    }

    /**
     * @param string $razaoSocial
     * @return Empresa
     */
    public function setRazaoSocial(string $razaoSocial): Empresa
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomeFantasia(): string
    {
        return $this->nomeFantasia;
    }

    /**
     * @param string $nomeFantasia
     * @return Empresa
     */
    public function setNomeFantasia(string $nomeFantasia): Empresa
    {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnae(): string
    {
        return $this->cnae;
    }

    /**
     * @param string $cnae
     * @return Empresa
     */
    public function setCnae(string $cnae): Empresa
    {
        $this->cnae = $cnae;
        return $this;
    }

    /**
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @param string $cnpj
     * @return Empresa
     */
    public function setCnpj(string $cnpj): Empresa
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return string
     */
    public function getIe(): string
    {
        return $this->ie;
    }

    /**
     * @param string $ie
     * @return Empresa
     */
    public function setIe(string $ie): Empresa
    {
        $this->ie = $ie;
        return $this;
    }

    /**
     * @return string
     */
    public function getIm(): string
    {
        return $this->im;
    }

    /**
     * @param string $im
     * @return Empresa
     */
    public function setIm(string $im): Empresa
    {
        $this->im = $im;
        return $this;
    }

    /**
     * @return int
     */
    public function getEnquadramentoTributario(): int
    {
        return $this->enquadramentoTributario;
    }

    /**
     * @param int $enquadramentoTributario
     * @return Empresa
     */
    public function setEnquadramentoTributario(int $enquadramentoTributario): Empresa
    {
        $this->enquadramentoTributario = $enquadramentoTributario;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndereco(): string
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     * @return Empresa
     */
    public function setEndereco(string $endereco): Empresa
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone(): string
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return Empresa
     */
    public function setTelefone(string $telefone): Empresa
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Empresa
     */
    public function setEmail(string $email): Empresa
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponsavel(): string
    {
        return $this->responsavel;
    }

    /**
     * @param string $responsavel
     * @return Empresa
     */
    public function setResponsavel(string $responsavel): Empresa
    {
        $this->responsavel = $responsavel;
        return $this;
    }
}
