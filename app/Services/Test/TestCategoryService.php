<?php
namespace App\Services\Test;

use App\Repositories\Test\TestCategoryRepository;

class TestCategoryService
{
    protected $repository;

    public function __construct(TestCategoryRepository $repository)
    {
        $this->repository = $repository;
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

    public function save($data)
    {
        return $this->repository->save($data);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
