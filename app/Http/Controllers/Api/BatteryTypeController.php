<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBatteryTypeRequest;
use App\Http\Requests\UpdateBatteryTypeRequest;
use App\Http\Resources\BatteryTypeResource;
use App\Services\BatteryTypeService;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class BatteryTypeController extends Controller
{
    use HttpResponses;
    protected $batteryTypeService;

    public function __construct(BatteryTypeService $BatteryTypeService)
    {
        $this->batteryTypeService = $BatteryTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $battery_type_list = BatteryTypeResource::collection($this->batteryTypeService->getAllData());
        return $this->success(true, $battery_type_list, 'success', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBatteryTypeRequest $request)
    {
        //
        $validateData = $request->validated();
        $battery_type = $this->batteryTypeService->insert($validateData);
        $resbattery_type = BatteryTypeResource::make($battery_type);
        if ($battery_type) {
            return $this->success(true, $resbattery_type, 'Successfully created', 200);
        } else {
            return $this->fail(false, null, 'Fail', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $battery_type = BatteryTypeResource::make($this->batteryTypeService->getDataById($id));
        return $this->success(true, $battery_type, "successfully retrieved", 200);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBatteryTypeRequest $request, string $id)
    {
        $validateData = $request->validated();

        $battery_type = $this->batteryTypeService->update($validateData, $id);
        $resbattery_type = BatteryTypeResource::make($this->batteryTypeService->getDataById($id));

        if ($battery_type) {
            return $this->success(true, $resbattery_type, 'successfully updated', 200);
        } else {
            return $this->fail(false, null, 'update failed', 404);
        }
        // try {

        // } catch (\Exception $e) {
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $battery_type = $this->batteryTypeService->destroy($id);
        return $this->success(true, $battery_type, 'successfully deleted', 200);
    }
}