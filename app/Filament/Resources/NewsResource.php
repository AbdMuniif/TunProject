<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Article Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn(string $operation, $state, Forms\Set $set) =>
                                $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                            )
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Brief summary of the article')
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('published_date')
                            ->default(now()),
                        Forms\Components\TextInput::make('author')
                            ->maxLength(255)
                            ->placeholder('Author name'),
                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->directory('news')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('news/attachments'),
                    ]),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature this article')
                            ->helperText('Featured articles appear on homepage'),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publish')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->wrap(),
                Tables\Columns\TextColumn::make('published_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->defaultSort('published_date', 'desc')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
