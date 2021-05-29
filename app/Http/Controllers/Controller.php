<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $SUCCESS = 1;
    public static $ACTIVE = 'active';
    public static $ORDER = 'success';
    public static $CART = 'in_cart';
    public static $INACTIVE = 'inactive';
    public static $FAIL = 0;
    public static $ERROR_STATUS = Response::HTTP_BAD_REQUEST;
    public static $STATUS_OK = Response::HTTP_OK;
    public static $VALIDATION_FAILED_HTTP_CODE = Response::HTTP_BAD_REQUEST;

    /**
     * @param $api
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateRequest($api)
    {
        $rules = Config::get("validations.{$api}.rules");
        if (!$rules) {
            $rules = Config::get("validations.{$api}.rules");
        }

        $messages = Config::get("validations.{$api}.messages");
        if (!$messages) {
            $messages = Config::get("validations.{$api}.messages");
        }
        if ($rules && $messages) {

            $messages = collect($messages)->map(function ($message) {
                return __($message);
            })->toArray();

            $payload = Request::only(array_keys($rules));

            $validator = Validator::make($payload, $rules, $messages);
            $response = new JsonResponse([
                'data' => null,
                'meta' => [
                    'status' => 0,
                    'message' => $validator->errors()->first(),
                ]], static::$VALIDATION_FAILED_HTTP_CODE);

            if ($validator->fails()) {
                throw new ValidationException($validator, $response);
            }
        }
    }

    public function generateAccessToken($user)
    {
        $user = User::whereEmail($user->email)->orderBy('id', 'desc')->first();
        $token = $user->createToken('shoppingcarttoken')->accessToken;
        if ($token) {
            return $token;
        }
    }

    public function successFailResponse($message, $status, $data = null)
    {
        return [
            'data' => $data,
            'meta' => [
                'status' => $status,
                'message' => Lang::get("validation.{$message}"),
            ],
        ];
    }
    public static function unAuthenticatedResponse($message, $status_code = Response::HTTP_UNAUTHORIZED)
    {
        return response()->json([
            'message' => __($message),
            'code' => $status_code,
        ], $status_code);
    }
}
