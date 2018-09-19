<?php

namespace Application\Administracao\Commands\Empresas;

use Application\Administracao\Contracts\Commands\Empresas\EmpresaDeleteInterface;

class EmpresaDelete implements EmpresaDeleteInterface
{
    /**
     * @var string
     */
    public $id = null;

    /**
     * @inheritdoc
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public static function fromArray(array $data)
    {
        return new self(
            $data['id']
        );
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id
        ];
    }

}