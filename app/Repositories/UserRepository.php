<?php

namespace App\Repositories;

use App\Models\Accountant;
use App\Models\AdvancedPayment;
use App\Models\Appointment;
use App\Models\BedAssign;
use App\Models\Bill;
use App\Models\BirthReport;
use App\Models\CaseHandler;
use App\Models\DeathReport;
use App\Models\Doctor;
use App\Models\EmployeePayroll;
use App\Models\InvestigationReport;
use App\Models\Invoice;
use App\Models\IpdPatientDepartment;
use App\Models\LabTechnician;
use App\Models\Nurse;
use App\Models\OperationReport;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Pharmacist;
use App\Models\Prescription;
use App\Models\Receptionist;
use App\Models\Schedule;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 *
 * @version January 11, 2020, 11:09 am UTC
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
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
        return User::class;
    }

    public function profileUpdate(array $input): bool
    {
        /** @var User $user */
        $user = $this->find(Auth::id());
        try {
            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }
            if (empty($input['image']) && $input['avatar_remove'] == 1 && isset($input['avatar_remove']) && ! empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }
            if(isset($user->hospital_type_id)){
                $input['hospital_name'] = $input['first_name'] .' '.$input['last_name'];
            }
            $user->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function changePassword(array $input): bool
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            if (! Hash::check($input['password_current'], $user->password)) {
                throw new UnprocessableEntityHttpException('Current password is invalid.');
            }
            $input['password'] = Hash::make($input['password']);
            $user->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function store($input): bool
    {
        try {
            // $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['password'] = Hash::make($input['password']);
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            if ($input['department_id'] == 1) {
                $input['email_verified_at'] = Carbon::now();
                $input['status'] = 1;
            }
            if(!empty(getSuperAdminSettingValue()['default_language']->value)){
                $input['language'] = getSuperAdminSettingValue()['default_language']->value;
            }
            $user = User::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $fileExtension = getFileName('User', $input['image']);
                $user->addMedia($input['image'])->usingFileName($fileExtension)->toMediaCollection(User::COLLECTION_PROFILE_PICTURES,
                    config('app.media_disc'));
            }

            /*
            $subscription = [
                'user_id'    => $user->id,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now()->addDays(6),
                'status'     => 1,
            ];
            Subscription::create($subscription);
            */
            if ($input['department_id'] == 1) {
                $ownerId = null;
                $ownerType = null;
                $subscriptionPlan = SubscriptionPlan::where('is_default', 1)->first();
                $trialDays = $subscriptionPlan->trial_days;
                $subscription = [
                    'user_id' => $user->id,
                    'subscription_plan_id' => $subscriptionPlan->id,
                    'plan_amount' => $subscriptionPlan->price,
                    'plan_frequency' => $subscriptionPlan->frequency,
                    'starts_at' => Carbon::now(),
                    'ends_at' => Carbon::now()->addDays($trialDays),
                    'trial_ends_at' => Carbon::now()->addDays($trialDays),
                    'status' => Subscription::ACTIVE,
                    'sms_limit' => $subscriptionPlan->sms_limit,
                ];
                Subscription::create($subscription);

            } elseif ($input['department_id'] == 2) {
                //                $department = DoctorDepartment::where('tenant_id', getLoggedInUser()->tenant_id)->first();
                $doctor = Doctor::create([
                    'user_id' => $user->id,
                    'doctor_department_id' => $input['doctor_department_id'],
                    'specialist' => 'Bones',
                ]);
                $user->sendEmailVerificationNotification();
                $ownerId = $doctor->id;
                $ownerType = Doctor::class;
            } elseif ($input['department_id'] == 3) {
                $patient = Patient::create(['user_id' => $user->id, 'patient_unique_id' => strtoupper(Patient::generateUniquePatientId())]);
                $user->sendEmailVerificationNotification();
                $ownerId = $patient->id;
                $ownerType = Patient::class;
            } elseif ($input['department_id'] == 4) {
                $nurse = Nurse::create(['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                $ownerId = $nurse->id;
                $ownerType = Nurse::class;
            } elseif ($input['department_id'] == 5) {
                $receptionist = Receptionist::create(['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                $ownerId = $receptionist->id;
                $ownerType = Receptionist::class;
            } elseif ($input['department_id'] == 6) {
                $pharmacist = Pharmacist::create(['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                $ownerId = $pharmacist->id;
                $ownerType = Pharmacist::class;
            } elseif ($input['department_id'] == 7) {
                $accountant = Accountant::create(['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                $ownerId = $accountant->id;
                $ownerType = Accountant::class;
            } elseif ($input['department_id'] == 8) {
                $caseManager = CaseHandler::create(['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                $ownerId = $caseManager->id;
                $ownerType = CaseHandler::class;
            } elseif ($input['department_id'] == 9) {
                $labTechnician = LabTechnician::create(['user_id' => $user->id]);
                $user->sendEmailVerificationNotification();
                $ownerId = $labTechnician->id;
                $ownerType = LabTechnician::class;
            }

            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);

            $user->assignRole($input['department_id']);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    public function updateUser($input, $userId): bool
    {
        try {
            /**
             * @var User $user
             */
            $checkAdminUser = User::whereId($userId)->first();
            if (! empty($checkAdminUser) && $checkAdminUser->department_id == 1) {
                $input['status'] = 1;
            }

            $user = $this->update($input, $userId);
            if (isset($input['image']) && ! empty($input['image'])) {
                $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
                $fileExtension = getFileName('User', $input['image']);
                $user->addMedia($input['image'])->usingFileName($fileExtension)->toMediaCollection(User::COLLECTION_PROFILE_PICTURES,
                    config('app.media_disc'));
                $user->update(['updated_at' => Carbon::now()->timestamp]);
            }

            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && ! empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function deleteUser($userId)
    {
        try {
            /**
             * @var User $user
             */
            $user = $this->find($userId);

            if ($user->department_id == 2) {
                $doctorModels = [
                    PatientCase::class, PatientAdmission::class, Schedule::class, Appointment::class,
                    BirthReport::class,
                    DeathReport::class, InvestigationReport::class, OperationReport::class, Prescription::class,
                    IpdPatientDepartment::class,
                ];
                $result = canDelete($doctorModels, 'doctor_id', $user->owner_id);
                $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $user->owner_id,
                    $user->owner_type);
                if ($result || $empPayRollResult) {
                    throw new BadRequestHttpException(
                        'Doctor can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
                Doctor::whereId($user->owner_id)->delete();
            } elseif ($user->department_id == 3) {
                $patientModels = [
                    BirthReport::class, DeathReport::class, InvestigationReport::class, OperationReport::class,
                    Appointment::class, BedAssign::class, PatientAdmission::class, PatientCase::class, Bill::class,
                    Invoice::class, AdvancedPayment::class, Prescription::class, IpdPatientDepartment::class,
                ];
                $result = canDelete($patientModels, 'patient_id', $user->owner_id);
                if ($result) {
                    throw new BadRequestHttpException(
                        'Patient can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
                Patient::whereId($user->owner_id)->delete();
            } elseif ($user->department_id == 4) {
                $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $user->owner_id,
                    $user->owner_type);
                if ($empPayRollResult) {
                    throw new BadRequestHttpException(
                        'Nurse can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
            } elseif ($user->department_id == 5) {
                $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $user->owner_id,
                    $user->owner_type);
                if ($empPayRollResult) {
                    throw new BadRequestHttpException(
                        'Receptionist can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
                Receptionist::whereId($user->owner_id)->delete();
            } elseif ($user->department_id == 6) {
                $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $user->owner_id,
                    $user->owner_type);
                if ($empPayRollResult) {
                    throw new BadRequestHttpException(
                        'Pharmacist can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
                Pharmacist::whereId($user->owner_id)->delete();
            } elseif ($user->department_id == 7) {
                $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $user->owner_id,
                    $user->owner_type);
                if ($empPayRollResult) {
                    throw new BadRequestHttpException(
                        'Accountant can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
                Accountant::whereId($user->owner_id)->delete();
            } elseif ($user->department_id == 8) {
                caseHandler::whereId($user->owner_id)->delete();
            } elseif ($user->department_id == 9) {
                $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $user->owner_id,
                    $user->owner_type);
                if ($empPayRollResult) {
                    throw new BadRequestHttpException(
                        'Lab Technician can\'t be deleted.',
                        null,
                        \Illuminate\Http\Response::HTTP_BAD_REQUEST
                    );
                }
                LabTechnician::whereId($user->owner_id)->delete();
            }

            $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
            $this->delete($userId);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getUserData($user)
    {
        $data = User::with('department')->findOrFail($user)->append(['gender_string', 'image_url']);

        return $data;
    }

    public function profileApiUpdate($input)
    {
        $user = $this->find(Auth::id());

        try {
            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }

            $user->update($input);

            return $user;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
