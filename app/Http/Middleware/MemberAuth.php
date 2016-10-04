<?php

namespace App\Http\Middleware;

use App\Models\Member;
use Closure;
use Session;
use Redirect;

class MemberAuth
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
        if (Session::has('user')) {
                $user = Member::where('userid', '=', Session::get('user')->userid)->first();
                if ($user && Session::get('user')->password == $user->password) {
                    return $next($request);
                } else {
                    Session::set('user', null);
                    Session::flash('message', 'Incorrect Login');
                    return Redirect::to('login');
                }
            } else {
                Session::set('user', null);
                Session::flash('message', 'Incorrect Login');
                return Redirect::to('login');
            }
        }

}
