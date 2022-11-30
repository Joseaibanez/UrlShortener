<?php

namespace App\Http\Controllers;

use App\Models\Shorter;
use App\http\Requests\ShortRequest;
use Illuminate\Support\Facades\Auth;

class UrlShorterController extends Controller
{

    public function short(ShortRequest $request) {
        if($request -> original_url) {
            $shortened_Url = Shorter::create([
                'original_url' => $request -> original_url
            ]);
            if($shortened_Url) {
                $RandomKey = rand(100000000, 1000000000);
                $short_url = base_convert($RandomKey, 10, 36);
                $shortened_Url->update([
                    'url_key' => $short_url
                ]);
                $shortened_Url->update([
                    'redirect_url' => url($short_url)
                ]);
                // Id del usuario
                $userId = Auth::id();
                if($userId!=null) {
                    $shortened_Url->update([
                        'userId' => $userId
                    ]);
                }

                return back()->with('success_message','Url acortada: <a class="text-blue-500" href="'.url($short_url).'">'.url($short_url).'</a>');
            }
        }
        return back();
    }

    public function listUrls() {
        $userId = Auth::id();
        $urls = \DB::table('shorters')
                ->select("*")
                ->where("userId", "=", $userId)
                ->get();
        return view('url_list')->with(['urls'=>$urls]);
    }
}
