<?php

namespace App\Repositories;

use App\Models\CurrencySetting;
use App\Models\SuperAdminCurrencySetting;

/**
 * Class currencySettingRepository
 *
 * @version October 8, 2022, 5:24 pm UTC
 */
class currencySettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'country_name',
        'country_code',
        'country_icon',
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
        return CurrencySetting::class;
    }

    public function create($input): bool
    {
        $data = [
            'currency_name' => $input['currency_name'],
            'currency_code' => strtoupper($input['currency_code']),
            'currency_icon' => $input['currency_icon'],
        ];

        CurrencySetting::create($data);

        return true;
    }

    public function storeAdminCurrencies($input): bool
    {
        $data = [
            'currency_name' => $input['currency_name'],
            'currency_code' => strtoupper($input['currency_code']),
            'currency_icon' => $input['currency_icon'],
        ];

        SuperAdminCurrencySetting::create($data);

        return true;
    }

    public function updateAdminCurrency($input, $id): bool
    {
        $data = [
            'currency_name' => $input['currency_name'],
            'currency_code' => strtoupper($input['currency_code']),
            'currency_icon' => $input['currency_icon'],
        ];

        SuperAdminCurrencySetting::find($id)->update($data);

        return true;
    }
}
