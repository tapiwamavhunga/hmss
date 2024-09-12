<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Department;
use App\Models\LabTechnician;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class LabTechnicianRepository
 *
 * @version February 14, 2020, 5:19 am UTC
 */
class LabTechnicianRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'full_name',
        'email',
        'phone',
        'education',
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
        return LabTechnician::class;
    }

    public function store(array $input, bool $mail = true): bool
    {
        try {
            $input['department_id'] = Department::whereName('Lab Technician')->first()->id;
            $input['password'] = Hash::make($input['password']);
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            // $input['phone'] = preparePhoneNumber($input, 'phone');
            if(!empty(getSuperAdminSettingValue()['default_language']->value)){
                $input['language'] = getSuperAdminSettingValue()['default_language']->value;
            }
            $user = User::create($input);
            if ($mail) {
                $user->sendEmailVerificationNotification();
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = storeProfileImage($user, $input['image']);
            }

            $labTechnician = LabTechnician::create(['user_id' => $user->id]);

            $ownerId = $labTechnician->id;
            $ownerType = LabTechnician::class;

            /*
            $subscription = [
                'user_id'    => $user->id,
                'start_date' => Carbon::now(),
                'end_date'   => Carbon::now()->addDays(6),
                'status'     => 1,
            ];
            Subscription::create($subscription);
            */

            if (! empty($address = Address::prepareAddressArray($input))) {
                Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
            }

            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);
            $user->assignRole($input['department_id']);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($labTechnician, $input)
    {
        try {
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['region_code'] = regionCode($input['prefix_code']);
            unset($input['password']);

            $user = User::find($labTechnician->user->id);
            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && ! empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }

            /** @var LabTechnician $labTechnician */
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            // $input['phone'] = preparePhoneNumber($input, 'phone');
            $labTechnician->user->update($input);
            $labTechnician->update($input);

            if (! empty($labTechnician->address)) {
                if (empty($address = Address::prepareAddressArray($input))) {
                    $labTechnician->address->delete();
                }
                $labTechnician->address->update($input);
            } else {
                if (! empty($address = Address::prepareAddressArray($input)) && empty($labTechnician->address)) {
                    $ownerId = $labTechnician->id;
                    $ownerType = LabTechnician::class;
                    Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
                }
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
