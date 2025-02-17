<?php
namespace App\Services\Test;

use App\Models\Test\TestCategory;
use App\Services\CommonService;

class TestCategoryService extends CommonService
{
    protected $repository;

    public function connection(){
        return new TestCategory();
    }

    // public function getByParams($request)
    // {
    //     return $this->repository->getByParams($request);
    // }

    // public function getAll($request)
    // {
    //     return $this->repository->getAll($request);
    // }

    // public function findById($id)
    // {
    //     return $this->repository->findById($id);
    // }

    public function update(array $data,int $id){
        return $this->connection()->query()->where('id',$id)->update($data);
    }

    public function destroy($id){
        return $this->connection()->query()->where('id',$id)->delete();
    }
}
