<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBatteryRequest;
use App\Http\Requests\UpdateBatteryRequest;
use App\Http\Resources\BatteryResource;
use App\Services\BatteryService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use HttpResponses;

    protected $batteryService;

    public function __construct(BatteryService $batteryService)
    {
        $this->batteryService = $batteryService;
    }

    public function index()
    {
        //
        $battery_list = BatteryResource::collection($this->batteryService->getAllData());
        if ($battery_list) {
            return $this->success(true, $battery_list, 'Successfully retrieved', 200);
        } else {
            return $this->fail(false, null, 'data retrieve failed', 404);
        }
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
    public function store(StoreBatteryRequest $request)
    {
        //
        $validateData = $request->validated();
        $battery = BatteryResource::make($this->batteryService->insert($validateData));
        if ($battery) {
            return $this->success(true, $battery, 'Successfully created', 200);
        } else {
            return $this->fail(false, null, 'Data creation failed', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $battery = BatteryResource::make($this->batteryService->getDataById($id));
        if ($battery) {
            return $this->success(true, $battery, 'Successfully retrieved', 200);
        } else {
            return $this->fail(false, null, 'data retrieve failed', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $battery = BatteryResource::make($this->batteryService->getDataById($id));
        if ($battery) {
            return $this->success(true, $battery, 'Successfully retrieved', 200);
        } else {
            return $this->fail(false, null, 'data retrieve failed', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBatteryRequest $request, string $id)
    {
        $validateData = $request->validated();
        $update = $this->batteryService->update($validateData, $id);
        $resBattery = BatteryResource::make($this->batteryService->getDataById($id));
        if ($update) {
            return $this->success(true, $resBattery, 'Successfully updated', 200);
        } else {
            return $this->fail(false, null, 'fail', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $battery = $this->batteryService->destroy($id);
        if ($battery) {
            return $this->success(true, $battery, "Successfully deleted", 200);
        } else {
            return $this->fail(false, null, "Delete Failed", 404);
        }
    }
}