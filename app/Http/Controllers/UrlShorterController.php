<?php

namespace App\Http\Controllers;

use App\Models\Shorter;
use App\http\Requests\ShortRequest;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Route;
use PharIo\Manifest\Url;

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
                $short_url = 'redirect/'.$short_url;
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
                return back()->with('success_message',
                '<input type="text" id="shortenedUrl" name="sUrl" value="'.url($short_url).'">'.'   '.'
                <button class="copyBtn" data-clipboard-target="#shortenedUrl">Copy</button><br>');

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

    public function deleteUrl($id) {
        $urlToDelete = Shorter::find($id);
        $urlToDelete->delete();
        return back();
    }

    public function showStatistics($id) {
        $urlToShow = Shorter::find($id);
        return view('estadisticas_url')->with(['urlToShow'=>$urlToShow]);
    }

    public function countVisit() {
        \DB::table('shorters')
            ->where("redirect_url", "=", url()->current())
            ->update([
                'visitas' => \DB::raw('visitas + 1'),
            ]);
    }
}
