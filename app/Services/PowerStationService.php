<?php

namespace App\Services;

use App\Models\PowerStation;
use Illuminate\Support\Facades\Storage;

class PowerStationService extends CommonService
{
    public function connection()
    {
        return new PowerStation();
    }

    public function handleFileUpload($image)
    {
        if($image) {
            $filename = uniqid() . '_' . $image->getClientOriginalName();

            $image->storeAs('images/power_stations/', $filename, 'public');

            return $filename;
        }
        else {
            return null;
        }
    }

    public function deleteFile($path)
    {

        if($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        else{
            return null;
        }
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
