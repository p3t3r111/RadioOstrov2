<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronJobGetHolidaysController extends Controller
{
    public function index(Request $request)
    {
        // get start date of year
        $startDate = Carbon::now()->startOfYear()->toDateString();
        dump('Start Date: '.$startDate);
        $endDate = Carbon::now()->endOfYear()->toDateString();
        dump('End Date: '.$endDate);

        $holidayTypes = [
            'SchoolHolidays',
        ];

        Holiday::truncate();

        foreach ($holidayTypes as $type) {
            $url = "https://openholidaysapi.org/$type?countryIsoCode=SK&languageIsoCode=SK&validFrom=$startDate&validTo=$endDate";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response, true);

            foreach ($data as $holiday) {
                $arr = [
                    'name' => $holiday['name'][0]['text'],
                    'startDate' => $holiday['startDate'],
                    'endDate' => $holiday['endDate'],
                    'type' => $holiday['type'],
                ];
                dump($arr);
                Holiday::create(
                    [
                        'name' => $arr['name'],
                        'start_date' => $arr['startDate'],
                        'end_date' => $arr['endDate'],
                        'type' => $arr['type'],
                    ]
                );
            }
        }
    }
}
