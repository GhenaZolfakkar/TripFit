<?php

namespace App\Filament\Resources\Trips\Pages;

use App\Filament\Resources\Trips\TripResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTrip extends CreateRecord
{
    protected static string $resource = TripResource::class;

   /* protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['agency_id'] = auth()->user()->agency_id;
    return $data;
}*/

}
