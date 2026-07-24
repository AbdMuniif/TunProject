<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\RelationManagers;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->required()
                            ->maxLength(255)
                            ->default('Tun Dr Mahathir'),
                        Forms\Components\TextInput::make('site_tagline')
                            ->maxLength(255)
                            ->placeholder('A brief tagline for the website'),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('site')
                            ->maxSize(2048),
                        Forms\Components\FileUpload::make('favicon')
                            ->image()
                            ->directory('site')
                            ->maxSize(512),
                    ])->columns(2),

                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('contact_address')
                            ->rows(3)
                            ->maxLength(500),
                    ])->columns(2),

                Forms\Components\Section::make('Branding Colors')
                    ->schema([
                        Forms\Components\ColorPicker::make('primary_color')
                            ->default('#1e40af'),
                        Forms\Components\ColorPicker::make('secondary_color')
                            ->default('#059669'),
                    ])->columns(2),

                Forms\Components\Section::make('Footer')
                    ->schema([
                        Forms\Components\Textarea::make('footer_text')
                            ->rows(3)
                            ->maxLength(500),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo')
                    ->circular(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
