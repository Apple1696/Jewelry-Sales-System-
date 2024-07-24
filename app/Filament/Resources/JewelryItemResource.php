<?php

namespace App\Filament\Resources;

// Custom application namespace
use App\Filament\Resources\JewelryItemResource\Pages;
use App\Filament\Resources\JewelryItemResource\RelationManagers;
use App\Models\JewelryItem;  // Custom application model
use Filament\Forms;  // Filament Forms
use Filament\Forms\Form;  // Filament Forms
use Filament\Resources\Resource;  // Filament Resource
use Filament\Tables;  // Filament Tables
use Filament\Tables\Table;  // Filament Tables
use App\Filament\Exports\JewelryItemExporter as ItemExporter;  // Custom application export class
use Filament\Tables\Actions\ExportAction;  // Filament Tables Actions
use Filament\Tables\Actions\Action;  // Filament Tables Actions
use Illuminate\Database\Eloquent\Builder;  // Laravel Eloquent
use Illuminate\Database\Eloquent\SoftDeletingScope;  // Laravel Eloquent
use PhpOffice\PhpWord\TemplateProcessor;  // PhpOffice\PhpWord
use Carbon\Carbon;  // Carbon
use Filament\Tables\Filters\SelectFilter;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;

class JewelryItemResource extends Resource
{
    protected static ?string $model = JewelryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = "Jewelry";

    protected static ?string $modelLabel = "Item";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(12)  // Filament Forms Components
                    ->schema([
                        Forms\Components\TextInput::make('name')  // Filament Forms Components
                            ->columnSpan(3),
                        Forms\Components\TextInput::make('gold_weight')  // Filament Forms Components
                            ->columnSpan(3),
                        Forms\Components\Select::make('category_id')  // Filament Forms Components
                            ->options(function () {
                                return \App\Models\Category::all()->pluck('name', 'id')->toArray();  // Custom application model
                            })
                            ->columnSpan(3),
                        Forms\Components\Select::make('status')  // Filament Forms Components
                            ->options([
                                'draft' => 'Draft',
                                'selling' => 'Selling',
                                'sold' => 'Sold',
                            ])
                            ->columnSpan(3),
                        Forms\Components\FileUpload::make('image')  // Filament Forms Components
                            ->disk('public')
                            ->columnSpan(12),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        $goldPrice = 10000;
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')  // Filament Tables Columns
                    ->disk('public'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(isIndividual: true),  // Filament Tables Columns
                Tables\Columns\TextColumn::make('gold_weight'),  // Filament Tables Columns
                Tables\Columns\TextColumn::make('price')  // Filament Tables Columns
                    ->money('VND'),
                Tables\Columns\TextColumn::make('status')  // Filament Tables Columns
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'selling' => 'warning',
                        'sold' => 'success',
                        'rebuy' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'gray',
                        'selling' => 'warning',
                        'sold' => 'success',
                        'rebuy' => 'success',
                    ])
            ])
            ->headerActions([
                ExportAction::make()  // Filament Tables Actions
                    ->exporter(ItemExporter::class)  // ItemExporter class
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('export')
                    ->action(function ($record) {
                
                            $qrCode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate("http://localhost:8000/admin/jewelry-items/{$record->id}/edit"));
                            $data =  [  
                                "code" => $record->name, 
                                "qrcode" => $qrCode,
                            ]; 
                            // Tạo một file PDF chứa mã QR
                            return response()->streamDownload(function () use ($record, $data) {
                                echo Pdf::loadHtml(
                                    Blade::render('filament.ticket', $data)
                                )->stream();
                            }, $record->name . '.pdf');
  
                    })
                    ->label('QR Code')
                    ->color('success')
                    ->icon('heroicon-m-arrow-down-tray') // Filament Tables Actions
                // Action::make('warranty')  // Filament Tables Actions
                //     ->accessSelectedRecords()
                //     ->action(function ($record) {

                //         $templatePath = public_path('templates/warranty.docx');
                //         $fileName = "warranty-". $record->id .".docx";

                //         $templateProcessor = new TemplateProcessor($templatePath);  // PhpOffice\PhpWord
                //         $templateProcessor->setValue("NAME", $record->name); 
                //         $templateProcessor->setValue("ID", $record->id); 
                //         $templateProcessor->setValue("FROM_DATE", Carbon::now()->format("d-m-Y"));  // Carbon
                //         $templateProcessor->setValue("TO_DATE", Carbon::now()->addMonths(12)->format("d-m-Y"));  // Carbon
                //         $tempFilePath = tempnam(sys_get_temp_dir(), 'export') . '.docx';
                //         $templateProcessor->saveAs($tempFilePath);
                //         return response()->download($tempFilePath, $fileName)->deleteFileAfterSend(true);
                //     }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),  // Filament Tables Actions
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\GemsRelationManager::class,  // Custom application relation manager
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJewelryItems::route('/'),  // ListJewelryItems page
            'create' => Pages\CreateJewelryItem::route('/create'),  // CreateJewelryItem page
            'edit' => Pages\EditJewelryItem::route('/{record}/edit'),  // EditJewelryItem page
        ];
    }
}
