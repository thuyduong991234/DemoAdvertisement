<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlotPost;
use App\Http\Requests\UpdateSlotPut;
use App\Models\Content;
use App\Models\Slot;
use App\Models\SlotContent;
use App\Transformers\SlotTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Mavinoo\Batch\Batch;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        //
        $param = $request->all();
        $slots = Slot::filter($param)->get();

        //dd($contents);
        return responder()->success($slots, SlotTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * @return
     */
    public function store(StoreSlotPost $request)
    {
        //
        try {
            $this->authorize('create', Slot::class);
            $slot = Slot::create($request->except('contents'));
            $listContents = $request->input('contents');
            $listContents = array_map(function ($item) use ($slot) {
                $item['id'] = (string)Str::uuid();
                $item['slot_id'] = $slot->id;
                $item['created_at'] = strtotime(Carbon::now());
                return $item;
            }, $listContents);
            SlotContent::insert($listContents);
            return responder()->success(['Saved successfully!'])->respond();
        } catch (\Exception $e) {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return
     */
    public function show(Slot $slot)
    {
        //
        return responder()->success($slot, SlotTransformer::class)->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param
     * @param
     * @return
     */
    public function update(UpdateSlotPut $request, Slot $slot)
    {
        //
        try {
            $this->authorize('update', Slot::class);
            $slot->update($request->except('contents'));
            $slotContentInstance = new SlotContent();
            $value = $request->input('contents');
            $index = 'id';

            \Batch::update($slotContentInstance, $value, $index);
            return responder()->success(['Saved successfully!'])->respond();
        } catch (\Exception $e) {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return
     */
    public function destroy(Slot $slot)
    {
        try {
            $this->authorize('delete', Slot::class);
            $slot->delete();
            return responder()->success(['Deleted successfully!'])->respond();
        } catch (\Exception $e) {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }
}
