<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Dom\Text;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;

use Filament\Resources\Pages\CreateRecord;
use Filament\Tables;
use App\Filament\Resources\Users;
use App\Filament\Resources\Users\RelationManagers\OrdersRelationManager;
use App\Models\Order;
use Filament\Actions;
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->schema([
                Forms\Components\TextInput::make('name')
                ->required(),


                Forms\Components\TextInput::make('email')
                ->label('Email Address')
                ->email()
                ->maxLength(255)
                ->unique(ignoreRecord:true)
                ->required(),


                Forms\Components\DateTimePicker::make('email_verified_at')
                ->label('Email Verified At')
                ->default(now()),

                Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->dehydrated(fn($state) =>filled($state))
                ->required(fn(Page $livewire):bool => $livewire instanceof CreateRecord),

            ]);
        
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
            ->searchable(),

            TextColumn::make('email')
            ->searchable(),

            TextColumn::make('email_verified_at')
            ->dateTime()
            ->sortable(),


            TextColumn::make('created_at')
            ->dateTime()
            ->sortable(),
        ])
        ->filters([])
        ->actions([
            Actions\ActionGroup::make([
                Actions\EditAction::make(),
                Actions\ViewAction::make(),
                Actions\DeleteAction::make(),
        ])
              ])
        ->bulkActions([
           Actions\BulkActionGroup::make([
                Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
