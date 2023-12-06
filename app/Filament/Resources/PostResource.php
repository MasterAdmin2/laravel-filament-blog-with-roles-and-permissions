<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\PostResource\Pages;
    use App\Filament\Resources\PostResource\RelationManagers;
    use App\Models\Post;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Forms\Set;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Illuminate\Support\Str;

    class PostResource extends Resource
    {
        protected static ?string $model = Post::class;

        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->maxLength(191),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(191),
                    Forms\Components\MarkdownEditor::make('description')
                        ->required()
                        ->maxLength(65535)
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('form-attachments')
                        ->preserveFilenames()
                        ->openable()
                        ->downloadable()
                        ->required(),
                    Forms\Components\Toggle::make('featured')
                        ->required(),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    Tables\Columns\ImageColumn::make('image'),
                    Tables\Columns\IconColumn::make('featured')
                        ->boolean(),
                    Tables\Columns\TextColumn::make('name')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('slug')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ]),
                ])
                ->emptyStateActions([
                    Tables\Actions\CreateAction::make(),
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
                'index' => Pages\ListPosts::route('/'),
                'create' => Pages\CreatePost::route('/create'),
                'view' => Pages\ViewPost::route('/{record}'),
                'edit' => Pages\EditPost::route('/{record}/edit'),
            ];
        }
    }
