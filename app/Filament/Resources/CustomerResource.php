<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Tables\Columns\ToggleColumn;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('surname')->required(),
                TextInput::make('email')->email()->required(),
                Toggle::make('status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('surname'),
                TextColumn::make('email'),
                ToggleColumn::make('status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export')
                    ->fileName('export') // Default file name
                    ->timeFormat('m y d') // Default time format for naming exports
                    ->defaultFormat('pdf') // xlsx, csv or pdf
                    ->defaultPageOrientation('landscape') // Page orientation for pdf files. portrait or landscape
                    ->directDownload() // Download directly without showing modal
                    ->disableAdditionalColumns() // Disable additional columns input
                    ->disableFilterColumns() // Disable filter columns input
                    ->disableFileName() // Disable file name input
                    ->disableFileNamePrefix() // Disable file name prefix
                    ->disablePreview() // Disable export preview
                    ->withHiddenColumns() //Show the columns which are toggled hidden
                    ->fileNameFieldLabel('File Name') // Label for file name input
                    ->formatFieldLabel('Format') // Label for format input
                    ->pageOrientationFieldLabel('Page Orientation') // Label for page orientation input
                    ->filterColumnsFieldLabel('filter columns') // Label for filter columns input
                    ->additionalColumnsFieldLabel('Additional Columns') // Label for additional columns input
                    ->additionalColumnsTitleFieldLabel('Title') // Label for additional columns' title input
                    ->additionalColumnsDefaultValueFieldLabel('Default Value') // Label for additional columns' default value input
                    ->additionalColumnsAddButtonLabel('Add Column')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
