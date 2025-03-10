<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Inverter;
use App\Services\CommonService;

class InverterService extends CommonService
{
    public function connection()
    {
        return new Inverter;
    }

    public function getAllInverterData()
    {
        return $this->connection()->all();
    }

    public function getInverterById($id)
    {
        return $this->connection()->with('brand', 'inverterType')->where('id', $id)->first();
    }

    public function getImage($img)
    {
        if (isset($img)) {
            $file = $img;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/', $filename, 'public');
            return $filename;
        }
    }

    public function insertInverter(array $data)
    {
        if (isset($data['image'])) {
            return $this->connection()->create($data);
        } else {
            return null;
        }
    }

    public function updateInverter(array $data, $id)
    {
        return $this->connection()->where('id', $id)->update($data);
    }

    public function destroyInverter($id)
    {
        return $this->connection()->destroy($id);
    }

    public function filterInverter($data)
    {
        return $this->connection()->with('brands')->filter($data)->get();
    }
}
