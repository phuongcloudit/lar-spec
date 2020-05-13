<?php
namespace App\Events;

use App\Models\Report;
use Illuminate\Session\Store;

class ViewReportHandler
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(Report $report)
	{
	    if (!$this->isReportViewed($report))
	    {
	        $report->increment('view_count');
	        $this->storeReport($report);
	    }
	}

	private function isReportViewed($report)
	{
	    $viewed = $this->session->get('viewed_reposts', []);

	    return array_key_exists($report->id, $viewed);
	}

	private function storeReport($report)
	{
	    $key = 'viewed_posts.' . $report->id;

	    $this->session->put($key, time());
	}
}