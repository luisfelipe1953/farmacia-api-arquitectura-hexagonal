<?php

declare(strict_types=1);

namespace Src\Auth\Register\Domain\Model;

use App\Domain\AggregateRoot;
use Src\Auth\Register\Domain\Model\ValueObjects\Name;
use Src\Auth\Register\Domain\Model\ValueObjects\Email;

class User extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Name $name,
        public readonly Email $email,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
