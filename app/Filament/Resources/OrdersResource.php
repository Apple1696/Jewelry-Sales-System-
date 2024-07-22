<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Models\Orders;
use App\Models\Customer;
use App\Models\Promotion;
use App\Models\JewelryItem;
use App\Models\Counter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Invoice";

    protected static ?string $modelLabel = "Invoice";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)
                    ->schema([
                        Forms\Components\Select::make('order_type')
                            ->label('Order Type')
                            ->options([
                                "rebuy" => "Rebuy",
                                "sell" => "Sell"
                            ])
                            ->columnSpan(4),
                        Forms\Components\Select::make('customer_id')
                            ->label('Customer')
                            ->options(function() {
                                return Customer::all()->pluck("name", "id")->toArray();
                            })
                            ->searchable()
                            ->columnSpan(4),
                        Forms\Components\Select::make('promotion_id')
                            ->label('Promotion')
                            ->options(function($get) {
                                return Promotion::isAvailableForCustomer($get('customer_id'))->get()->pluck('name', 'id')->toArray();
                            })
                            ->searchable()
                            ->columnSpan(4),
                        Forms\Components\Select::make('counter_id')
                            ->label('Counter')
                            ->options(function() {
                                return Counter::all()->pluck("name", "id")->toArray();
                            })
                            ->searchable()
                            ->columnSpan(4),
                        // Forms\Components\Repeater::make('details')
                        //     ->relationship()
                        //     ->schema([
                        //         Forms\Components\Select::make('item_id')
                        //             ->options(function() {
                        //                 return JewelryItem::all()->pluck('name', 'id');
                        //             }),
                        //         Forms\Components\TextInput::make('quantity')
                        //             ->numeric()
                        //             ->minValue(0),
                        //     ])
                        //     ->columnSpan(12)
                        //     ->columns(2)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label("Customer"),
                Tables\Columns\TextColumn::make('staff.name')
                    ->label("Staff"),
                Tables\Columns\TextColumn::make('order_type')
                    ->label("Type"),
                Tables\Columns\TextColumn::make('price')
                    ->label("Price")
                    ->money('VND'),
                Tables\Columns\TextColumn::make('counter.name')
                    ->label("Counter"),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Created At"),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label("Updated At")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Invoice')
                ->icon('heroicon-m-arrow-down-tray')
                ->accessSelectedRecords()
                ->action(function ($record) {
                    
                    $templatePath = public_path('templates/invoice.docx');
                    $fileName = "invoice-". $record->id .".docx";

                    $templateProcessor = new TemplateProcessor($templatePath);   
                    $templateProcessor->setValue("CUSTOMER", $record->customer->name); 
                    $templateProcessor->setValue("PHONE", $record->customer->phone); 
                    $templateProcessor->setValue("PURCHASE", Carbon::parse($record->created_at)->format("d-m-Y")); 
                    $templateProcessor->setValue("NAME", $record->name); 
                    $templateProcessor->setValue("ID", $record->id); 
                    $templateProcessor->setValue("FROM_DATE", Carbon::now()->format("d-m-Y")); 
                    $templateProcessor->setValue("TO_DATE", Carbon::now()->addMonths(12)->format("d-m-Y")); 
                    $tempFilePath = tempnam(sys_get_temp_dir(), 'export') . '.docx';
                    $rowIndex = 1;
                    $templateProcessor->cloneRow('ITEM_NAME', $record->details->count());
                    foreach($record->details as $detail) {
                        $templateProcessor->setValue("INDEX#{$rowIndex}", $rowIndex);
                        $templateProcessor->setValue("PERCENTANT#{$rowIndex}", $record->promotion->discount_percentage);
                        $templateProcessor->setValue("ITEM_NAME#{$rowIndex}", $detail->item->name);
                        $templateProcessor->setValue("ITEM_PRICE#{$rowIndex}", (1 - ($record->promotion->discount_percentage / 100)) * $detail->item->price);
                        $rowIndex++;
                    }
                    $templateProcessor->setValue("INVOICE_PRICE", $record->price); 
                    $templateProcessor->saveAs($tempFilePath);
                    return response()->download($tempFilePath, $fileName)->deleteFileAfterSend(true);
                }),
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
            \App\Filament\Resources\OrdersResource\RelationManagers\DetailsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }
}
