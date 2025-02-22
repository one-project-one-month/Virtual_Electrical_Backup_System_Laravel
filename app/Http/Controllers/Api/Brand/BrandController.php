<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Brand\BrandService;
use App\http\Requests\Brand\BrandRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Traits\HttpResponses;
use Exception;

class BrandController extends Controller
{
    protected $brandService;
    use HttpResponses;

    public function __construct(BrandService $brandService){

        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $brand_list = BrandResource::collection($this->brandService->getAllData());
            return $this->success(true, $brand_list, 'success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $brandRequest)
    {
        $validateData = $brandRequest->validated();
        $brand = $this->brandService->insert($validateData);
        $resBrand = BrandResource::make($brand);
        if ($brand) {
            return $this->success(true, $resBrand, 'Successfully Created', 200);
        } else {
            return $this->fail(false, null, 'Fail', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $brand = BrandResource::make($this->brandService->getDataById($id));

        return $this->success(true, $brand, "Successfully Retrieved", 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $brand = BrandResource::make($this->brandService->getDataById($id));
        
        return $this->success(true, $brand, "Successfully Retrieved", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $brandRequest, $id)
    {
        //
        $validateData = $brandRequest->validated();
        $brand = $this->brandService->update($validateData, $id);
        $resBrand = BrandResource::make ($this->brandService->getDataById($id));
        
        if ($brand) {
            return $this->success(true, $resBrand, 'Successfully Updated', 200);
        } else {
            return $this->fail(false, null, 'Fail', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand = $this->brandService->destroy($id);
        return $this->success(true, $brand, 'Successfully Deleted', 200);
    }
}
