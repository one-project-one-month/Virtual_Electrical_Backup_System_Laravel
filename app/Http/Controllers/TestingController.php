<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculationRequest;
use App\Services\BatteryService;
use App\Services\InverterService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Resources\CalculationResource;

class TestingController extends Controller
{
    //
    use HttpResponses;
    protected $batteryService;
    protected $inverterService;

    public function __construct(BatteryService $batteryService, InverterService $inverterService)
    {
        $this->batteryService = $batteryService;
        $this->inverterService = $inverterService;
    }

    public function calculate(CalculationRequest $request)
    {
        try {
            $battery_id = $request->battery_id;
            $inverter_id = $request->inverter_id;

            $battery = $this->batteryService->getDataById($battery_id);
            $inverter = $this->inverterService->getInverterById($inverter_id);

            $battery_capacity = $battery->storage_amp;
            $battery_volt = $battery->battery_volt;
            $battery_efficiency = $battery->BatteryType->percentage;

            $inverter_efficiency = $inverter->inverterType->efficiency;
            $inverter_watt = $inverter->watt;

            $watt = $request->watt;

            list($hours, $minutes) = $this->calculateRuntime($battery_capacity, $inverter_efficiency, $inverter_watt, $battery_volt, $battery_efficiency, $watt);

            // return response()->json(['runtime' => "$hours hours $minutes minutes"]);

            $return_data = CalculationResource::make((object) ['hours' => $hours, 'minutes' => $minutes]);

            return $this->success(true, $return_data, 'success', 200);


        } catch (\Exception $e) {
            // Catch any exception and return a meaningful error message
            return response()->json(['error' => 'An error occurred during calculation: ' . $e->getMessage()], 500);
        }
    }

    private function calculateRuntime($battery_capacity, $inverter_efficiency, $inverter_watt, $battery_volt, $battery_efficiency, $watt)
    {
        try {
            // Basic validation for inputs
            if ($battery_capacity <= 0 || $battery_volt <= 0 || $inverter_watt <= 0 || $watt <= 0) {
                throw new \InvalidArgumentException('All input values must be greater than zero');
            }

            // Perform calculations
            $battery_Wh_before_eff = $battery_capacity * $battery_volt;
            $battery_Wh = $battery_Wh_before_eff * $battery_efficiency;
            $inverter_Wh = $battery_Wh * $inverter_efficiency;
            $inverter_wattage = $inverter_watt * $inverter_efficiency;

            // Check if requested wattage exceeds inverter's capacity
            if ($watt > $inverter_wattage) {
                throw new \RuntimeException('Wattage exceeds inverter capacity');
            }

            $runtime = $inverter_Wh / $watt;

            // Calculate hours and minutes
            $hours = floor($runtime);
            $minutes = round(($runtime - $hours) * 60);

            return [$hours, $minutes];
        } catch (\InvalidArgumentException $e) {
            // Handle specific input validation error
            throw $e;  // Rethrow for higher level catch
        } catch (\RuntimeException $e) {
            // Handle runtime-specific error
            throw $e;  // Rethrow for higher level catch
        } catch (\Exception $e) {
            // Catch any other general exceptions
            throw new \Exception('Error in calculation: ' . $e->getMessage());
        }
    }
}