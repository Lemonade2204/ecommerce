<?php

namespace App\Filament\Resources\Brands;

use App\Filament\Resources\Brands\Pages\CreateBrand;
use App\Filament\Resources\Brands\Pages\EditBrand;
use App\Filament\Resources\Brands\Pages\ListBrands;
use App\Filament\Resources\Brands\Schemas\BrandForm;
use App\Filament\Resources\Brands\Tables\BrandsTable;
use App\Models\Brand;
use BackedEnum;
use Filament\Forms\Components\FileUpload as ComponentsFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Components;
use Filament\Schemas\Components\Fileupload;
use Filament\Schemas\Components\Utilities\Set as UtilitiesSet;
use Illuminate\Support\Str;
use Illuminate\Support\Set;
use Filament\Tables;
use Filament\Actions;
class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-computer-desktop';

    public static function form(Schema $schema): Schema
    {
         return $schema
        ->schema([
            ComponentsSection::make([
                Components\Grid::make()
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur:true)
                        ->afterStateUpdated(fn(string $operation, $state, UtilitiesSet $set) => $operation 
                        === 'create'? $set('slug', Str::slug($state)): null),

                    TextInput::make('slug')
                        ->maxLength(255)
                        ->disabled()
                        ->required()
                        ->dehydrated()
                        ->unique(Brand::class, 'slug', ignoreRecord: true)
                ]),
                ComponentsFileUpload::make('image')
                    ->image()
                    ->directory('Brand'),


                Toggle  ::make('is_active')
                    ->required()
                    ->default(true)
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image'),


                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),  
            ])
            ->filters([

            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit' => EditBrand::route('/{record}/edit'),
        ];
    }
}
