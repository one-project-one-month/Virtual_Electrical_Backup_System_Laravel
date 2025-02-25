<?php
namespace App\Services;

use App\Models\Battery;
use Storage;
use function PHPUnit\Framework\returnArgument;

class BatteryService extends CommonService
{
    public function connection()
    {
        return new Battery();
    }

    public function getAllData()
    {
        return Battery::with(['Brand', 'BatteryType'])->get();
    }

    public function getDataById($id)
    {
        return $this->connection()->with(['Brand', 'BatteryType'])->where('id', $id)->first();
    }

    public function insert(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('images', 'public');
        }
        return $this->connection()->create($data);
    }

    public function update(array $data, $id)
    {
        $battery = $this->connection()->findOrFail($id);
        if (isset($data['image'])) {
            if ($battery->image) {
                Storage::disk('public')->delete($battery->image);
            }
            $data['image'] = $data['image']->store('images', 'public');
        }

        $battery->update($data);
        return $battery;
    }


    public function destroy($id)
    {
        $battery = $this->connection()->findOrFail($id);
        if ($battery->image) {
            Storage::disk('public')->delete($battery->image);
        }
        return $this->connection()->destroy($id);
    }
}