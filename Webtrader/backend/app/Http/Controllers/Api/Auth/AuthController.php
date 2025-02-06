<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\Otp;
use App\Jobs\SignUp;
use App\Models\User;

use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\LoginUsersRequest;
use App\Http\Requests\RegisterUsersRequest;


class AuthController extends Controller
{

    use HttpResponses;

    public function index()
    {
        return $this->success("Successfull setup");
    }

    public function login(LoginUsersRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (!Auth::attempt($data)) {
                $errors = ['email' => ['Invalid Credentials']];
                return $this->fieldError(
                    $errors,
                    406
                );
            }

            $user = User::where('email', $request->email)->first();

            $user->balance =  json_decode($user->balance);
            $token =  $user->createToken('API token of ' . $user->username, ['*'], now()->addMinutes(1440))->plainTextToken;

            DB::commit();

            return $this->success(
                [
                    'token' => $token,
                ],
                'Login successful'
            );
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error(null, $e->getMessage(), 406);
        }
    }

    public function register(RegisterUsersRequest $request)
    {

        try {

            DB::beginTransaction();

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            $otp = Otp::create([
                'email' => $user->email,
                'otp' => rand(100000, 999999)
            ]);

            DB::commit();

            dispatch(new SignUp($user, $otp->otp));

            return $this->success(null, "Registration successfull, please check your email");
        } catch (Exception $e) {

            DB::rollBack();
            return $this->error(null, $e->getMessage(), 406);
        }
    }

    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return $this->error(null, 'Not Authenticated', 401);
        }
        $user = User::where('id', Auth::user()->id)->first();
        $user->tokens()->delete();
        return $this->success([
            'success' => ['logout successful'],
        ]);
    }

    public function verifyOtp(Request $request)
    {
        // if (!$request->input('email') || empty(trim($request->input('email')))) {
        //     return $this->error(null, 'enter email address', 402);
        // }

        return response()->json($request);
    }
}
