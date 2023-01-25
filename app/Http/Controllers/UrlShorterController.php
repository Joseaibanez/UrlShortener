<?php

namespace App\Http\Controllers;

use App\Models\Shorter;
use App\Models\User;
use App\http\Requests\ShortRequest;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Redirect;
use Route;
use PharIo\Manifest\Url;

use function PHPUnit\Framework\isNull;

class UrlShorterController extends Controller
{

    public function short(ShortRequest $request) {
        if($request -> original_url) {
            //$urlInBase = Shorter::find($request -> original_url);
            $urlsInBase = self::getAllUrl($request);
            if(Auth::user() == null) {
                // Si NO hay usuario
                // Insercion de nueva URL
                $shortened_Url = Shorter::create([
                    'original_url' => $request -> original_url
                ]);
                if($shortened_Url) {
                    $RandomKey = rand(100000000, 1000000000);
                    $short_url = base_convert($RandomKey, 10, 36);
                    // Comprobacion de url repetida e inserción
                    $shortened_Url->update([
                        'url_key' => $short_url
                    ]);
                    $short_url = 'redirect/'.$short_url;
                    $shortened_Url->update([
                        'redirect_url' => url($short_url)
                    ]);
                    return back()->with('success_message',
                    '<input type="text" id="shortenedUrl" name="sUrl" value="'.url($short_url).'">'.'   '.'
                    <button class="copyBtn" data-clipboard-target="#shortenedUrl">Copiar</button><br><br>');
                }
                // Fin
            } else {
                // Si hay usuario
                if($urlsInBase->isEmpty()) {
                    // Insercion de nueva URL
                    $shortened_Url = Shorter::create([
                        'original_url' => $request -> original_url
                    ]);
                    if($shortened_Url) {
                        $RandomKey = rand(100000000, 1000000000);
                        $short_url = base_convert($RandomKey, 10, 36);
                        // Comprobacion de url repetida e inserción
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
                        <button class="copyBtn" data-clipboard-target="#shortenedUrl">Copiar</button><br><br>');
                    }
                    // Fin
                } else {
                    return back()->with('success_message','<h2>La URL ya ha sido introducida</h2>');
                }
            }
        }
        return back();
    }

    public function getAllUrl($request) {
        if(Auth::user() == null) {
            $urlsInBase = \DB::table('shorters')
                ->select("*")
                ->where("original_url", "=", $request -> original_url)
                ->get();
        } else {
            $urlsInBase = \DB::table('shorters')
                ->select("*")
                ->where("original_url", "=", $request -> original_url)
                ->where("userMail", "=", Auth::user()->email)
                ->get();
        }
        return $urlsInBase;
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
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Shorter',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'conditions'            => [
                ['name' => 'Food', 'condition' => 'userMail = '."'".Auth::user()->email."'", 'color' => 'black', 'fill' => true]
            ]
        ];
        $urlsChart = new LaravelChart($chart_options);
        // Fin
        return view('estadisticas_user', compact('urlsChart'));
    }

    public function deleteUser($userMail) {
        if($userMail) {
            \DB::table('shorters')
                ->select("*")
                ->where("userMail", "=", $userMail)
                ->delete();
            \DB::table('users')
                ->select("*")
                ->where("email", "=", $userMail)
                ->delete();
        }
        return view('home');
    }
}
