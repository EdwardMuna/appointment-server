<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use illuminate\database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'phonenumber',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = [

        'deleted_at',
        'created_at'
    ];

    //relationships
    public function mother()
    {
        return $this->hasOne(Mother::class);
    }
    public function midwife()
    {
        return $this->hasOne(Midwife::class);
    }

    //Functions/Methods

    public function getUsers()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function getUser($userId)
    {
        $user = User::find($userId);
        if (!$user)
            return response()->json(['error' => 'user not found'], 404);
        return response()->json(['user' => $user], 200);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if (!$user)
            return response()->json(['error' => 'User not found'], 404);

        $user->delete();
        return response()->json(['message' => 'User deleted succeessfully'], 201);
    }

    public function postUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'phonenumber' => 'required',


            ]
        );

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()]);

        $user = User::create(
            [
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'phonenumber' => $request->phonenumber,

            ]
        );
        return response()->json(['user' => $user], 201);
    }
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'email' => 'email|unique:users',
                'password' => 'required',
                'phonenumber' => 'unique:users',

            ]
        );
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()]);

        $user = User::create(
            [
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phonenumber' => $request->phonenumber,

            ]
        );
        return response()->json(['user' => $user], 201);
    }
}
