<?php

namespace App\Filament\Resources;

use App\Models\Pet;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PetResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PetResource\RelationManagers;
use Coolsam\SignaturePad\Forms\Components\Fields\SignaturePad;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('nombre'),
                    Forms\Components\FileUpload::make('avatar'),
                    SignaturePad::make('signature')
                    ->backgroundColor('white') // Set the background color in case you want to download to jpeg
                     ->penColor('black') // Set the pen color
                     ->strokeMinDistance(2.0) // set the minimum stroke distance (the default works fine)
                    ->strokeMaxWidth(2.5) // set the max width of the pen stroke
                     ->strokeMinWidth(3.0) // set the minimum width of the pen stroke
                     ->strokeDotSize(2.0) // set the stroke dot size.
                    ->hideDownloadButtons() // In case you don't want to show the download buttons on the pad, you can hide them by setting this option.
                    ,
                    Forms\Components\DatePicker::make('date_of_birth') 
                    ->native(false)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\ImageColumn::make('signature')->width(200),
                Tables\Columns\ImageColumn::make('avatar')->width(400)->height(200),
                Tables\Columns\TextColumn::make('date_of_birth')
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }    
}
