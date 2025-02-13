<?php
namespace App\Repositories\Test;

use App\Models\Test\TestCategory;

class TestCategoryRepository
{

    public function save($data)
    {
        return TestCategory::create([
            'name'        => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function update($id, $data)
    {
        TestCategory::findOrFail($id);
    }

    public function delete($id)
    {
        $model = TestCategory::findOrFail($id);
    }
}
