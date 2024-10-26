<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Jobs\SendBookingApprovedEmail;
use App\Models\BookingTransaction;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Product and Price')
                        ->schema([
                            Select::make('ticket_id')
                                ->relationship('ticket', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $ticket = Ticket::find($state);

                                    $set('price', $ticket ? $ticket->price : 0);
                                }),

                            DatePicker::make('started_at')
                                ->required(),

                            TextInput::make('total_participant')
                                ->numeric()
                                ->required()
                                ->minValue(1)
                                ->prefix('People')
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $price = $get('price');
                                    $subtotal = $price * $state;
                                    $totalVAT = $subtotal * 0.11;
                                    $totalAmount = $subtotal + $totalVAT;

                                    $set('total_amount', $totalAmount);
                                }),

                            TextInput::make('total_amount')
                                ->numeric()
                                ->required()
                                ->prefix('IDR')
                                ->readOnly()
                                ->helperText('Price includes 11% VAT')
                        ]),

                    Step::make('Customer Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(100),

                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(100),

                            TextInput::make('phone_number')
                                ->tel()
                                ->required()
                                ->maxLength(15),
                        ]),

                    Step::make('Payment Information')
                        ->schema([
                            ToggleButtons::make('is_paid')
                                ->label('Have paid?')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => 'heroicon-o-pencil',
                                    false => 'heroicon-o-clock',
                                ])
                                ->required(),

                            FileUpload::make('proof')
                                ->image()
                                ->required(),

                            TextInput::make('booking_trx_id')
                                ->required()
                                ->maxLength(100)
                        ])
                ])
                    ->columnSpan('full')
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('ticket.thumbnail'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('booking_trx_id')
                    ->searchable(),

                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Verified')
            ])
            ->filters([
                SelectFilter::make('ticket_id')
                    ->relationship('ticket', 'name')
                    ->label('ticket')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}
