<?php

namespace Application\Administracao\Commands\Empresas;

use Application\Administracao\Contracts\Commands\Empresas\EmpresaCreateInterface;
use Infrastructure\Container\Helpers\CnpjHelper;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;
use Webmozart\Assert\Assert;

/**
 * Class EmpresaCreate
 *
 * @package Application\Administracao\Commands
 */
class EmpresaCreate implements EmpresaCreateInterface
{
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    private $razaoSocial;

    /**
     * @var
     */
    private $nomeFantasia;

    /**
     * @var
     */
    private $cnae;

    /**
     * @var
     */
    private $cnpj;

    /**
     * @var
     */
    private $ie;

    /**
     * @var
     */
    private $im;

    /**
     * @var
     */
    private $enquadramentoTributario;

    /**
     * @var
     */
    private $endereco;

    /**
     * @var
     */
    private $telefone;

    /**
     * @var
     */
    private $email;

    /**
     * @var
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
        return;
    }

    /**
     * Factory para criar command a partir de array
     *
     * @param array $data
     * @return CommandInterface
     */
    public static function fromArray(array $data)
    {
        Assert::true(CnpjHelper::validate($data['cnpj']) , 'Invalid CNPJ.');

        return new self(
            $data['id'],
            $data['razaoSocial'],
            $data['nomeFantasia'],
            $data['cnae'],
            $data['cnpj'],
            $data['ie'],
            $data['im'],
            $data['enquadramentoTributario'],
            $data['endereco'],
            $data['telefone'],
            $data['email'],
            $data['responsavel']
        );
    }

    /**
     * Serializa os parametros do command
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'razaoSocial' => $this->getRazaoSocial(),
            'nomeFantasia' => $this->getNomeFantasia(),
            'cnae' => $this->getCnae(),
            'cnpj' => $this->getCnpj(),
            'ie' => $this->getIe(),
            'im' => $this->getIm(),
            'enquadramentoTributario' => $this->getEnquadramentoTributario(),
            'endereco' => $this->getEndereco(),
            'telefone' => $this->getTelefone(),
            'email' => $this->getEmail(),
            'responsavel' => $this->getResponsavel()
        ];
    }

    /**
     * @return mixed
     */
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * @param mixed $razaoSocial
     * @return EmpresaCreate
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    /**
     * @param mixed $nomeFantasia
     * @return EmpresaCreate
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnae()
    {
        return $this->cnae;
    }

    /**
     * @param mixed $cnae
     * @return EmpresaCreate
     */
    public function setCnae($cnae)
    {
        $this->cnae = $cnae;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     * @return EmpresaCreate
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * @param mixed $ie
     * @return EmpresaCreate
     */
    public function setIe($ie)
    {
        $this->ie = $ie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * @param mixed $im
     * @return EmpresaCreate
     */
    public function setIm($im)
    {
        $this->im = $im;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnquadramentoTributario()
    {
        return $this->enquadramentoTributario;
    }

    /**
     * @param mixed $enquadramentoTributario
     * @return EmpresaCreate
     */
    public function setEnquadramentoTributario($enquadramentoTributario)
    {
        $this->enquadramentoTributario = $enquadramentoTributario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param mixed $endereco
     * @return EmpresaCreate
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     * @return EmpresaCreate
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return EmpresaCreate
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * @param mixed $responsavel
     * @return EmpresaCreate
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        $this->id;
    }
}