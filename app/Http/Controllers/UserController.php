<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(UserRequest $userRequest)
    {
        $user = new User();
        $user->fill($userRequest->all());
        $user->password = Hash::make($userRequest->input('password'));
        $user->save();
        return $user;
    }

    public function getList(Request $req)
    {
        $keyword = $req->query('search');
        $status = $req->query('status');

//        $queryBuilder = Product::query()->where('status', '=', CommonStatus::ACTIVE);
        $queryBuilder = User::query();

        if ($keyword) {
            $queryBuilder = $queryBuilder
                ->where('email', 'like', '%' . $keyword . '%');
        }
        return $queryBuilder->get();
    }
}
