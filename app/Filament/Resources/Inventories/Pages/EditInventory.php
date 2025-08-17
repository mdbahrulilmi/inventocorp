<?php

namespace App\Filament\Resources\Inventories\Pages;

use App\Filament\Resources\Inventories\InventoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInventory extends EditRecord
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        // setelah create, redirect ke list
        return $this->getResource()::getUrl('index');
        
        // atau langsung redirect ke dashboard
        // return '/dashboard';
    }
}
