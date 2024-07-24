<?php

declare(strict_types=1);

namespace Everully\LaravelOnSteroids\Tests\Support;

use Everully\LaravelOnSteroids\Traits\EnumOnSteroids;

enum IntegerEnum: int
{
    use EnumOnSteroids;

    case A = 1;
    case B = 2;
    case C = 3;
}
