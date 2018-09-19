<?php

declare(strict_types=1);

namespace Application\Administracao\Handlers;

use Application\Administracao\Contracts\Commands\Empresas\EmpresaCreateInterface;
use Application\Administracao\Contracts\Commands\Empresas\EmpresaDeleteInterface;
use Application\Administracao\Contracts\Commands\Empresas\EmpresaUpdateInterface;
use Application\Administracao\Contracts\Handlers\EmpresaHandlerInterface;
use Domain\Contracts\Services\EmpresasServiceInterface;
use Infrastructure\Container\ServiceBus\SimpleCommandHandler;

/**
 * Class EmpresaHandler
 *
 * @package Application\Administracao\Handlers
 */
final class EmpresaHandler extends SimpleCommandHandler implements EmpresaHandlerInterface
{
    /** @var  EmpresasServiceInterface */
    private $service;

    /**
     * EmpresaHandler constructor.
     *
     * @param EmpresasServiceInterface $service
     */
    public function __construct(EmpresasServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param EmpresaCreateInterface $command
     * @return mixed
     */
    public function handleBookCreate(EmpresaCreateInterface $command)
    {
        return $this->service->save($command);
    }

    /**
     * @param EmpresaUpdateInterface $command
     * @return mixed
     */
    public function handleBookUpdate(EmpresaUpdateInterface $command)
    {
        return $this->service->update($command);
    }

    /**
     * @param EmpresaDeleteInterface $command
     * @return mixed
     */
    public function handleBookDelete(EmpresaDeleteInterface $command)
    {
        return $this->service->delete($command->id);
    }
}