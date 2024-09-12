<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Department;
use App\Models\Receptionist;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ReceptionistRepository
 *
 * @version February 14, 2020, 9:14 am UTC
 */
class ReceptionistRepository extends BaseRepository
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
        return Receptionist::class;
    }

    public function store(array $input, bool $mail = true): bool
    {
        try {
            $input['department_id'] = Department::whereName('Receptionist')->first()->id;
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

            $receptionist = Receptionist::create(['user_id' => $user->id]);

            $ownerId = $receptionist->id;
            $ownerType = Receptionist::class;

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

    public function update($receptionist, $input): bool
    {
        try {
            unset($input['password']);

            $user = User::find($receptionist->user->id);
            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && ! empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }

            /** @var Receptionist $receptionist */
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            // $input['phone'] = preparePhoneNumber($input, 'phone');
            $receptionist->user->update($input);
            $receptionist->update($input);

            if (! empty($receptionist->address)) {
                if (empty($address = Address::prepareAddressArray($input))) {
                    $receptionist->address->delete();
                }
                $receptionist->address->update($input);
            } else {
                if (! empty($address = Address::prepareAddressArray($input)) && empty($receptionist->address)) {
                    $ownerId = $receptionist->id;
                    $ownerType = Receptionist::class;
                    Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
                }
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
