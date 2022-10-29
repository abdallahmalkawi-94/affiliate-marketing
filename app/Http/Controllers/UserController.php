<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register (Request $request) {
        try {
            if ($request->has('ref')) {
                session(['referrer' => $request->query('ref')]);
            }

            $referrer = $this->userEloquent->read(['id'] , ['code' => session()->pull('referrer')])->first();
            $user = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthdate' => $request->birthdate,
                'code' => Str::uuid(),
                'referrer_id' => $referrer->id ?? null,
                'user_image' => $request->user_image,
                'password' => Hash::make($request->password),
            ];

            $user = $this->userEloquent->create($user);
            return response()->json(['success' => true , "message" => "Registration completed successfully", "user" => $user]);
        } catch (Exception $exception) {
            return response()->json(["status" => false, "message" => "exception_error", "errors" => $exception->getMessage()]);
        }
    }

    public function login () {
        $user = Auth::user();
        $user['referral_link'] = $this->userEloquent->getReferralLink($user->code);
        $user['referrals'] = $this->userEloquent->getReferralsUserByReferrerId($user->id);
        $user['referralsUsers'] = $user['referrals']->count();
        return response()->json(['success' => true , "message" => "Login successfully", "user" => $user]);
    }

}
