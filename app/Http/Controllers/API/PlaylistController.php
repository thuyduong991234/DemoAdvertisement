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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

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
            $playlist->seconds = 0;
            if($request->has('slots')) {
                $listSlots = $request->input('slots');
                $listSlots = array_map(function ($item) use ($playlist) {
                    $playlist->seconds += $item['seconds'];
                    $item['id'] = (string)Str::uuid();
                    $item['playlist_id'] = $playlist->id;
                    $item['created_at'] = strtotime(Carbon::now());
                    return $item;
                }, $listSlots);
                PlaylistSlot::insert($listSlots);
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
            if($request->has('slots'))
            {
                $playlist->seconds = 0;
                $playlistSlotInstance = new PlaylistSlot();
                $value = $request->input('slots');
                $index = 'id';
                $listSeconds = array_column($value, 'seconds');
                \Batch::update($playlistSlotInstance, $value, $index);

                $playlist->seconds += array_sum($listSeconds);
                $playlist->save();
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
        $query = (new Playlist())->newQuery();
        $size = $query->where('id', $playlist->id)->withCount(['contents as sum' => function (Builder $query){
            return $query->select(DB::raw('sum(size)'));
        }])->first()->sum;
        return responder()->success(['totalSize' => $size])->respond();
        /*$totalSize = Content::join('slot_contents','slot_contents.content_id','=','contents.id')
            ->join('playlist_slots','playlist_slots.slot_id','=','slot_contents.slot_id')
            ->where('playlist_slots.playlist_id','=',$playlist->id)
            ->get()
            ->sum('size');
        return responder()->success(['totalSize' => $totalSize])->respond();
        */
    }
}
