<?php
namespace App\Services;

use App\Models\Battery;
use Storage;
use Str;
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
            $image = $data['image'];
            $image_name = time() . '_' . $image->getClientOriginalName();

            $image_path = $image->storeAs('images', $image_name, 'public');
            $data['image'] = $image_path;
        }
        return $this->connection()->create($data);
    }

    public function update(array $data, $id)
    {
        $battery = $this->connection()->findOrFail($id);
        if (isset($data['image'])) {
            $image = $data['image'];
            $image_name = time() . '_' . $image->getClientOriginalName();

            if ($battery->image) {
                Storage::disk('public')->delete($battery->image);
            }
            $image_path = $image->storeAs('images', $image_name, 'public');
            $data['image'] = $image_path;
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