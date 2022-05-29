<?php

use App\Enums\WasteType;

return [

    WasteType::class => [
        WasteType::HouseholdWaste => 'Ordures Ménagères',
        WasteType::Plastic => 'Plastique',
        WasteType::Glass => 'Verre',
        WasteType::Metal => 'Métal',
        WasteType::Cardboard => 'Carton',
        WasteType::Paper => 'Papier',
    ],

];
