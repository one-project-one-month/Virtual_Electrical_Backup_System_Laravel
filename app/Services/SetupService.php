<?php

namespace App\Services;

use App\Models\Setup;

class SetupService extends CommonService
{
    public function connection()
    {
        return new Setup();
    }

    public function calculateTotalPrice($inverter_price, $battery_price)
    {
        if($inverter_price || $battery_price) {
            return null;
        }

        return $inverter_price + $battery_price;
    }

    public function getProductById($id)
    {
        return $this->connection()->query()->where('id', $id)->first();
    }

    public function update($id, array $data)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return $this->connection()->where('id', $id)->delete();
    }
}
