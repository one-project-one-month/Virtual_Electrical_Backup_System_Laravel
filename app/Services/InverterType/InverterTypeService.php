<?php


namespace App\Services\InverterType;

use App\Models\InverterType\InverterType;
use App\Services\CommonService;

class InverterTypeService extends CommonService{
    public function connection(){
        return new InverterType();
    }

    public function getInverterTypeId($id){
        return $this->connection()->query()->findOrFail($id);
    }

    public function update($data,$id){
        $inverterType=  $this->connection()->query()->findOrFail($id);
        $inverterType->update($data);
        return $inverterType;
    }

    public function destroy($id){
        return $this->getDataById($id)->delete();
    }
}
