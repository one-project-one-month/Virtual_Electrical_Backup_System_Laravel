<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\PowerStation;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\PowerStationService;
use App\Http\Resources\PowerStationResource;
use App\Http\Requests\PowerStation\StorePowerStationRequest;
use App\Http\Requests\PowerStation\UpdatePowerStationRequest;

class PowerStationController extends Controller
{
    use HttpResponses;
    protected $power_station;

    public function __construct(PowerStationService $power_station)
    {
        $this->power_station = $power_station;
    }

    public function index(){
        $power_stations = PowerStation::with('brand')->get();

        return $this->success('success', PowerStationResource::collection($power_stations), "Power stations are retrieve successfully!",200);
    }

    public function store(StorePowerStationRequest $request)
    {
        $validated = $request->validated();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $this->power_station->handleFileUpload($image);

            if($filename) {
                $validated['image'] = $filename;
            }
            else {
                return $this->fail('error', null, 'Image upload failed', 400);
            }
        }

        $power_station = $this->power_station->insert($validated);

        if($power_station) {
            return $this->success('success', PowerStationResource::make($power_station), 'power_station created successfully', 201);
        }
        else {
            return $this->fail('error', null, 'Failed to create power_station.', 400);
        }

    }

    public function show(string $id){
        $power_station = $this->power_station->getDataById($id);

        if(!$power_station){
            return $this->fail('not-found',null,'Power station not found',404);
        }

        return $this->success('success', PowerStationResource::make($power_station), "Power Station retrive successfully!",404);
    }

    public function update(UpdatePowerStationRequest $request, string $id)
    {
        $validated = $request->validated();

        $power_station = $this->power_station->getDataById($id);
        if(!$power_station) {
            return $this->fail('error', null, 'Power station not found', 404);
        }

        if($request->hasFile('image')) {

            $oldPath = 'images/power_stations/'.$power_station->image;
            $this->power_station->deleteFile($oldPath);

            $image = $request->file('image');
            $filename = $this->power_station->handleFileUpload($image);

            if(!$filename) {
                return $this->fail('error', null, 'Image update failed', 400);
            }
            $validated['image'] = $filename;

        } else {
            $validated['image'] = $power_station->image;
        }

        $this->power_station->update($id, $validated);

        $updatedpower_station = $this->power_station->getDataById($id);
        if($updatedpower_station) {
            $updatedpower_station->load('brand');
        }

        return $this->success('success', PowerStationResource::make($updatedpower_station), 'power_station updated successfully', 200);
    }

    public function destroy(string $id)
    {
        $power_station = $this->power_station->getDataById($id);

        if(!$power_station) {
            return $this->fail('error', null, 'Power station not found', 404);
        }

        if($power_station->image) {
            $path = 'images/power_stations/'.$power_station->image;
            $this->power_station->deleteFile($path);
        }

        $this->power_station->destroy($id);

        return $this->success('success', null, 'Power station deleted successfully', 200);
    }
}
