<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{

    public function products(Request $request)
    {
        $user = Auth::guard('api')->user();
        if (($user->role) === 'user') {
            $products = Product::where(function ($query) use ($request) {
                if ($request->has('search')) {
                    $query->orWhere('product_name', 'like', '%' . $request->get('search', null) . '%');
                }
            })
                ->whereStatus(Controller::$ACTIVE)
                ->get();
        } else {
            $products = Product::query()->whereIn('status', [Controller::$ACTIVE, Controller::$INACTIVE])->get();
        }


        return ProductResource::collection($products)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function productDetail($id)
    {
        $products = Product::whereId($id)->first();
        return ProductResource::make($products)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    public function productDelete($id)
    {
        $products = Product::findOrFail($id);
        if ($products) {
            $products->status = 'delete';
            $products->save();
        } else {
            return ProductResource::make($products)->additional(['meta' => [
                    'code' => Controller::$FAIL,
                    'message' => __('no_product_found'),
                ]]
            );
        }
        return ProductResource::make($products)->additional(['meta' => [
                'code' => Controller::$SUCCESS,
                'message' => __('success'),
            ]]
        );
    }

    /**
     * @throws ValidationException
     */
    public function addEditProduct(Request $request)
    {

        $this->validateRequest('addEditProduct');
        $requestParams = $request->only(['id', 'product_name', 'category', 'sub_category', 'price', 'description', 'status', 'image']);

        if (isset($requestParams['id']) && $requestParams['id'] != '') {
            $products = Product::whereId($requestParams['id'])->first();
            $message = Lang::get('product_updated');
        } else {
            $products = new Product();
            $message = Lang::get('product_added');
        }

        $products->product_name = $requestParams['product_name'];
        $products->category = $requestParams['category'];
        $products->sub_category = $requestParams['sub_category'];
        $products->price = $requestParams['price'];
        $products->description = $requestParams['description'];
        $products->status = $requestParams['status'];
        $products->image = isset($requestParams['id']) ? $products->image : $requestParams['image'];

        $products->save();
//        if ($products->save()) {
//            if ($request->file('image')) {
//                $imageFile = $request->file('image');
//                $type = explode('/', $imageFile->getClientMimeType());
//                if ($type[0] != 'image') {
//                    return Controller::unAuthenticatedResponse('invalid_file_type', 400);
//                }
//                try {
//                    $oldImage = public_path('images/products/' . $products->id . '/' . $products->image);
//                    if (!is_dir($oldImage) && file_exists($oldImage)) {
//                        unlink($oldImage);
//                    }
//                    $destinationPath = public_path('images/products/' . $products->id);
//                    $fileName = time() . "." . $imageFile->getClientOriginalExtension();
//                    $imageFile->move($destinationPath, $fileName);
//                    $products->image = $fileName;
//                } catch (\Exception $e) {
//                    return Controller::successFailResponse(null, 'something_went_wrong', Controller::$FAIL);
//                }
//            }
//        }
//        $products->save();
        return ProductResource::make($products)->additional(['meta' => [
            'message' => $message,
            'code' => Controller::$SUCCESS,
        ]]);

    }

    /**
     * @throws ValidationException
     */
    public function upload(Request $request)
    {
        if ($request->file('image')) {
            $imageFile = $request->file('image');
            $type = explode('/', $imageFile->getClientMimeType());
            if ($type[0] != 'image') {
                return Controller::unAuthenticatedResponse('invalid_file_type', 400);
            }
            try {
                $destinationPath = public_path('images/products/');
                $fileName = time() . "." . $imageFile->getClientOriginalExtension();
                $imageFile->move($destinationPath, $fileName);
            } catch (\Exception $e) {
                return Controller::successFailResponse(null, 'something_went_wrong', Controller::$FAIL);
            }
        }
        return new JsonResponse([
            'data' => $fileName,
            'meta' => [
                'status' => 0,
                'message' => Lang::get('success'),
            ]], static::$STATUS_OK);

    }

}

