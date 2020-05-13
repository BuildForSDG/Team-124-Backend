<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->input(), [
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

        if ($validator->fails()) {
            return response()->json([
              'error' => $validator->errors(),
            ], 400);
        }

        $res = $input = [
          'first_name' => $request['first_name'],
          'email' => $request['email'],
          'last_name' => $request['last_name'],
          'address' => $request['address'],
          'street_name' => $request['street_name'],
          'meter_No' => $request['meter_No'],
        ];

        $input['password'] = bcrypt($request['password']);

        $user = User::create($input);
        $res['id'] = $user->id;
        $res['token'] = $user->createToken('web-ui-api')->accessToken;

        return response()->json($res, 200);
    }
}
