<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\TugasModel;

class TugasMiddleware
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
        if (Auth::check()) {
            $student_id = Auth::user()->id;
            $unfinishedTasksCount = TugasModel::countUnfinishedTasks($student_id);
            view()->share('unfinishedTasksCount', $unfinishedTasksCount);
        }

        return $next($request);
    }
}
