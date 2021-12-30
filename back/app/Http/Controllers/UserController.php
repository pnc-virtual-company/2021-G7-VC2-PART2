<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        //
        return User::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        //
        $request-> validate([
            'userName'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6',
            'role'=>'required'
        ]);
        $user = new User();
        $user->userName=$request->userName;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->role=$request->role;
        $user->save();
        
        $token=$user->createToken('mytoken')->plainTextToken;
        $response=[
            'user'=> $user,
            'token'=>$token,
        ];
        return response()->json($response,201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json([
            'message'=>'You have been successfully logged out!'
        ]);
    }
    public function login(Request $request){
        //check email
        $user=User::where('email',$request->email)->first();
        if($user){
            //check password
            if(Hash::check($request->password,$user->password)){
                $token=$user->createToken('mytoken')->plainTextToken;
                $response = [
                    'user'=> $user,
                    'token' => $token
                ];
                return response($response, 200);
            }else{
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        }else{
            $response=["message"=>"User does not exist"];
            return response($response, 422);
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUser($id)
    {
        //
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->update($request->all());

        $user->save();

        return response()->json(['message' => 'Sutdent updated successfully', 'user' => $user], 200);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        //
        $iSDelete = User::destroy($id);
        if ($iSDelete === 1) {
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'User cannot delete'], 404);
        }
    }
    public function search($userName)
    {
        return user::where('userName', 'like', '%' . $userName . '%')->get();
    }
}
