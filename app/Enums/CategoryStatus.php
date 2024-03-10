<?php
// 
namespace App\Enums;

use ArchTech\Enums\Values;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;

enum CategoryStatus: int
{
    use Values;
    use InvokableCases;
    use Options;

    case PENDING = 0;
    case ACTIVE = 1;
    case DISABLED = 2;
    
}