<?php

namespace App\Http\Controllers;

use App\Models\Shorter;
use App\http\Requests\ShortRequest;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
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
                $userMail = Auth::user()->email;
                if($userMail!=null) {
                    $shortened_Url->update([
                        'userMail' => $userMail
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
        $userMail = Auth::user()->email;
        $urls = \DB::table('shorters')
                ->select("*")
                ->where("userMail", "=", $userMail)
                ->get();
        return view('url_list')->with(['urls'=>$urls]);
    }

    public function deleteUrl($id) {
        $urlToDelete = Shorter::find($id);
        $urlToDelete->delete();
        return back();
    }

    public function showStatistics($id) {
        // Grafico
        $chart_options = [
            'chart_title' => 'Urls Creadas',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Shorter',
            'group_by_field' => 'userMail',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $urlsChart = new LaravelChart($chart_options);
        //
        return view('estadisticas_user', compact('urlsChart'));
    }

    /*
    public function countVisit() {
        \DB::table('shorters')
            ->where("redirect_url", "=", url()->current())
            ->update([
                'visitas' => \DB::raw('visitas + 1'),
            ]);
    }
    */

}
