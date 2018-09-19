<?php

namespace Application\Administracao\Contracts\Commands\Empresas;

use Infrastructure\Container\ServiceBus\Command\CommandInterface;

/**
 * Interface EmpresaCreateInterface
 *
 * @package Application\Administracao\Contracts\Commands
 */
interface EmpresaDeleteInterface extends CommandInterface
{
    /**
     * EmpresaCreateInterface constructor.
     *
     * @param string $id
     */
    public function __construct(string $id);
}