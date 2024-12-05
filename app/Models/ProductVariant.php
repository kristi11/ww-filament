<?php

namespace App\Models;

use App\Enums\Age;
use App\Enums\Colors;
use App\Enums\CoreCount;
use App\Enums\DStorage;
use App\Enums\EngineVolume;
use App\Enums\Finish;
use App\Enums\Gender;
use App\Enums\GraphicCardType;
use App\Enums\Length;
use App\Enums\Material;
use App\Enums\MemorySize;
use App\Enums\OutfitSizes;
use App\Enums\Patterns;
use App\Enums\ProcessorType;
use App\Enums\Style;
use App\Enums\Volume;
use App\Enums\Weight;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'color' => Colors::class,
        'corecount' => Corecount::class,
        'dstorage' => DStorage::class,
        'enginevolume' => EngineVolume::class,
        'graphiccardtype' => GraphicCardType::class,
        'material' => Material::class,
        'memorysize' => Memorysize::class,
        'outfitsizes' => Outfitsizes::class,
        'processortype' => ProcessorType::class,
        'style' => Style::class,
        'volume' => Volume::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function getForm():array
    {
        return [
            Section::make('General variants')
                ->columns(2)
                ->description('These are commonly used product variants. Choose only the variants applicable to the product')
                ->schema([
                    Select::make('color')
                        ->preload()
                        ->enum(Colors::class)
                        ->options(Colors::class)
                        ->columnSpan(1),
                    Select::make('size')
                        ->preload()
                        ->enum(OutfitSizes::class)
                        ->options(OutfitSizes::class)
                        ->columnSpan(1),
                    Select::make('material')
                        ->preload()
                        ->enum(Material::class)
                        ->options(Material::class)
                        ->columnSpan(1)
                        ->label('Material'),
                    Select::make('age')
                        ->preload()
                        ->enum(Age::class)
                        ->options(Age::class)
                        ->columnSpan(1)
                        ->label('Age'),
                    Select::make('pattern')
                        ->preload()
                        ->enum(Patterns::class)
                        ->options(Patterns::class)
                        ->columnSpan(1)
                        ->label('Pattern'),
                    Select::make('weight')
                        ->preload()
                        ->enum(Weight::class)
                        ->options(Weight::class)
                        ->columnSpan(1)
                        ->label('Weight'),
                    Select::make('length')
                        ->preload()
                        ->enum(Length::class)
                        ->options(Length::class)
                        ->columnSpan(1)
                        ->label('Length'),
                    Select::make('finish')
                        ->preload()
                        ->enum(Finish::class)
                        ->options(Finish::class)
                        ->columnSpan(1)
                        ->label('Finish'),
                    Select::make('gender')
                        ->preload()
                        ->enum(Gender::class)
                        ->options(Gender::class)
                        ->columnSpan(1)
                        ->label('Gender'),
                ])
                ->collapsed()
                ->icon('heroicon-m-clipboard-document-list'),
            Section::make('Tech variants')
                ->columns(2)
                ->description('These are commonly user tech variants. Choose only the variants applicable to the product')
                ->schema([
                    Select::make('corecount')
                        ->preload()
                        ->enum(CoreCount::class)
                        ->options(CoreCount::class)
                        ->columnSpan(1)
                        ->label('Core count'),
                    Select::make('graphiccardtype')
                        ->preload()
                        ->enum(GraphicCardType::class)
                        ->options(GraphicCardType::class)
                        ->columnSpan(1)
                        ->label('Graphic card type'),
                    Select::make('memorysize')
                        ->preload()
                        ->enum(MemorySize::class)
                        ->options(MemorySize::class)
                        ->columnSpan(1)
                        ->label('Memory size'),
                    Select::make('dstorage')
                        ->preload()
                        ->enum(DStorage::class)
                        ->options(DStorage::class)
                        ->columnSpan(1)
                        ->label('Digital storage'),
                    Select::make('processortype')
                        ->preload()
                        ->enum(ProcessorType::class)
                        ->options(ProcessorType::class)
                        ->columnSpan(1)
                        ->label('Processor type'),
                ])
                ->collapsed()
                ->icon('heroicon-m-cpu-chip'),
            Section::make('Other variants')
                ->columns(2)
                ->description('Choose only the variants applicable to the product')
                ->schema([
                    Select::make('enginevolume')
                        ->preload()
                        ->enum(EngineVolume::class)
                        ->options(EngineVolume::class)
                        ->columnSpan(1)
                        ->label('Engine volume'),
                    Select::make('memorysize')
                        ->preload()
                        ->enum(MemorySize::class)
                        ->options(MemorySize::class)
                        ->columnSpan(1)
                        ->label('Memory size'),
                ])->collapsed(),
        ];
    }
}
