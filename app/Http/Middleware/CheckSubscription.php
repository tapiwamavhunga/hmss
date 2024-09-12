<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Auth::check() && \Auth::user()->hasRole('Super Admin') || ! \Auth::check()) {
            return $next($request);
        }

        $username = User::where('tenant_id', getLoggedInUser()->tenant_id)->first();

        if (\Auth::check() && ! \Auth::user()->hasRole('Admin') || ! \Auth::check()) {
            return $next($request);
        }

        $subscription = Subscription::with('subscriptionPlan')
            ->where('status', Subscription::ACTIVE)
            ->where('user_id', $username->id)
            ->first();

        if (! $subscription) {
            return redirect()->route('subscription.pricing.plans.index');
        }

        if ($subscription->isExpired()) {
            return redirect()->route('subscription.pricing.plans.index');
        }

        //        $now = Carbon::parse(Carbon::now())->format('Y-m-d');
        //        $endDate = Carbon::parse($subscription->end_date);
        //        $diffInDays = $endDate->diffInDays($now);
        //
        //        if ($diffInDays == 0) {
        //            return redirect()->route('subscription.pricing.plans.index');
        //        }

        return $next($request);
    }
}
