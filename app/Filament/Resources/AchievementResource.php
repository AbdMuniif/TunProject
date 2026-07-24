<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Filament\Resources\AchievementResource\RelationManagers;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Achievement Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('year')
                            ->maxLength(255)
                            ->placeholder('e.g., 1981, 2018-2020'),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('achievements')
                            ->maxSize(2048),
                    ])->columns(2),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature this achievement')
                            ->helperText('Featured achievements appear prominently on the homepage'),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publish')
                            ->default(true),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('year')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured'),
                Tables\Filters\TernaryFilter::make('is_published'),
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
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}
