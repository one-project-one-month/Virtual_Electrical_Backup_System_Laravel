<?php

namespace App\Http\Controllers\Api\InverterType;

use App\Http\Controllers\Controller;
use App\Http\Requests\InverterType\InverterTypeCreateRequest;
use App\Http\Requests\InverterType\InverterTypeUpdateRequest;
use App\Http\Resources\InverterType\InverterTypeResource;
use App\Models\InverterType\InverterType;
use App\Services\InverterType\InverterTypeService;
use App\Traits\HttpResponses;

class InverterTypeController extends Controller
{
    use HttpResponses;
    protected $inverterTypeService;

    public function __construct(InverterTypeService $inverterTypeService){
        $this->inverterTypeService=$inverterTypeService;
    }

    public function index(){
        $inverterTypeList=InverterTypeResource::collection(InverterType::latest()->get());
        return $this->success('success',$inverterTypeList,'fetching data success',200);
    }

    public function store(InverterTypeCreateRequest $request){
       $inverterType= $this->inverterTypeService->insert($request->toArray());
        if ($inverterType) {
            return $this->success('success',InverterTypeResource::make($inverterType),'successfully created',201);
        }else {
            return $this->fail('fail',$inverterType,'Something went wrong.Pls try again later',500);
        }
    }

    public function show(InverterType $inverterType){
     $inverterType=$this->inverterTypeService->getInverterTypeId($inverterType->id);
     if ($inverterType) {
        return $this->success('success',InverterTypeResource::make($inverterType),'successfully fetched',200);
      }else{
        return $this->fail('fail',InverterTypeResource::make($inverterType),'something went wrong.Pls try again later',500);
      }
    }

    public function update(InverterType $inverterType, InverterTypeUpdateRequest $request)
    {
        $updatedInverterType = $this->inverterTypeService->update($request->validated(), $inverterType->id);

        if ($updatedInverterType) {
            return $this->success('success', InverterTypeResource::make($updatedInverterType), 'successfully updated', 200);
        } else {
            return $this->fail('fail', null, 'Something went wrong. Please try again later', 500);
        }
    }


    public function destroy(InverterType $inverterType){
      $inverterType=  $this->inverterTypeService->destroy($inverterType->id);
      if ($inverterType) {
        return $this->success('success',InverterTypeResource::make($inverterType),'successfully deleted',200);
      }else{
        return $this->fail('fail',InverterTypeResource::make($inverterType),'something went wrong.Pls try again later',500);
      }
    }
}
