<?php
namespace App\Http\Controllers\Api\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestCategoryRequest;
use App\Http\Resources\Test\TestCategoryResource;
use App\Services\Test\TestCategoryService;
use Illuminate\Http\Request;

class TestCategoryController extends Controller
{
    private TestCategoryService $testCategoryService;

    public function __construct(TestCategoryService $testCategoryService)
    {
        $this->testCategoryService = $testCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestCategoryRequest $request)
    {
        $testCategory = $this->testCategoryService->save($request->toArray());

        return response()->json([
            'status'  => 200,
            'data'    => [
                'testCategory' => new TestCategoryResource($testCategory),
            ],
            'message' => 'saved Successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
