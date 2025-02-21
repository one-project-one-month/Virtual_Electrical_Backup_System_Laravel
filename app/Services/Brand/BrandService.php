<?php
namespace App\Services\Brand;

use App\Models\Brand;
use App\Services\CommonService;

class BrandService extends CommonService
{

    public function connection(){
        return new Brand();
    }

    public function getAllData ()
    {
        return $this->connection()->all();
    }
    public function insert(array $data)
    {
        return $this->connection()->query()->create($data);
    }
    public function getDataById($id)
    {
        return $this->connection()->query()->where('id', $id)->first();
    }
    public function update(array $data, $id){
        return $this->connection()->query()->where('id',$id)->update($data);
    }

    public function destroy($id){
        return $this->connection()->query()->where('id',$id)->delete();
    }
}
