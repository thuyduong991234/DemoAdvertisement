<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDevicePost;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = $request->all();
        $devices = Device::filter($param);
        return response($devices->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StoreDevicePost $request)
    {
        //
        try {
            $this->authorize('update', Device::class);
            Device::create($request->all());
            return responder()->success(['Saved successfully!'])->respond();
        }
        catch (\Exception $e)
        {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Device $device)
    {
        return responder()->success($device)->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Device $device)
    {
        //
        try {
            $this->authorize('update', Device::class);
            $device->update($request->all());
            return responder()->success(['Saved successfully!'])->respond();
        }
        catch (\Exception $e)
        {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Device $device)
    {
        try {
            $this->authorize('delete', Device::class);
            $device->delete();
            return responder()->success(['Deleted successfully!'])->respond();
        }
        catch (\Exception $e)
        {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }
}
