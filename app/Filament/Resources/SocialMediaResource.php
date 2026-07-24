<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialMediaResource\Pages;
use App\Filament\Resources\SocialMediaResource\RelationManagers;
use App\Models\SocialMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialMediaResource extends Resource
{
    protected static ?string $model = SocialMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Social Media Details')
                    ->schema([
                        Forms\Components\Select::make('platform')
                            ->required()
                            ->options([
                                'Facebook' => 'Facebook',
                                'Twitter' => 'Twitter (X)',
                                'Instagram' => 'Instagram',
                                'LinkedIn' => 'LinkedIn',
                                'YouTube' => 'YouTube',
                                'TikTok' => 'TikTok',
                                'Telegram' => 'Telegram',
                                'WhatsApp' => 'WhatsApp',
                            ])
                            ->searchable(),
                        Forms\Components\TextInput::make('url')
                            ->required()
                            ->url()
                            ->placeholder('https://facebook.com/username')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('icon')
                            ->image()
                            ->directory('social')
                            ->maxSize(512)
                            ->helperText('Optional custom icon'),
                    ])->columns(2),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Order of appearance'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('platform')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Facebook' => 'info',
                        'Twitter' => 'primary',
                        'Instagram' => 'danger',
                        'LinkedIn' => 'info',
                        'YouTube' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\ImageColumn::make('icon')
                    ->circular(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSocialMedia::route('/'),
            'create' => Pages\CreateSocialMedia::route('/create'),
            'edit' => Pages\EditSocialMedia::route('/{record}/edit'),
        ];
    }
}
