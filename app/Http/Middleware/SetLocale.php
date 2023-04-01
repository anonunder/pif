<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $language = 'sr';
        if($request->language){
            $language = $request->language; 
            session()->put('locale',$language);
        }
        if(session()->get('locale')){
            $language = session()->get('locale');
        }else{
            session()->put('locale',$language);
        }
        \App::setLocale($language);
        return $next($request);
    }
}
