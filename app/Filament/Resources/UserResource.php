<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Pengguna & Member';
    protected static ?string $pluralModelLabel = 'Pengguna & Member';
    protected static ?string $modelLabel = 'Pengguna & Member';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Username / Nama')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password Member')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->maxLength(255),

                // TOGGLE MENGUBAH KOLOM ROLE (String 'admin' atau 'member')
                Toggle::make('role')
                    ->label('Jadikan Admin?')
                    ->helperText('Jika aktif, user ini akan diset sebagai admin.')
                    ->formatStateUsing(fn($state): bool => $state === 'admin') // Mengubah string 'admin' menjadi true saat form dibuka
                    ->dehydrateStateUsing(fn($state): string => $state ? 'admin' : 'member') // Mengubah true/false menjadi 'admin'/'member' saat disimpan
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Username')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                // MENAMPILKAN BADGE BERDASARKAN ISI STRING KOLOM ROLE
                TextColumn::make('role')
                    ->label('Role Admin')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)) // Membuat huruf depan kapital (Admin / Member)
                    ->color(fn(string $state): string => $state === 'admin' ? 'success' : 'danger'),

                TextColumn::make('created_at')
                    ->label('Tanggal Bergabung')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
