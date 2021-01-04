<?php

namespace App\Entity;

use App\Core\Database\Attribute;

#[Attribute\Entity]
class Todo
{
    #[Attribute\Column]
    private string $text;
}
