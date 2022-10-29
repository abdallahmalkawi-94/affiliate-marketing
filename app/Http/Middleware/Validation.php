<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class Validation
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse|RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('ref')) {
            $validation = match ($request->getRequestUri()) {
                '/api/register' => $this->registerValidate($request),
                '/api/login' => $this->loginValidate($request),
            };
        } else {
            $validation = $this->registerValidate($request);
        }

        if(!is_bool($validation)) {
            return response()->json(["status" => false, "message" => "validation_error", "errors" => $validation]);
        }

        return $next($request);
    }

    private function registerValidate(Request $request)
    {
        $roles = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'birthdate' => 'nullable|date',
            'user_image' => 'required|image|size:5120',
            'password' => ['required', 'confirmed' , Password::min(8)->letters()->numbers()]
        ];

        $validation = Validator::make($request->all(), $roles);

        if ($validation->fails()) {
            return $validation->errors();
        }

        return true;
    }

    private function loginValidate(Request $request)
    {
        $roles = [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ];

        $validation = Validator::make($request->all(), $roles);

        if ($validation->fails()) {
            return $validation->errors();
        }

        return true;
    }
}
