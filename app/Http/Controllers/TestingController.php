<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    //
    public function calculate()
    {
        try {
            $battery_capacity = 200;
            $inverter_efficiency = 0.8;
            $inverter_watt = 1500;
            $battery_volt = 24;
            $battery_efficiency = 0.8;
            $watt = 250;

            list($hours, $minutes) = $this->calculateRuntime($battery_capacity, $inverter_efficiency, $inverter_watt, $battery_volt, $battery_efficiency, $watt);

            return response()->json(['runtime' => "$hours hours $minutes minutes"]);
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
