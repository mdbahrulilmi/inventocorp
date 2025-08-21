<?php

namespace App\Filament\Resources\Borrows\Pages;

use App\Filament\Resources\Borrows\BorrowResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class CreateBorrow extends CreateRecord
{
    protected static string $resource = BorrowResource::class;

    protected static bool $canCreateAnother = false;

    protected function afterCreate(): void
    {
        $loan = $this->record;
        $items = $this->form->getState()['items'] ?? [];

        foreach ($items as $item) {
            if (!empty($item['item_id']) && \App\Models\Inventory::where('id', $item['item_id'])->exists()) {
                \App\Models\LoanDetail::create([
                    'loan_id' => $loan->id,
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'] ?? 1,
                ]);
            }
        }
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    public function getHeading(): string
    {
        return 'New Borrow Form';
    }

    public function getTitle(): string
    {
        return 'Create Borrow';
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Request Borrow')
            ->color('info')
            ->submit('create'); 
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
}
