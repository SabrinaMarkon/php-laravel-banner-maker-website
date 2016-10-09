<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Session;
use Redirect;
use View;

class GlobalConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // main site settings.
        $settings = Setting::all();
        foreach($settings as $setting) {
            View::share($setting->name, $setting->setting);
            $request->attributes->set($setting->name, $setting->setting);
        }
        //echo $request->get('domain') . "<br>";
        return $next($request);
    }
}
