<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{

    public function categories()
    {
        $category = Category::query()
            ->whereStatus(Controller::$ACTIVE)
            ->get();
        return CategoryResource::collection($category)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function subCategories($id = null)
    {
        if (isset($id)) {
            $subCategory = Subcategory::query()
                ->whereCategoryId($id)
                ->whereStatus(Controller::$ACTIVE)
                ->get();
        } else {
            $subCategory = Subcategory::query()
                ->whereStatus(Controller::$ACTIVE)
                ->get();
        }

        return SubcategoryResource::collection($subCategory)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

}
