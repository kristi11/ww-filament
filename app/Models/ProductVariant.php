<?php

namespace App\Models;

use App\Enums\Age;
use App\Enums\BatteryCapacity;
use App\Enums\Color;
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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'colors' => Color::class,
        'outfitsizes' => Outfitsizes::class,
        'material' => Material::class,
        'corecount' => Corecount::class,
        'dstorage' => DStorage::class,
        'enginevolume' => EngineVolume::class,
        'graphiccardtype' => GraphicCardType::class,
        'memorysize' => Memorysize::class,
        'processortype' => ProcessorType::class,
        'style' => Style::class,
        'volume' => Volume::class,
        'weight' => Weight::class,
        'length' => Length::class,
        'finish' => Finish::class,
        'gender' => Gender::class,
        'modelnumber' => ModelNumber::class,
        'operatingSystem' => OperatingSystem::class,
        'screenResolution' => ScreenResolution::class,
        'batteryCapacity' => BatteryCapacity::class,
        'dimensions' => Dimensions::class,
        'age' => Age::class,
        'pattern' => Pattern::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function getVariantAttributes(): array
    {
        // Get all columns from the 'product_variants' table
        $columns = Schema::getColumnListing('product_variants');

        // Define columns to exclude
        $excludedColumns = ['id', 'product_id', 'created_at', 'updated_at'];

        // Filter out the excluded columns
        $columns = array_diff($columns, $excludedColumns);

        // Map columns to display names
        $variantAttributes = [];
        foreach ($columns as $column) {
            // Convert column name to display format (e.g., 'color' to 'color')
            $variantAttributes[$column] = Str::title(str_replace('_', ' ', $column));
        }

        return $variantAttributes;
    }

    public static function getForm(): array
    {
        return [
            Section::make('General variants')
                ->columns(2)
                ->description('These are commonly used product variants. Choose only the variants applicable to the product')
                ->schema([
                    Select::make('color')
                        ->preload()
                        ->enum(Color::class)
                        ->options(Color::class)
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
                        ->enum(Pattern::class)
                        ->options(Pattern::class)
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
                    Select::make('modelNumber')
                        ->preload()
                        ->enum(ModelNumber::class)
                        ->options(ModelNumber::class)
                        ->columnSpan(1)
                        ->label('Model number'),
                    Select::make('dimensions')
                        ->preload()
                        ->enum(Dimensions::class)
                        ->options(Dimensions::class)
                        ->columnSpan(1)
                        ->label('Dimensions'),
                    Select::make('operatingSystem')
                        ->preload()
                        ->enum(OperatingSystem::class)
                        ->options(OperatingSystem::class)
                        ->columnSpan(1)
                        ->label('Operating system'),
                    Select::make('batteryCapacity')
                        ->preload()
                        ->enum(BatteryCapacity::class)
                        ->options(BatteryCapacity::class)
                        ->columnSpan(1)
                        ->label('Battery capacity'),
                    Select::make('screenResolution')
                        ->preload()
                        ->enum(ScreenResolution::class)
                        ->options(ScreenResolution::class)
                        ->columnSpan(1)
                        ->label('Screen resolution'),
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
                ])->collapsed(),
        ];
    }
}
