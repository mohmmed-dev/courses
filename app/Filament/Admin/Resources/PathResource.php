<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CourseResource\RelationManagers\TagsRelationManager;
use App\Filament\Admin\Resources\PathResource\Pages;
use App\Filament\Admin\Resources\PathResource\RelationManagers;
use App\Filament\Admin\Resources\PathResource\RelationManagers\CoursesRelationManager;
use App\Models\Path;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;



class PathResource extends Resource
{
    protected static ?string $model = Path::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
                Section::make()->schema([
                        Forms\Components\Select::make('category_id')->relationship('category', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255),
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->imageResizeMode('cover')
                            ->disk('public')
                            ->directory('images')
                            ->imageCropAspectRatio('16:9')
                            ->saveUploadedFileUsing(function (UploadedFile $file) {
                                $image = Image::read($file->getRealPath());
                                $image->resize(800, 800, function ($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                });
                                $pathName = Str::random(16) . time();
                                $path =  $pathName . '.' . 'png';
                                Storage::disk('public')->put("covers/".$path , $image->toPng());
                                return  $path;
                            }),
                        Forms\Components\RichEditor::make('desorption')->disableToolbarButtons([
                                    'attachFiles',
                                ])
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_public')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path'),
                Tables\Columns\TextColumn::make('title')
                ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()->badge(),
                    Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->boolean(),
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
            CoursesRelationManager::class,
            TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaths::route('/'),
            'create' => Pages\CreatePath::route('/create'),
            'edit' => Pages\EditPath::route('/{record}/edit'),
        ];
    }
}
