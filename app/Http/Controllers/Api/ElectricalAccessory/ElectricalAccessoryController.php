<?php

namespace App\Http\Controllers\Api\ElectricalAccessory;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Models\ElectricalAccessory\ElectricalAccessory;
use App\Services\ElectricalAccessory\ElectricalAccessoryService;
use App\Http\Requests\ElectricalAccessory\ElectricalAccessoryRequest;
use App\Http\Resources\ElectricalAccessory\ElectircalAccessoryResource;
use App\Http\Requests\ElectricalAccessory\UpdateElectricalAccessoryRequest;

class ElectricalAccessoryController extends Controller
{
    use HttpResponses;
    protected $electricalAccessoryService;

    public function __construct(ElectricalAccessoryService $electricalAccessoryService){
        $this->electricalAccessoryService=$electricalAccessoryService;
    }

    public function index(){
       $electricalAccessoryList=ElectircalAccessoryResource::collection(ElectricalAccessory::latest()->get());
        return $this->success('success',$electricalAccessoryList,'electricalAccessories fetched successfully',200);
    }

    public function store(ElectricalAccessoryRequest $request){
        $validatedData=$request->validated();
       $createElectricalAccessory=ElectircalAccessoryResource::make($this->electricalAccessoryService->insert($validatedData));

       if ($createElectricalAccessory) {
       return $this->success('success',$createElectricalAccessory,'created successfully',201);
       }else{
        return $this->fail('error',null,'something went wrong',500);
       }
    }

    public function show(ElectricalAccessory $electricalAccessory){
       $showedElectricalAccessory=ElectircalAccessoryResource::make($this->electricalAccessoryService->getElectricalById($electricalAccessory->id));

       if ($showedElectricalAccessory) {
       return $this->success('success',$showedElectricalAccessory,'showed successfully',200);
       }else{
        return $this->fail('error',null,'something went wrong',500);
       }
    }

    public function update(UpdateElectricalAccessoryRequest $request, ElectricalAccessory $electricalAccessory){
        $data=$request->validated();
        $updated=ElectircalAccessoryResource::make($this->electricalAccessoryService->updateElectricalAccessory($data,$electricalAccessory->id));

        if ($updated) {
        return $this->success('success',$updated,'updated successfully',200);
        }else{
         return $this->fail('error',null,'something went wrong',500);
        }
     }

     public function destroy(ElectricalAccessory $electricalAccessory){
        $deleted=ElectircalAccessoryResource::make($this->electricalAccessoryService->deletedById($electricalAccessory->id));

        if ($deleted) {
        return $this->success('success',null,'deleted successfully',204);
        }else{
         return $this->fail('error',null,'something went wrong',500);
        }
     }
}
