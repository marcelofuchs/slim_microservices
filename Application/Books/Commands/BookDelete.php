<?php
/**
 * Created by PhpStorm.
 * User: willian
 * Date: 17/09/18
 * Time: 14:50
 */

namespace Application\Books\Commands;


use Application\Books\Contracts\Commands\BookDeleteInterface;

class BookDelete implements BookDeleteInterface
{
    /**
     * @var string
     */
    public $id = null;

    /**
     * @inheritdoc
     */
    public function __construct(int $id)
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