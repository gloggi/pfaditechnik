<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Components\Tab;
use Filament\Tables\Filters\Filter;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Bestellungen';

    protected static ?string $pluralModelLabel = 'Bestellungen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_nr')
                    ->required()
                    ->label('Bestellnummer')
                    ->maxLength(255),
                Forms\Components\Toggle::make('paid')
                    ->label('Bezahlt?')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->label('Vorname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label('Nachname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pfadiname')
                    ->label('Pfadiname')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->label('E-Mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('delivery_first_name')
                    ->label('Vorname (Lieferung)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('delivery_last_name')
                    ->label('Nachname (Lieferung)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('delivery_street')
                    ->label('Strasse (Lieferung)')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('delivery_zip')
                    ->label('PLZ (Lieferung)')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('delivery_town')
                    ->label('Ort (Lieferung)')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('quantity')
                    ->label('Anzahl Bücher')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->label('Zu bezahlen')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('shipping_date')
                    ->label('Versanddatum'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_nr')
                    ->label('Bestellnummer')
                    ->searchable(),
                Tables\Columns\IconColumn::make('paid')
                    ->label('Bezahlt?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('pfadiname')
                    ->label('Pfadiname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Vorname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nachname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Anzahl Bücher')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Zu bezahlen')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'CHF ' . $state),
                Tables\Columns\TextColumn::make('shipping_date')
                    ->label('Versanddatum')
                    ->date('d.m.Y')
                    ->sortable(),
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
                Filter::make('unpaid')
                    ->label('Unbezahlte Bestellungen')
                    ->query(fn (Builder $query) => $query->where('paid', false))
                    ->default(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
