<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\CreateOrder;
use App\Filament\Resources\Orders\Pages\EditOrder;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Models\Order;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
                TextInput::make('shipping_address')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('phone_number')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
