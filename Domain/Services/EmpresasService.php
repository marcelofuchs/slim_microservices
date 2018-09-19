<?php

namespace Domain\Services;

use Application\Administracao\Contracts\Commands\Empresas\EmpresaCreateInterface;
use Domain\Abstractions\AbstractDomainService;
use Domain\Contracts\Services\EmpresasServiceInterface;
use Domain\Entities\Book;
use Domain\Entities\Empresa;
use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Class EmpresasService
 * @package Domain\Services
 */
class EmpresasService extends AbstractDomainService implements EmpresasServiceInterface
{
    /**
     * @param CommandInterface $command
     *
     * @return mixed
     */
    public function save(CommandInterface $command)
    {
        /** @var EmpresaCreateInterface $empresaCommand */
        $empresaCommand = $command;
        $id = null;

        $empresa = new Empresa(
            $id,
            $empresaCommand->getRazaoSocial(),
            $empresaCommand->getNomeFantasia(),
            $empresaCommand->getCnae(),
            $empresaCommand->getCnpj(),
            $empresaCommand->getIe(),
            $empresaCommand->getIm(),
            $empresaCommand->getEnquadramentoTributario(),
            $empresaCommand->getEndereco(),
            $empresaCommand->getTelefone(),
            $empresaCommand->getEmail(),
            $empresaCommand->getResponsavel()
        );

        $this->repository->save($empresa);
        $command->id = $empresa->getId();
    }

    /**
     * @param CommandInterface $command
     *
     * @return mixed
     * @throws \Exception
     */
    public function update(CommandInterface $command)
    {
        /** @var EmpresaCreateInterface $empresaCommand */
        $empresaCommand = $command;
        $empresa = $this->repository->find($empresaCommand->id);

        if(!$empresa){
            throw new \Exception("Book not found.", 404);
        }

        $empresa = new Empresa(
            $empresaCommand->id,
            $empresaCommand->getRazaoSocial(),
            $empresaCommand->getNomeFantasia(),
            $empresaCommand->getCnae(),
            $empresaCommand->getCnpj(),
            $empresaCommand->getIe(),
            $empresaCommand->getIm(),
            $empresaCommand->getEnquadramentoTributario(),
            $empresaCommand->getEndereco(),
            $empresaCommand->getTelefone(),
            $empresaCommand->getEmail(),
            $empresaCommand->getResponsavel()
        );

        $this->repository->save($empresa);
    }
}