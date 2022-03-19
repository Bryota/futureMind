<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DiagnosisType extends Enum
{
    const DEVELOPMENT =   0;
    const SOCIAL =   1;
    const STABLE = 2;
    const TEAMMATE = 3;
    const FUTURE = 4;
}
