<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CourseResource\Pages;
use App\Filament\Admin\Resources\CourseResource\RelationManagers;
use App\Filament\Admin\Resources\CourseResource\RelationManagers\TagsRelationManager;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\Select::make('teacher_id')->label('Teachers')->relationship('teacher', 'name')
                            ->required(),
                        Forms\Components\Select::make('category_id')->label('Categories')->relationship('category', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('title')->visibleOn('edit')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')->visibleOn('edit')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')->visibleOn('edit')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('thumbnail')->visibleOn('edit')
                            ->image(),
                        Forms\Components\TextInput::make('youtube_id')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('language')
                            ->options([
                                'arabic' => __('Arabic'),
                                'english' => __('English'),
                            ])->required()
                    ])->columns(2),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('youtube_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('language'),
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
            TagsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
