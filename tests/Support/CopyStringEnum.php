<?php

declare(strict_types=1);

namespace Everully\LaravelOnSteroids\Tests\Support;

use Everully\LaravelOnSteroids\Traits\EnumOnSteroids;

enum CopyStringEnum: string
{
    use EnumOnSteroids;

    case A = 'a';
    case B = 'b';
    case C = 'c';
}
