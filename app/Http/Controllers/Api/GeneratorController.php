<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneratorRequest;
use App\Http\Requests\UpdateGeneratorRequest;
use App\Http\Resources\GeneratorResource;
use App\Models\Generator;
use App\Services\GeneratorService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    use HttpResponses;
    protected $generator;

    public function __construct(GeneratorService $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generators = Generator::when(request('watt'), function($query) {
                        $query->whereBetween('watt', [request('watt')*0.9, request('watt')*1.1]);
                    })
                    ->when(request('price'), function($query) {
                        $query->whereBetween('generator_price', [request('price')*0.9, request('price')*1.1]);
                    })
                    ->with('brand')->get();

        return $this->success('success', GeneratorResource::collection($generators), 'Generators retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGeneratorRequest $request)
    {
        $validated = $request->validated();

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $this->generator->handleFileUpload($image);

            if($filename) {
                $validated['image'] = $filename;
            }
            else {
                return $this->fail('error', null, 'Image upload failed', 400);
            }
        }

        $generator = $this->generator->insert($validated);

        if(!$generator) {
            return $this->fail('error', null, 'Failed to create generator.', 400);
        }
        return $this->success('success', GeneratorResource::make($generator), 'Generator created successfully', 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $generator = $this->generator->getProductById($id);
        if(!$generator) {
            return $this->fail('error', null, 'Generator not found', 404);
        }
        $generator->load('brand');

        return $this->success('success', GeneratorResource::make($generator), 'Generator retrieved successfully', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeneratorRequest $request, string $id)
    {
        $validated = $request->validated();
        $generator = $this->generator->getProductById($id);

        if($request->hasFile('image')) {

            $oldPath = 'images/generators/'.$generator->image;
            $this->generator->deleteFile($oldPath);

            $image = $request->file('image');
            $filename = $this->generator->handleFileUpload($image);

            if(!$filename) {
                return $this->fail('error', null, 'Image update failed', 400);
            }
            $validated['image'] = $filename;

        } else {
            $validated['image'] = $generator->image;
        }
        $this->generator->update($id, $validated);

        $updatedGenerator = $this->generator->getProductById($id);
        if($updatedGenerator) {
            $updatedGenerator->load('brand');
        }

        return $this->success('success', GeneratorResource::make($updatedGenerator), 'Generator updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $generator = $this->generator->getProductById($id);

        if(!$generator) {
            return $this->fail('error', null, 'Generator not found', 404);
        }
        if($generator->image) {
            $path = 'images/generators/'.$generator->image;
            $this->generator->deleteFile($path);
        }

        $result = $this->generator->destroy($id);
        if($result) {
            return $this->success('success', null, 'Generator deleted successfully', 200);
        }

        return $this->fail('error', null, 'Failed to delete generator', 400);
    }
}
