<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function signup(Request $request)
    {
        $validator = $request->validate([
          'first_name' => [
            'required',
            'string',
            'max:255',
          ],
          'last_name' => [
            'required',
            'string',
            'max:255',
          ],
          'address' => [
            'required',
            'string',
            'max:255',
          ],
          'street_name' => [
            'required',
            'string',
            'max:255',
          ],
          'meter_No' => [
            'required',
            'string',
            'max:255',
          ],
          'email' => [
            'required',
            'email',
            'unique:users,email',
          ],
          'password' => [
            'required',
            'min:8',
            'string',
          ],
        ]);

        $res = [
          'first_name' => $request['first_name'],
          'email' => $request['email'],
          'last_name' => $request['last_name'],
          'address' => $request['address'],
          'street_name' => $request['street_name'],
          'meter_No' => $request['meter_No'],
        ];

        $this->user['password'] = bcrypt($request['password']);
        $this->user['first_name'] = $request['first_name'];
        $this->user['email'] = $request['email'];
        $this->user['last_name'] = $request['last_name'];
        $this->user['address'] = $request['address'];
        $this->user['street_name'] = $request['street_name'];
        $this->user['meter_No'] = $request['meter_No'];

        $this->user->save();
        $res['id'] = $this->user->id;
        $res['token'] = $this->user->createToken('web-ui-api')->accessToken;

        return response()->json($res, 200);
    }
}
