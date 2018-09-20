<?php

namespace Domain\Entities;

/**
 * Empresa
 */
class Empresa
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $razaoSocial;

    /**
     * @var string
     */
    private $nomeFantasia;

    /**
     * @var string|null
     */
    private $cnae;

    /**
     * @var string|null
     */
    private $cnpj;

    /**
     * @var string|null
     */
    private $ie;

    /**
     * @var string|null
     */
    private $im;

    /**
     * @var int|null
     */
    private $enquadramentoTributario;

    /**
     * @var string|null
     */
    private $endereco;

    /**
     * @var int|null
     */
    private $telefone;

    /**
     * @var int|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $responsavel;


    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set razaoSocial.
     *
     * @param string $razaoSocial
     *
     * @return Empresa
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    /**
     * Get razaoSocial.
     *
     * @return string
     */
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * Set nomeFantasia.
     *
     * @param string $nomeFantasia
     *
     * @return Empresa
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;

        return $this;
    }

    /**
     * Get nomeFantasia.
     *
     * @return string
     */
    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    /**
     * Set cnae.
     *
     * @param string|null $cnae
     *
     * @return Empresa
     */
    public function setCnae($cnae = null)
    {
        $this->cnae = $cnae;

        return $this;
    }

    /**
     * Get cnae.
     *
     * @return string|null
     */
    public function getCnae()
    {
        return $this->cnae;
    }

    /**
     * Set cnpj.
     *
     * @param string|null $cnpj
     *
     * @return Empresa
     */
    public function setCnpj($cnpj = null)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj.
     *
     * @return string|null
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set ie.
     *
     * @param string|null $ie
     *
     * @return Empresa
     */
    public function setIe($ie = null)
    {
        $this->ie = $ie;

        return $this;
    }

    /**
     * Get ie.
     *
     * @return string|null
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * Set im.
     *
     * @param string|null $im
     *
     * @return Empresa
     */
    public function setIm($im = null)
    {
        $this->im = $im;

        return $this;
    }

    /**
     * Get im.
     *
     * @return string|null
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * Set enquadramentoTributario.
     *
     * @param int|null $enquadramentoTributario
     *
     * @return Empresa
     */
    public function setEnquadramentoTributario($enquadramentoTributario = null)
    {
        $this->enquadramentoTributario = $enquadramentoTributario;

        return $this;
    }

    /**
     * Get enquadramentoTributario.
     *
     * @return int|null
     */
    public function getEnquadramentoTributario()
    {
        return $this->enquadramentoTributario;
    }

    /**
     * Set endereco.
     *
     * @param string|null $endereco
     *
     * @return Empresa
     */
    public function setEndereco($endereco = null)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco.
     *
     * @return string|null
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set telefone.
     *
     * @param int|null $telefone
     *
     * @return Empresa
     */
    public function setTelefone($telefone = null)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return int|null
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set email.
     *
     * @param int|null $email
     *
     * @return Empresa
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return int|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set responsavel.
     *
     * @param string|null $responsavel
     *
     * @return Empresa
     */
    public function setResponsavel($responsavel = null)
    {
        $this->responsavel = $responsavel;

        return $this;
    }

    /**
     * Get responsavel.
     *
     * @return string|null
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }
}
