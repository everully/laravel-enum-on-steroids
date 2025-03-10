<?php

declare(strict_types=1);

namespace Everully\LaravelEnumOnSteroids\Tests\Support;

use Everully\LaravelEnumOnSteroids\EnumOnSteroids;

enum StringEnum: string
{
    use EnumOnSteroids;

    case A = 'a';
    case B = 'b';
    case C = 'c';
}
