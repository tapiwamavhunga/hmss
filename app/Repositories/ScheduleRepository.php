<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\DoctorHoliday;
use App\Models\HospitalSchedule;
use App\Models\LunchBreak;
use App\Models\Schedule;
use App\Models\ScheduleDay;
use App\Models\User;
use Arr;
use Auth;

/**
 * Class ScheduleRepository
 *
 * @version February 24, 2020, 5:55 am UTC
 */
class ScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'available_on',
        'available_from',
        'available_to',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Schedule::class;
    }

    public function getData(): array
    {
        /** @var User $user */
        $user = Auth::user();
        $data = [];
        $query = null;
        /** @var Doctor $doctors */
        if (request()->route()->getName() != 'schedules.edit') {
            $query = Doctor::with('doctorUser')->withCount('schedules')->having('schedules_count', '==', 0);
        } else {
            $query = Doctor::with('doctorUser');
        }

        if ($user->hasRole('Doctor')) {
            $query->where('user_id', $user->id);
        }

        $doctors = $query->get()->where('doctorUser.status', '=', 1)->pluck('doctorUser.full_name', 'id')->sort();
        $data['doctors'] = $doctors;
        $data['hospitalSchedule'] = HospitalSchedule::get()->toArray();
        $data['availableOn'] = Schedule::days;

        return $data;
    }

    public function prepareInputForScheduleDayItem(array $input): array
    {
        $items = [];
        foreach ($input as $key => $data) {
            foreach ($data as $index => $value) {
                $items[$index][$key] = $value;
            }
        }

        return $items;
    }

    public function store(array $input): bool
    {
        $schedule = Schedule::create($input);

        $scheduleDayArray = Arr::only($input, ['available_on', 'available_from', 'available_to']);
        $scheduleDayItemInput = $this->prepareInputForScheduleDayItem($scheduleDayArray);
        foreach ($scheduleDayItemInput as $key => $data) {
            $data['doctor_id'] = $input['doctor_id'];
            $data['schedule_id'] = $schedule->id;
            $scheduleDay = ScheduleDay::create($data);
        }

        return true;
    }

    public function update($input, $id): bool
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($input);

        $scheduleDayArray = Arr::only($input, ['available_on', 'available_from', 'available_to']);
        $scheduleDayItemInput = $this->prepareInputForScheduleDayItem($scheduleDayArray);
        foreach ($scheduleDayItemInput as $key => $data) {
            $scheduleDay = ScheduleDay::whereScheduleId($id)
                ->where('available_on', $data['available_on']);
            $data['doctor_id'] = $input['doctor_id'];
            $data['schedule_id'] = $schedule->id;
            $scheduleDay->update($data);
        }

        return true;
    }

    public function getDoctorSchedule($input)
    {

        $data['doctorBreak'] = [];

        $data['scheduleDay'] = ScheduleDay::where('doctor_id', $input['doctor_id'])->Where('available_on',
            $input['day_name'])->get();

        $data['perPatientTime'] = Schedule::whereDoctorId($input['doctor_id'])->get();

        if(isset($input['date'])){
            $data['doctorHoliday'] = DoctorHoliday::where('doctor_id', $input['doctor_id'])->where('date', $input['date'])->get();
            $data['break'] = LunchBreak::where('doctor_id', $input['doctor_id'])->where('date',$input['date'])->get();
            if($data['break']->count() == 0){
                $data['doctorBreak'] = LunchBreak::where('doctor_id', $input['doctor_id'])->whereNotNull('every_day')->get();
            }else{
                $data['doctorBreak'] = LunchBreak::where('doctor_id', $input['doctor_id'])->where('date',$input['date'])->get();;
            }
        }else{
            $data['doctorHoliday'] = DoctorHoliday::where('doctor_id', $input['doctor_id'])->get();
            $data['doctorBreak'] = LunchBreak::where('doctor_id', $input['doctor_id'])->whereNotNull('every_day')->get();
       }

        return $data;
    }
}
