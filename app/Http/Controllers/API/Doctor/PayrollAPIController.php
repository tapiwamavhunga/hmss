<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\AppBaseController;
use App\Models\Doctor;
use App\Models\EmployeePayroll;
use App\Models\Setting;
use Auth;

class PayrollAPIController extends AppBaseController
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $payrolls = EmployeePayroll::whereHasMorph('owner', [Doctor::class], function ($q, $type) {
            if ($type == \App\Models\Doctor::class) {
                $q->whereHas('doctorUser', function (\Illuminate\Database\Eloquent\Builder $qr) {
                    return $qr;
                });
            }
        })->where('owner_id', $user->owner_id)->where('owner_type', $user->owner_type)->with('owner')->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($payrolls as $payroll) {
            $data[] = $payroll->preparePayroll();
        }

        return $this->sendResponse($data, 'Payrolls Retrieved successfully.');
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $payroll = EmployeePayroll::where('id', $id)->where('owner_id', getLoggedInUser()->owner_id)->first();
        $appLogo = Setting::whereTenantId(getLoggedInUser()->tenant_id)->pluck('value', 'key')->toArray();

        if (! $payroll) {
            return $this->sendError(__('messages.my_payrolls').' '.__('messages.common.not_found'));
        }
        $payrollDetails = $payroll->prepareDoctorPayrollDetail();
        $payrollDetails['app_logo'] = asset($appLogo['app_logo']);
        return $this->sendResponse($payrollDetails, 'Payrolls Retrieved successfully.');
    }
}
