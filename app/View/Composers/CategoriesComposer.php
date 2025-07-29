<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class CategoriesComposer
{
    /**
     * Create a new profile composer.
     */
    // public function __construct(
    //     protected Category $category,
    // ) {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('categories', Category::all());
    }
}