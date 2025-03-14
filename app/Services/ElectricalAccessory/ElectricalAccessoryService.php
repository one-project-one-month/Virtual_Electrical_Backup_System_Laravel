<?php

namespace App\Services\ElectricalAccessory;

use App\Services\CommonService;
use App\Models\ElectricalAccessory\ElectricalAccessory;
use Illuminate\Support\Facades\Storage;


class ElectricalAccessoryService extends CommonService{

    public function connection(){
        return new ElectricalAccessory();
    }

    public function insert($data){
        if (isset($data['image'])) {
            $image = $data['image'];
            $image_name = time() . '_' . $image->getClientOriginalName();

            $image_path = $image->storeAs('electricalAccessories', $image_name, 'public');
            $data['image'] = $image_path;
        }

        return $this->connection()->query()->create($data);


    }

    public function getElectricalById($id){
        return $this->connection()->query()->findOrFail($id);
    }

    public function updateElectricalAccessory($data , $id){
        $electricalAccessory=ElectricalAccessory::findOrFail($id);
        if (isset($data['image'])) {
            $image = $data['image'];
            $image_name = time() . '_' . $image->getClientOriginalName();

            if ($electricalAccessory->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $electricalAccessory->image));

            }
            $image_path = $image->storeAs('electricalAccessories', $image_name, 'public');
            $data['image'] = $image_path;
        }
         $electricalAccessory->update($data);
         return $electricalAccessory;
    }

    public function deletedById($id){
        $electricalAccessory = $this->connection()->findOrFail($id);
        if ($electricalAccessory->image) {

            Storage::disk('public')->delete(str_replace('/storage/', '', $electricalAccessory->image));
        }
         $electricalAccessory->delete();
         return $electricalAccessory;
    }


}
