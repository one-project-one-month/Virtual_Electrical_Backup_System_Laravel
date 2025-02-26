<?php

namespace App\Services;

use App\Models\Generator;
use Illuminate\Support\Facades\Storage;

class GeneratorService extends CommonService
{
    public function connection()
    {
        return new Generator();
    }

    public function handleFileUpload($image)
    {
        if($image) {
            $filename = uniqid() . '_' . $image->getClientOriginalName();

            $image->storeAs('images/generators/', $filename, 'public');

            return $filename;
        }
        else {
            return null;
        }
    }

    public function deleteFile($path)
    {
        // if($path && Storage::exists($path)) {
        //     Storage::delete($path);
        // }

        if($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        else{
            return null;
        }
    }

    public function getProductById($id)
    {
        return $this->connection()->query()->where('id', $id)->first();
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
