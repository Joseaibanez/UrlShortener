<?php

namespace App\Http\Auth\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Shorter;

class DeleteUsers extends Controller
{
    public function deleteUser($userMail) {
        \DB::table('shorters')
                ->select("*")
                ->where("userMail", "=", $userMail)
                ->delete();
        \DB::table('users')
                ->select("*")
                ->where("userMail", "=", $userMail)
                ->delete();
        return back();
    }
}
