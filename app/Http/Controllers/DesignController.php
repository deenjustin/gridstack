<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designs= Design::all();
        $designs= Design::orderBy('id','desc')->get();
        return view('design.index', compact('designs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('design.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Design::create([
            'cname'=>$request->name,
            'cdata'=>$request->content,
        ]);
        return redirect(url('content'))->with('success','Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mid=decrypt($id);
        $design = Design::find($mid);
        return view('design.view', compact('design'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mid=decrypt($id);
        $design = Design::find($mid);
        return view('design.edit', compact('design'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mid=decrypt($id);
        $design = Design::find($mid);
        $design->update([
            'cname'=>$request->name,
            'cdata'=>$request->content,
        ]);
        return redirect(url('content'))->with('success','Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mid=decrypt($id);
        $design = Design::find($mid);
        $design->delete();
        return redirect(url('content'))->with('success','Successfully Deleted');
    }
}
