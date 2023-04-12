<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerifyRole {

  public function handle($request, Closure $next, String $role) {

    $user = User::find(Auth::id());
    if($user->role == $role)
      return $next($request);
    else {
      abort(404);
    }
  }
}