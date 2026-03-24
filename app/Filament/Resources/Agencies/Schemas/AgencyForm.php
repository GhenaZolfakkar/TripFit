<?php

namespace App\Filament\Resources\Agencies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class AgencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
    ->label('Agency Owner')
    ->relationship('user', 'name') // assumes User has a 'name' column
    ->required(),
                TextInput::make('agency_name')
                    ->required(),
                FileUpload::make('logo')
                    ->default(null)
                    ->image()
                    ->directory('agency'),    
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('website')
                    ->url()
                    ->default(null),
            ]);
    }
}
