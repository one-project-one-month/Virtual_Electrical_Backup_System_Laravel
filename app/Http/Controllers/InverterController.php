<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInverterRequest;
use App\Http\Requests\UpdateInverterRequest;
use App\Http\Resources\InverterResource;
use App\Models\Inverter;
use App\Services\InverterService;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Http\Request;

class InverterController extends Controller
{
    use HttpResponses;

    protected $inverterService;
    public function __construct(InverterService $inverterService)
    {
        $this->inverterService = $inverterService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inverter = InverterResource::collection($this->inverterService->getAllInverterData());
        return $this->success(true, $inverter, 'success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInverterRequest $request)
    {
        //
        try {
            if ($request->hasFile('image')) {
                $file = $this->inverterService->getImage($request->file('image'));

                $data = $request->validated();
                $data['image'] = $file;

                $inverter = $this->inverterService->insertInverter($data);
                $inverter_data = InverterResource::make($inverter);
                if ($inverter !== null) {
                    return $this->success(true, $inverter_data, 'New Inverter Inserted', 200);
                } else {
                    return $this->fail(false, null, 'Fail', 404);
                }
            }
        } catch (Exception $e) {
            return $this->fail(false, null, $e->getMessage(), 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $inverter = InverterResource::make($this->inverterService->getInverterById($id));
        return $this->success(true, $inverter, 'Retrieve Success', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInverterRequest $request, string $id)
    {
        try{
            $data = $this->inverterService->getInverterById($id);
            if (!$data) {
                return $this->fail(false, null, 'Inverter Not Found', 404);
            }

            $file = $data->image;
            $inverter = $request->validated();
            if ($request->hasFile('image')) {
                if ($file && Storage::has($file)) {
                    Storage::delete($file);
                }
                $image = $request->file('image');
                $inverter['image'] = $this->inverterService->getImage($image);
            }

            $updated = $this->inverterService->updateInverter($inverter, $id);
            $updatedInv = InverterResource::make($this->inverterService->getInverterById($id));

            return $updated
                ? $this->success(true, $updatedInv, 'Updated Successfully', 200)
                : $this->fail(false, null, 'Update Failed', 404);

        }
        catch(Exception $e){
            return $this->fail(false, null, $e->getMessage(), 404 );
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $del = $this->inverterService->destroyInverter($id);
        return $this->success(true, $del, 'Inverter Deleted', 200);
    }
}
