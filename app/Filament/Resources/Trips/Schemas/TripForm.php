<?php

namespace App\Filament\Resources\Trips\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use App\Models\Agency;

class TripForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('destination')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('duration')
                    ->required()
                    ->numeric(),
                TextInput::make('max_travelers')
                    ->required()
                    ->numeric(),
                TextInput::make('rating')
                    ->numeric()
                    ->default(null),
                Select::make('trip_category_id')
                    ->required()
                    ->relationship('category', 'name'),
               /* Select::make('agency_id')
    ->label('Agency')
    ->options(\App\Models\Agency::all()->pluck('agency_name', 'id')->toArray())
    ->required(),*/
   Select::make('agency_id')
    ->label('Agency')
    ->options(Agency::all()->pluck('agency_name', 'id')->toArray())
    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
                Toggle::make('featured')
                    ->required(),
                FileUpload::make('images')
                   ->image()
                   ->multiple()
                   ->directory('trips') ,
                Repeater::make('services')
                  ->relationship('services')
                  ->schema([
                TextInput::make('service_name')
                  ->label('Service')
                  ->required(),
                Select::make('type')
                  ->options([
                    'included' => 'Included',
                    'not_included' => 'Not Included', ])
                 ->required(),
    ])
                ->columns(2)
                ->label('Trip Services')
            ]);
    }
}
