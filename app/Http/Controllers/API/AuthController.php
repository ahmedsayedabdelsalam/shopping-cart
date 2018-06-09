<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UsersResource;
use App\Http\Resources\RolesResource;
use App\Role;

class AuthController extends Controller
{
  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register', 'users']]);
  }

/**
 * @OAS\Post(
 *     path="/register",
 *     tags={"user"},
 *     summary="user sign up ",
 *     operationId="userSignup",
 *     @OAS\Parameter(
 *         name="lang",
 *         in="header",
 *         description="language",
 *         @OAS\Schema(
 *             type="string",
 *             example="en"
 *         )
 *     ),
 *     @OAS\RequestBody(
 *         description="Input data format",
 *         @OAS\MediaType(
 *         mediaType="application/json",
 *         @OAS\Schema(
 *             @OAS\Property(
 *                     property="image",
 *                     description="user image",
 *                     type="file",
 *             ),
 *             @OAS\Property(
 *                     property="name",
 *                     description="user name ",
 *                     type="string",
 *             ),
 *             @OAS\Property(
 *                     property="national_id",
 *                     description="user national id",
 *                     type="integer",
 *                     example=29501090400888,
 *             ),
 *             @OAS\Property(
 *                     property="email",
 *                     description="user email",
 *                     type="string",
 *                     example="mego@yahoo.com",
 *             ),
 *             @OAS\Property(
 *                     property="phone",
 *                     description="user phone number",
 *                     type="string",
 *                     example="(911) 297-4111",
 *             ),
 *             @OAS\Property(
 *                     property="job_title_id",
 *                     description="user job title id",
 *                     type="integer",
 *                     example=4,
 *             ),
 *             @OAS\Property(
 *                     property="birth_date",
 *                     description="user birth date",
 *                     type="string",
 *                     example = "2000-04-19 12:41:55",
 *             ),
 *             @OAS\Property(
 *                     property="hiring_date",
 *                     description="user hiring date",
 *                     type="string",
 *                     example = "2006-03-03 12:41:55",
 *             ),
 *             @OAS\Property(
 *                     property="job_family_id",
 *                     description="user job family id ",
 *                     type="integer",
 *                     example =2,
 *             ),
 *             @OAS\Property(
 *                     property="product_line_id",
 *                     description="user product line id ",
 *                     type="integer",
 *                     example =10,
 *             ),
 *             @OAS\Property(
 *                     property="location_id",
 *                     description="user location id ",
 *                     type="integer",
 *                     example =10,
 *             ),
 *             @OAS\Property(
 *                     property="department_id",
 *                     description="user department id ",
 *                     type="integer",
 *                     example =3,
 *             ),
 *         ),
 *         ),
 *     ),
 *     @OAS\Response(
 *         response=200,
 *         description="successful operation",
 *         @OAS\MediaType(
 *              mediaType="application/json",
 *              @OAS\Schema(
 *                     type="string"
 *              )
 *         ),
 *     ),
 *     @OAS\Response(
 *         response=400,
 *         description="Invalid username/password supplied",
 *         @OAS\MediaType(
 *              mediaType="application/json",
 *              @OAS\Schema(
 *                     type="string"
 *              )
 *         ),
 *     ),
 *     security={
 *         {"Authorization": {}}
 *     }
 * )
 */
  public function register(Request $request)
  {
      $this->validate($request, [
          'email' => 'email|required|unique:users',
          'password' => 'required|min:4'
      ]);
      $user = new User([
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password'))
      ]);
      $user->save();

      $credentials = $request->only(['email', 'password']);
      if (! $token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

      return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      return $this->respondWithToken($token);
    }

      /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile() {
    //   return response()->json(auth()->user());
      return new ProfileResource(auth()->user());
    }

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function users() {
        $users = User::all();
        return UsersResource::collection($users);
    }

    public function roles() {
        $roles = Role::all();
        return RolesResource::collection($roles);
    }
   
}
