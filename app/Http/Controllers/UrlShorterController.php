<?php

namespace App\Http\Controllers;

use App\Models\Shorter;
use Illuminate\Http\Request;

class UrlShorterController extends Controller
{

    public function short(Request $request) {
        if($request -> original_url) {
            $shortened_Url = Shorter::create([
                'original_url' => $request -> original_url
            ]);
            if($shortened_Url) {
                //$RandomKey = Str::random(10);
                $short_url = base_convert($shortened_Url->id, 20, 36);//id,10,36
                $shortened_Url->update([
                    'url_key' => $short_url
                ]);
                return back();
            }
        }
        return back();
    }
}
