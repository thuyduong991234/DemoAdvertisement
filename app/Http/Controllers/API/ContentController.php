<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentPost;
use App\Http\Requests\UpdateContentPut;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $param = $request->all();
        $contents = Content::filter($param);

        //dd($contents);
        return response($contents->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * @return
     */
    public function store(StoreContentPost $request)
    {
        //
        $content = new Content();
        if($request->has('url'))
        {
            if($request->hasFile('url'))
            {
                $fileName = time() . '.' . $request->file('url')->getClientOriginalExtension();
                $link = $request->file('url')->storeAs('',$fileName, 'public');
                $content->fill($request->except('url'));
                $content->url = 'storage/' . $link;
                $content->content_type = 1;
                $content->save();
            }
            else
            {
                $content->fill($request->all());
                $content->content_type = $request->input('url') === null ? 0 : 2;
                $content->save();
            }
        }
        else
        {
            $content->fill($request->all());
            $content->save();
        }
        return responder()->success(['Saved successfully'])->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function show(Content $content)
    {
        //
        return responder()->success($content)->respond();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param
     * @param
     * @return
     */
    public function update(Request $request, Content $content)
    {
        //return $request->all();
        //
        //dd($request);
        if($request->has('url'))
        {
            $oldname = $content->content_type == 1 ? explode('/', $content->url)[1] : null;
            Storage::disk('public')->delete($oldname);
            if($request->hasFile('url'))
            {
                $fileName = time() . '.' . $request->file('url')->getClientOriginalExtension();
                $link = $request->file('url')->storeAs('',$fileName, 'public');
                $content->fill($request->except('url'));
                $content->url = 'storage/' . $link;
                $content->content_type = 1;
                $content->save();
            }
            else
            {
                $content->fill($request->all());
                $content->content_type = $request->input('url') === null ? 0 : 2;
                $content->save();
            }
        }
        else
        {
            $content->content_type = 0;
            $content->update($request->all());
        }

        return responder()->success(['Updated successfully'])->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     */
    public function destroy(Content $content)
    {
        //
        $filename = $content->content_type == 1 ? explode('/', $content->url)[1] : null;
        if(Storage::disk('public')->exists($filename))
            Storage::disk('public')->delete($filename);
        $content->delete();
        return responder()->success(['Deleted successfully!'])->respond();
    }
}
