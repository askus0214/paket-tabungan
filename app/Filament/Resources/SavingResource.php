<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\SavingResource\Pages;
use App\Filament\Resources\SavingResource\RelationManagers;
use App\Models\Saving;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SavingResource extends Resource
{
    protected static ?string $model = Saving::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Tabungan';
    protected static ?string $pluralModelLabel = 'Data Tabungan';
    protected static ?string $modelLabel = 'Data Tabungan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('package_id')
                    ->relationship('package', 'title')
                    ->searchable()
                    ->required(),

                TextInput::make('target_amount')
                    ->numeric()
                    ->required(),

                TextInput::make('current_amount')
                    ->numeric()
                    ->default(0),

                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'completed' => 'Completed',
                    ])
                    ->default('active'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                    ->searchable(),

                TextColumn::make('package.title'),

                TextColumn::make('target_amount'),

                TextColumn::make('current_amount'),

                TextColumn::make('status'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSavings::route('/'),
            'create' => Pages\CreateSaving::route('/create'),
            'edit' => Pages\EditSaving::route('/{record}/edit'),
        ];
    }
}
