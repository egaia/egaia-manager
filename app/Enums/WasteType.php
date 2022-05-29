<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;


/**
 * @method static static HouseholdWaste()
 * @method static static Plastic()
 * @method static static Glass()
 * @method static static Metal()
 * @method static static Cardboard()
 * @method static static Paper()
 */
final class WasteType extends Enum implements LocalizedEnum
{
    const HouseholdWaste = 0;
    const Plastic = 1;
    const Glass = 2;
    const Metal = 3;
    const Cardboard = 4;
    const Paper = 5;
}
