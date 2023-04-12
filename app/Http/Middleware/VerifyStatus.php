<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerifyStatus {

  public function handle($request, Closure $next, String $status) {

    $user = User::find(Auth::id());
    if($user->status == $status)
      return $next($request);
    else {
      abort(404);
    }
  }
}