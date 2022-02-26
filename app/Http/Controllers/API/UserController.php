<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return $this->sendResponse(UserResource::collection($users), 'Users fetched.');
    }

    
    // public function store(Request $request)
    // {
    //     $input = $request->all();
    //     $validator = Validator::make($input, [
    //         'name' => 'required',
    //         'description' => 'required'
    //     ]);
    //     if($validator->fails()){
    //         return $this->sendError($validator->errors());       
    //     }
    //     $user = User::create($input);
    //     return $this->sendResponse($user, 'User created.');
    // }

   
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('User does not exist.');
        }
        return $this->sendResponse($user, 'User fetched.');
    }
    

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Este campo es requerido',
            'email.required' => 'Este campo es requerido',
            'email.email' => 'Tiene que introducir un correo valido'
        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->update($validatedData);
        return $this->sendResponse($user, 'User updated.');
    }
   
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse([], 'User deleted.');
    }
}
