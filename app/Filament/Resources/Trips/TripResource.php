<?php

namespace App\Filament\Resources\Trips;

use App\Filament\Resources\Trips\Pages\CreateTrip;
use App\Filament\Resources\Trips\Pages\EditTrip;
use App\Filament\Resources\Trips\Pages\ListTrips;
use App\Filament\Resources\Trips\Schemas\TripForm;
use App\Filament\Resources\Trips\Tables\TripsTable;
use App\Models\Trip;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Agency;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Trip';
   public static function getEloquentQuery(): Builder
{
    $query = parent::getEloquentQuery();
    $user = auth()->user();

    // Agency admin → only their trips
    if ($user->is_agency_admin && $user->agency) {
        return $query->where('agency_id', $user->agency->id);
    }

    // Super admin → all trips
    return $query;
}
public static function canEdit($record): bool
{
    $user = auth()->user();

    if ($user->is_super_admin) {
        return true;
    }

    return $user->is_agency_admin 
        && $user->agency 
        && $record->agency_id === $user->agency->id;
}
public static function canCreate(): bool
{
    $user = auth()->user();

    return $user->is_super_admin || $user->is_agency_admin;
}
    public static function form(Schema $schema): Schema
    {
        return TripForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TripsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    /*public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('agency_id', auth()->user()->agency_id);
}*/

    public static function getPages(): array
    {
        return [
            'index' => ListTrips::route('/'),
            'create' => CreateTrip::route('/create'),
            'edit' => EditTrip::route('/{record}/edit'),
        ];
    }

}
