<?php

namespace App\Http\Middleware;

use App\Models\orderModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class shareData
{
    private $order;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $countOrder = 0;
        if (isset($user->position) &&  $user->position == 3) {
            $this->order = new orderModel();
            // Count all orders for the authenticated user
            $countOrder = $this->order->countAllOrderUser();
        }
        View::share('countOrder', $countOrder);
        return $next($request);
    }
}
