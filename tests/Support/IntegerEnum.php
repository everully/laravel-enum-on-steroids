<?php

declare(strict_types=1);

namespace Everully\LaravelEnumOnSteroids\Tests\Support;

use Everully\LaravelEnumOnSteroids\EnumOnSteroids;

enum IntegerEnum: int
{
    use EnumOnSteroids;

    case A = 1;
    case B = 2;
    case C = 3;
}
