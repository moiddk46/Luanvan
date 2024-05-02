<?php

namespace App\Http\Middleware;

use App\Models\orderModel;
use App\Models\priceRequestModel;
use App\Models\ServiceModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class shareData
{
    private $order;
    private $priceRequest;
    private $service;
    private $listNotice;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $count = [];
        if (isset($user->position) &&  $user->position == 3) {
            $this->order = new orderModel();
            $this->service = new ServiceModel();
            // Count all orders for the authenticated user
            $count['order'] = $this->order->countAllOrderUser();
            $count['listNotice'] = $this->order->listNotice();
            $count['countNotice'] = $this->order->countNotice();

            $this->priceRequest = new priceRequestModel();

            $count['priceRequest'] = $this->priceRequest->countAllPriceRequestUser();
        }
        View::share('count', $count);
        return $next($request);
    }
}
