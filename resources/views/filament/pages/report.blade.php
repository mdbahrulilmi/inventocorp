<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Widget statistik otomatis muncul lewat getHeaderWidgets() --}}
        
        {{-- Tabel report otomatis muncul dari InteractsWithTable --}}
        {{ $this->table }}
    </div>
</x-filament-panels::page>
