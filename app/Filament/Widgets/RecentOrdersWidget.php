<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\order;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class RecentOrdersWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Total')
                    ->formatStateUsing(fn($state) => Number::currency($state, 'IDR'))
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('payment_method')
                    ->label('Pembayaran')
                    ->colors([
                        'primary' => 'qris',
                        'secondary' => 'cod',
                    ]),

                Tables\Columns\SelectColumn::make('payment_status')
                    ->label('Status Bayar')
                    ->options([
                        'pending' => 'Belom Dibayar',
                        'paid' => 'Sudah Dibayar',
                        'failed' => 'Gagal'
                    ]),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status Order')
                    ->options([
                        'new' => 'Baru',
                        'processing' => 'Proses',
                        'delivered' => 'Diterima',
                        'canceled' => 'Batal'
                    ]),

                TextColumn::make('file_path')
                    ->label('Download')
                    ->url(fn($record) => Storage::disk('public')->url($record->file_path))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn() => 'Unduh File'),

                TextColumn::make('payment_proof_path')
                    ->label('Download Bukti Pembayaran')
                    ->formatStateUsing(function ($state) {
                        if ($state && Storage::disk('public')->exists($state)) {
                            return 'Unduh Bukti';
                        }
                        return 'Tidak Ada Bukti';
                    })
                    ->url(function ($record) {
                        if ($record->payment_proof_path && Storage::disk('public')->exists($record->payment_proof_path)) {
                            // Gunakan route khusus jika storage link bermasalah
                            return url('/storage/' . $record->payment_proof_path);
                            // Atau gunakan route name: return route('payment.proof.download', basename($record->payment_proof_path));
                        }
                        return null;
                    })
                    ->openUrlInNewTab()
                    ->color(function ($record) {
                        if ($record->payment_proof_path && Storage::disk('public')->exists($record->payment_proof_path)) {
                            return 'success';
                        }
                        return 'gray';
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->openUrlInNewTab(),
            ])
            ->heading('Pesanan Terbaru')
            ->description('10 pesanan terakhir yang masuk')
            ->emptyStateHeading('Belum ada pesanan')
            ->emptyStateDescription('Pesanan akan muncul di sini setelah ada yang masuk.')
            ->emptyStateIcon('heroicon-o-shopping-bag');
    }
}
