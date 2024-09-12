<?php

namespace App\Http\Controllers;

use App\Models\HospitalSchedule;
use App\Models\ScheduleDay;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HospitalScheduleController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $hospitalSchedules = HospitalSchedule::all();
        $weekDays = HospitalSchedule::WEEKDAY_FULL_NAME;
        $weekDay = HospitalSchedule::WEEKDAY;
        $slots = getSchedulesTimingSlot();

        return view('hospital_schedule.index', compact('hospitalSchedules', 'weekDay', 'weekDays', 'slots'));
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        if (isset($input['checked_week_days'])) {
            $oldWeekDays = HospitalSchedule::pluck('day_of_week')->toArray();

            foreach (array_diff($oldWeekDays, $input['checked_week_days']) as $dayOfWeek) {
                HospitalSchedule::whereDayOfWeek($dayOfWeek)->delete();
            }

            foreach ($input['checked_week_days'] as $day) {
                $startTime = $input['startTimes'][$day];
                $endTime = $input['endTimes'][$day];
                if (strtotime($startTime) > strtotime($endTime)) {
                    return $this->sendError(HospitalSchedule::WEEKDAY[$day].__('messages.new_change.time_invalid'));
                }
                HospitalSchedule::updateOrCreate(['day_of_week' => $day],
                    ['start_time' => $startTime, 'end_time' => $endTime]);
            }

            return $this->sendSuccess(__('messages.flash.hospital_schedule_saved'));
        }

        return $this->sendSuccess(__('messages.flash.hospital_schedule_saved'));
    }

    public function checkRecord(Request $request): JsonResponse
    {
        $input = $request->all();
        $message = __('messages.flash.some_doctors');
        if (isset($input['checked_week_days'])) {
            $unCheckedDay = array_diff(array_keys(HospitalSchedule::WEEKDAY_FULL_NAME), $input['checked_week_days']);
            $getFullDayName = [];
            foreach ($unCheckedDay as $item) {
                $getFullDayName[] = HospitalSchedule::WEEKDAY_FULL_NAME[$item];
            }
            $scheduleDayExists = ScheduleDay::whereIn('available_on', $getFullDayName)->exists();
            if ($scheduleDayExists) {
                return $this->sendError($message);
            } else {
                return $this->sendSuccess('');
            }
        }

        return $this->sendResponse('checkDayOfWeek', __('messages.flash.data_retrieved'));
    }
}
