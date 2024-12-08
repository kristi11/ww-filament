<?php

use App\Enums\Age;
use App\Enums\BatteryCapacity;
use App\Enums\CameraSpecifications;
use App\Enums\Color;
use App\Enums\ConnectivityOptions;
use App\Enums\CoreCount;
use App\Enums\Dimensions;
use App\Enums\DStorage;
use App\Enums\EngineVolume;
use App\Enums\Finish;
use App\Enums\Gender;
use App\Enums\GraphicCardType;
use App\Enums\Length;
use App\Enums\Material;
use App\Enums\MemorySize;
use App\Enums\ModelNumber;
use App\Enums\OperatingSystem;
use App\Enums\OutfitSizes;
use App\Enums\Pattern;
use App\Enums\ProcessorType;
use App\Enums\ScreenResolution;
use App\Enums\Style;
use App\Enums\Volume;
use App\Enums\Weight;

return [
    'size' => OutfitSizes::class,
    'color' => Color::class,
    'corecount' => CoreCount::class,
    'material' => Material::class,
    'enginevolume' => EngineVolume::class,
    'dstorage' => DStorage::class,
    'graphiccardtype' => GraphicCardType::class,
    'memorysize' => MemorySize::class,
    'processortype' => ProcessorType::class,
    'style' => Style::class,
    'volume' => Volume::class,
    'age' => Age::class,
    'pattern' => Pattern::class,
    'weight' => Weight::class,
    'length' => Length::class,
    'finish' => Finish::class,
    'gender' => Gender::class,
    'storage' => DStorage::class,
    'processor' => ProcessorType::class,
    'memory' => MemorySize::class,
    'core' => CoreCount::class,
    'batterycapacity' => BatteryCapacity::class,
    'camera_specifications' => CameraSpecifications::class,
    'connectivity_options' => ConnectivityOptions::class,
    'dimensions' => Dimensions::class,
    'model_number' => ModelNumber::class,
    'operating_system' => OperatingSystem::class,
    'processor_type' => ProcessorType::class,
    'screen_resolution' => ScreenResolution::class,

];
