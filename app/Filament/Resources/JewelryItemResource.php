<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JewelryItemResource\Pages;
use App\Filament\Resources\JewelryItemResource\RelationManagers;
use App\Models\JewelryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Exports\JewelryItemExporter as ItemExporter;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class JewelryItemResource extends Resource
{
    protected static ?string $model = JewelryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Jewelry";

    protected static ?string $modelLabel = "Item";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('gold_weight')
                            ->columnSpan(3),
                        Forms\Components\Select::make('category_id')
                            ->options(function () {
                                return \App\Models\Category::all()->pluck('name', 'id')->toArray();
                            })
                            ->columnSpan(3),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'selling' => 'Selling',
                                'sold' => 'Sold',
                            ])
                            ->columnSpan(3),
                        Forms\Components\FileUpload::make('image')
                            ->disk('public')
                            ->columnSpan(12),
                    ])
   
            ]);
    }

    public static function table(Table $table): Table
    {
        // $url = 'https://www.goldapi.io/api/XAU/USD';
        // $accessToken = 'goldapi-vbiim19lw5tb31h-io';

        // // Tạo yêu cầu HTTP GET
            // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //     'x-access-token: ' . $accessToken
        // ]);

        // // Thực hiện yêu cầu và lấy kết quả
        // $response = curl_exec($ch);
        // curl_close($ch);

        // // Giải mã JSON nhận được
        // $data = json_decode($response, true);

        // // Lấy giá vàng từ dữ liệu JSON
        // $goldPrice = isset($data['price']) ? $data['price'] : 'N/A';
        $goldPrice = 10000;
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('gold_weight'),
                Tables\Columns\TextColumn::make('price')
                    ->money('VND'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'selling' => 'warning',
                        'sold' => 'success',
                    })
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ItemExporter::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('warranty')
                    // ->requiresConfirmation()
                    ->accessSelectedRecords()
                    ->action(function ($record) {
        
                        $templatePath = public_path('templates/warranty.docx');
                        $fileName = "warranty-". $record->id .".docx";

                        $templateProcessor = new TemplateProcessor($templatePath);   
                        $templateProcessor->setValue("NAME", $record->name); 
                        $templateProcessor->setValue("ID", $record->id); 
                        $templateProcessor->setValue("FROM_DATE", Carbon::now()->format("d-m-Y")); 
                        $templateProcessor->setValue("TO_DATE", Carbon::now()->addMonths(12)->format("d-m-Y")); 
                        $tempFilePath = tempnam(sys_get_temp_dir(), 'export') . '.docx';
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
            RelationManagers\GemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJewelryItems::route('/'),
            'create' => Pages\CreateJewelryItem::route('/create'),
            'edit' => Pages\EditJewelryItem::route('/{record}/edit'),
        ];
    }
}
