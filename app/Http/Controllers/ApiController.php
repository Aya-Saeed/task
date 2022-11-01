<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class ApiController extends Controller
{
    use HttpResponses;





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'aya';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        // dd($user);
        return $this->success(
            [
                'user' => $user,
            ]
        );
    }

    public function register(RegisterRequest $request)
    {
        $request->validated($request->all());
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]
        );

        return $this->success(
            [
                'user' => $user,
                'token' => $user->createToken('api token of' . $user->name)
                    ->plainTextToken
            ]
        );
    }
    public function login(LoginRequest $request)
    {
        $request->validated($request->all());
        if (!Auth::attempt($request->only('phone', 'password'))) {
            return $this->error(' ', 'cradentials don not match..', 401);
        }
        $user = User::where('phone', $request->phone)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('api token of' . $user->name)
                ->plainTextToken

        ]);
    }
}
