<?php

namespace App\Models;

use App\Enums\Colors;
use App\Enums\CoreCount;
use App\Enums\DStorage;
use App\Enums\EngineVolume;
use App\Enums\GraphicCardType;
use App\Enums\Material;
use App\Enums\MemorySize;
use App\Enums\OutfitSizes;
use App\Enums\ProcessorType;
use App\Enums\Style;
use App\Enums\Volume;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'material',
        'dstorage',
        'enginevolume',
        'style',
        'performance',
        'specs',
        'flavor',
        'brand',
        'processortype',
        'corecount',
        'graphiccardtype',
        'memorysize'
    ];

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
            Section::make('Product being updated')
                ->columns(1)
                ->schema([
                    Select::make('product_id')
                        ->relationship('product', 'name')
                        ->required()
                        ->columnSpanFull()
                        ->required()
                        ->helperText(str("The name of the project that's being updated")->inlineMarkdown()->toHtmlString())
                        ->prefixIcon('heroicon-s-user-circle'),
                ]),
            Section::make('Main variants')
                ->columns(2)
                ->description('Choose only the variants applicable to the product')
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
                ]),
            Section::make('Tech variants')
                ->columns(2)
                ->description('Choose only the variants applicable to the product')
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
                ]),
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
                    Select::make('material')
                        ->preload()
                        ->enum(Material::class)
                        ->options(Material::class)
                        ->columnSpan(1)
                        ->label('Material'),
                    Select::make('memorysize')
                        ->preload()
                        ->enum(MemorySize::class)
                        ->options(MemorySize::class)
                        ->columnSpan(1)
                        ->label('Memory size'),
                ]),
        ];
    }
}
