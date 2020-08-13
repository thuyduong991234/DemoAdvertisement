<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlotPost;
use App\Models\Content;
use App\Models\Slot;
use App\Models\SlotContent;
use App\Transformers\SlotTransformer;
use Illuminate\Http\Request;

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
            foreach ($request->input('contents') as $content)
            {
                $new = new SlotContent();
                $new->fill($content);
                //$new->content_id = $content->id;
                $new->slot_id = $slot->id;
                $new->save();
            }
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
    public function update(Request $request, Slot $slot)
    {
        //
        try {
            $this->authorize('update', Slot::class);
            $slot->update($request->except('contents'));
            foreach ($request->input('contents') as $content)
            {
                SlotContent::where('content_id',$content['content_id'])
                    ->where('slot_id','=',$slot->id)
                    ->update(['seq' => $content['seq']]);
            }
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
     * @param
     * @return
     */
    public function destroy(Slot $slot)
    {
        //
        //$this->authorize('delete', Slot::class);
        try {
            $this->authorize('delete', Slot::class);
            $slot->delete();
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
