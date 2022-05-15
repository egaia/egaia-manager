<?php

namespace App\Console\Commands;

use App\Enums\WasteType;
use App\Models\CollectPoint;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportGlassSilos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:glassSilos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import glass silos points';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $glassSilos = json_decode(file_get_contents(__DIR__ . '/../../../database/data/gic_collecte.gicsiloverre.json'));
        $glassSilos = $glassSilos->features;
        foreach ($glassSilos as $glassSilo) {
            $properties = $glassSilo->properties;
            $name = '';
            $name .= $properties->numerodansvoie;
            if($name != '') {
                $name .= ' '.$properties->voie;
            } else {
                $name .= $properties->voie;
            }
            $name .= ', '.$properties->code_postal;
            $name .= Str::startsWith($properties->commune, "Lyon") ? " Lyon" : ' '.$properties->commune;

            dump($name);

            $latitude = $glassSilo->geometry->coordinates[1];
            $longitude = $glassSilo->geometry->coordinates[0];

            $collectPoint = new CollectPoint();
            $collectPoint->setAttribute('name', $name);
            $collectPoint->setAttribute('address', $name);
            $collectPoint->setAttribute('latitude', $latitude);
            $collectPoint->setAttribute('longitude', $longitude);
            $collectPoint->setAttribute('type', WasteType::Glass);
            $collectPoint->setAttribute('custom', false);
            $collectPoint->save();
        }
        return 0;
    }
}
