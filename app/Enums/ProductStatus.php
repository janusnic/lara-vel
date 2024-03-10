<?php
namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;

enum ProductStatus: int
{
    use Values;
    use InvokableCases;
    use Options;

    case PENDING = 0;
    case ACTIVE = 1;
    case NEW = 2;
    case SALE = 3;
    case SOLD = 4;
}