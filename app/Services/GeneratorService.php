<?php

namespace App\Services;

use App\Models\Generator;

class GeneratorService extends CommonService
{
    public function connection()
    {
        return new Generator();
    }

    public function getProductById($id)
    {
        return $this->connection()->query()->where('id', $id)->first();
    }

    public function update($id, array $data)
    {
        return $this->connection()->query()->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return $this->connection()->query()->where('id', $id)->delete();
    }
}
