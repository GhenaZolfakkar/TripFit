<?php

namespace App\Filament\Resources\TripCategories;

use App\Filament\Resources\TripCategories\Pages\CreateTripCategory;
use App\Filament\Resources\TripCategories\Pages\EditTripCategory;
use App\Filament\Resources\TripCategories\Pages\ListTripCategories;
use App\Filament\Resources\TripCategories\Schemas\TripCategoryForm;
use App\Filament\Resources\TripCategories\Tables\TripCategoriesTable;
use App\Models\TripCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TripCategoryResource extends Resource
{
    protected static ?string $model = TripCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'TripCategory';

    public static function form(Schema $schema): Schema
    {
        return TripCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TripCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTripCategories::route('/'),
            'create' => CreateTripCategory::route('/create'),
            'edit' => EditTripCategory::route('/{record}/edit'),
        ];
    }
}
