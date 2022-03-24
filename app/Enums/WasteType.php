<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;


/**
 * @method static static HouseholdWaste()
 * @method static static Plastic()
 * @method static static Glass()
 * @method static static Metal()
 */
final class WasteType extends Enum implements LocalizedEnum
{
    const HouseholdWaste = 0;
    const Plastic = 1;
    const Glass = 2;
    const Metal = 3;
}
