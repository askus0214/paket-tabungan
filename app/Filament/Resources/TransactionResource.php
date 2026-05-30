<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use App\Models\Saving;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

// Import Form Components
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;

// Import Table Columns
use Filament\Tables\Columns\TextColumn;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('saving_id')
                    ->label('Saving Plan')
                    ->relationship(
                        name: 'savingPlan',
                        titleAttribute: 'id',
                        modifyQueryUsing: fn($query) => $query->with(['user', 'package'])
                    )
                    // Mengubah pencarian ke package.title
                    ->searchable(['id', 'user.name', 'package.title'])
                    ->preload()
                    // Menampilkan opsi dropdown dengan benar menggunakan ->title
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return ($record->user->name ?? 'No Name') . " | " .
                            ($record->package->title ?? 'No Package') .
                            " (Target: Rp " . number_format($record->target_amount, 0, ',', '.') . ")";
                    })
                    // Memastikan data terpilih me-load ->title saat halaman Create/Edit
                    ->getOptionLabelsUsing(function ($values) {
                        return Saving::with(['user', 'package'])
                            ->find($values)
                            ->mapWithKeys(function ($saving) {
                                return [
                                    $saving->id => ($saving->user->name ?? 'No Name') . " | " .
                                        ($saving->package->title ?? 'No Package') .
                                        " (Target: Rp " . number_format($saving->target_amount, 0, ',', '.') . ")"
                                ];
                            })
                            ->toArray();
                    })
                    ->required(),

                // Memastikan input Amount wajib ada
                TextInput::make('amount')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                DatePicker::make('transaction_date')
                    ->required(),

                Textarea::make('note'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('savingPlan.id')
                    ->label('Saving ID')
                    ->sortable(),

                TextColumn::make('savingPlan.user.name')
                    ->label('Member')
                    ->searchable(),

                TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('transaction_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('note')
                    ->limit(20),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
    