<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetupRequest;
use App\Http\Resources\SetupResource;
use App\Models\Battery;
use App\Models\Setup;
use App\Services\SetupService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    use HttpResponses;
    protected $setup;

    public function __construct(SetupService $setup)
    {
        $this->setup = $setup;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setups = Setup::with('inverter', 'battery')->get();

        return $this->success('success', SetupResource::collection($setups), 'Setups retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SetupRequest $request)
    {
        $validated = $request->validated();

        $inverter = Inverter::find($validated['inverter_id']);
        $battery = Battery::find($validated['battery_id']);

        if (!$inverter || !$battery) {
            return $this->fail('error', null, 'Invalid inverter or battery ID', 400);
        }

        // Calculate Total Price
        $setup_price = $this->setup->calculateTotalPrice($inverter->inverter_price, $battery->battery_price);
        $validated['setup_price'] = $setup_price;

        //Setup Total Watt = Inverter Watt
        $validated['total_watt'] = $inverter->watt;

        $setup = $this->setup->insert($validated);
        if($setup) {
            $setup->load('inverter', 'battery');
            return $this->success('success', SetupResource::make($setup), 'New setup created successfully', 201);
        }

        return $this->fail('error', null, 'Failed to create setup', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $setup = $this->setup->getDataById($id);
        if(!$setup) {
            return $this->fail('error', null, 'Setup not found', 404);
        }
        $setup->load('inverter', 'battery');

        return $this->success('success', SetupResource::make($setup), 'Setup retrieved successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SetupRequest $request, string $id)
    {
        $validated = $request->validated();

        $inverter = Inverter::find($validated['inverter_id']);
        $battery = Battery::find($validated['battery_id']);

        if (!$inverter || !$battery) {
            return $this->fail('error', null, 'Invalid inverter or battery ID', 400);
        }

        // Calculate Total Price
        $setup_price = $this->setup->calculateTotalPrice($inverter->inverter_price, $battery->battery_price);
        $validated['setup_price'] = $setup_price;

        // Setup Total Watt = Inverter Watt
        $validated['total_watt'] = $inverter->watt;

        $this->setup->update($id, $validated);

        $updatedSetup = $this->setup->getProductById($id);
        if($updatedSetup) {
            $updatedSetup->load('inverter', 'battery');
            return $this->success('success', SetupResource::make($updatedSetup), 'Setup updated successfully', 200);
        }

        return $this->fail('error', null, 'Failed to create setup', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setup = $this->setup->destroy($id);
        if($setup) {
            return $this->success('success', null, 'Setup Deleted Successfully', 200);
        }

        return $this->fail('error', null, 'Failed to delete setup', 400);
    }
}
