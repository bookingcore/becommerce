<?php


namespace Modules\User\Api\V1;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\User\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('',['errors'=>$validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendError(__("Password is not correct"),['code'=>'invalid_credentials']);
        }

        return [
            'token'=>$user->createToken($request->device_name)->plainTextToken,
            'user'=> new UserResource($user),
            'status'=>1
        ];
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('',['errors'=>$validator->errors()]);
        }
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->sendError(__("Current password is not correct"),['code'=>'invalid_current_password']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        // Invalidate all Tokens
        $user->tokens()->delete();

        return $this->sendSuccess(['message'=>__("Password updated. Please re-login"),'code'=>"need_relogin"]);
    }

}
