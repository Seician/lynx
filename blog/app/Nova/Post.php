<?php

namespace App\Nova;

use App\Nova\Filters\PostCategory;
use App\Nova\Metrics\NewPosts;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Post>
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

            ID::make()->sortable(),

            Slug::make('Slug')
                ->from(
                    'slug'
                )
                ->sortable()
                ->rules('required', 'max:255', 'unique:posts,slug,{{resourceId}}'),
            Text::make('Title', 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make('Body', 'body')
                ->rules('required'),

            Textarea::make('Excerpt', 'excerpt'),

            Date::make('Published At', 'published_at')->nullable(),

            BelongsTo::make('User', 'author')->sortable()->showOnPreview(),

            BelongsTo::make('Category', 'category')->sortable()->showOnPreview(),

            HasMany::make('Comments')->sortable(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new NewPosts(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new PostCategory(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
