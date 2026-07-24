<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpeechResource\Pages;
use App\Filament\Resources\SpeechResource\RelationManagers;
use App\Models\Speech;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpeechResource extends Resource
{
    protected static ?string $model = Speech::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Speech Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('speech_date')
                            ->label('Date of Speech'),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('e.g., Parliament House, Kuala Lumpur'),
                    ])->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Full Speech Text')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('speeches/attachments'),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\TextInput::make('video_url')
                            ->url()
                            ->placeholder('YouTube or Vimeo URL')
                            ->helperText('Paste the full URL from YouTube or Vimeo'),
                        Forms\Components\FileUpload::make('audio_file')
                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                            ->directory('speeches/audio')
                            ->maxSize(50000),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->image()
                            ->directory('speeches/thumbnails')
                            ->maxSize(2048),
                    ])->columns(3),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature this speech'),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('speech_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->defaultSort('speech_date', 'desc')
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
            'index' => Pages\ListSpeeches::route('/'),
            'create' => Pages\CreateSpeech::route('/create'),
            'edit' => Pages\EditSpeech::route('/{record}/edit'),
        ];
    }
}
