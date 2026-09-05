<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    // Label Bahasa Indonesia di Sidebar & Header Page
    protected static ?string $navigationLabel = 'Paket Lebaran';
    protected static ?string $modelLabel = 'Paket Lebaran';
    protected static ?string $pluralModelLabel = 'Paket Lebaran';

    // Icon Sidebar (Gift / Paket)
    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Nama Paket')
                    ->placeholder('Contoh: Paket Daging Sapi Premium')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi Paket')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->label('Harga Paket')
                    ->prefix('Rp')
                    ->numeric()
                    ->required(),

                FileUpload::make('thumbnail')
                    ->label('Foto / Thumbnail')
                    ->image()
                    ->directory('packages')
                    ->columnSpanFull(),

                Toggle::make('status')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Nama Paket')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                IconColumn::make('status')
                    ->label('Status Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
