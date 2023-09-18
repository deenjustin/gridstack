<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Paginator::useBootstrap();
       $layouts= Layout::all();
       $layouts= Layout::orderBy('id','desc')->paginate(10);
       return view('theme.index',compact('layouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('theme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Layout::create([
            'fname'=>$request->fname,
            'fdata'=>$request->fdata,
        ]);
        return redirect(url('layout'))->with('success','Successfully Created');
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
        $layout=Layout::find($mid);
        return view('theme.view', compact('layout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $mid=decrypt($id);
        $layout=Layout::find($mid);
        return view('theme.edit', compact('layout'));
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
        $layout=Layout::find($mid);
        $layout->update([
            'fname'=>$request->fname,
            'fdata'=>$request->fdata,
        ]);
        return redirect(url('layout'))->with('success','Update Successfully');
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
        $layout=Layout::find($mid);
        $layout->delete();
        return redirect(url('layout'))->with('success','Update Deleted');
    }
}
