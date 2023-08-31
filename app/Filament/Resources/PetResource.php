<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Models\Pet;
use Coolsam\SignaturePad\Forms\Components\Fields\SignaturePad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                    Forms\Components\FileUpload::make('avatar'),
                    Forms\Components\TextInput::make('nombre'),
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
                        ->native(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('signature'),
                Tables\Columns\TextColumn::make('date_of_birth'),
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
