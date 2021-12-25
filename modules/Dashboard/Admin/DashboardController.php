<?php
namespace Modules\Dashboard\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Order\Models\Order;

class DashboardController extends AdminController
{
    public function index()
    {
        $f = strtotime('monday this week');
        $data = [
            'recent_bookings'    => [],//Order::getRecentBookings(),
            'top_cards'          => [],//Order::getTopCardsReport(),
            'earning_chart_data' => [],//Order::getDashboardChartData($f, time())
        ];
        return view('Dashboard::index', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Order::getDashboardChartData(strtotime($from), strtotime($to))
                ]);
                break;
        }
    }
}
