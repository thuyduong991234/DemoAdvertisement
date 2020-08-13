<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlaylistPost;
use App\Http\Requests\UpdatePlaylistPut;
use App\Models\Content;
use App\Models\Playlist;
use App\Models\PlaylistSlot;
use App\Models\Slot;
use App\Transformers\ContentTransformer;
use App\Transformers\PlaylistTransformer;
use App\Transformers\SlotTransformer;
use Flugg\Responder\Facades\Transformation;
use Illuminate\Http\Request;

class PlaylistController extends Controller
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
        $playlist = Playlist::filter($param)->get();

        //dd($contents);
        return responder()->success($playlist, PlaylistTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StorePlaylistPost $request)
    {
        //
        try {
            $this->authorize('create',Playlist::class);
            $playlist = Playlist::create($request->except('slots'));
            //$playlist = new Playlist();
            //$playlist->fill($request->except('slots'));
            $playlist->seconds = 0;
            foreach ($request->input('slots') as $slot)
            {
                $new = new PlaylistSlot();
                $new->fill($slot);
                $new->playlist_id = $playlist->id;
                $new->save();
                $playlist->seconds += $slot['seconds'];
            }
            $playlist->save();
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
    public function show(Playlist $playlist)
    {
        //
        return responder()->success($playlist, PlaylistTransformer::class)->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdatePlaylistPut $request, Playlist $playlist)
    {
        //
        try {
            $this->authorize('update', Playlist::class);
            $playlist->update($request->except('slots'));
            $playlist->seconds = 0;
            foreach ($request->input('slots') as $slot)
            {
                PlaylistSlot::where('id',$slot['id'])
                    ->update(['seq' => $slot['seq']]);
                $playlist->seconds += $slot['seconds'];
            }
            $playlist->save();
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
    public function destroy(Playlist $playlist)
    {
        //
        try {
            $this->authorize('delete', Playlist::class);
            $playlist->delete();
            return responder()->success(['Deleted successfully!'])->respond();
        }
        catch (\Exception $e)
        {
            return responder()->error()
                ->data(["message" => $e->getMessage()])
                ->respond(401);
        }
    }

    public function totalSize(Playlist $playlist)
    {
        $listContent = Content::join('slot_contents','slot_contents.content_id','=','contents.id')
            ->join('playlist_slots','playlist_slots.slot_id','=','slot_contents.slot_id')
            ->where('playlist_slots.playlist_id','=',$playlist->id)
            ->get()->toArray();
        $listSize = array_column($listContent, 'size');
        return responder()->success(['totalSize' => array_sum($listSize)])->respond();
    }
}
