<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class Filter
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $reports = $this->getViewedReports();

        if (!is_null($reports))
        {
            $posts = $this->cleanExpiredViews($reports);
            $this->storeReposts($reports);
        }

        return $next($request);
    }

    private function getViewedReposts()
    {
        return $this->session->get('viewed_reposts', null);
    }

    private function cleanExpiredViews($reposts)
    {
        $time = time();

        // Let the views expire after one hour.
        $throttleTime = 3600;

        return array_filter($reposts, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeReposts($reposts)
    {
        $this->session->put('viewed_reposts', $reposts);
    }
}