<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('admin.panel', [
            'menus' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $menu = new Menu;

        $menu->name = $request->get('name');
        $menu->link = $request->get('link');
        $menu->icon = $request->get('icon');
        if ($request->get('ketua')) {

            $menu->ketua = "1";
        }
        if ($request->get('anggota')) {

            $menu->anggota = "1";
        }
        // dd($menu);
        $menu->save();
        return redirect('/admin/panel/')->with('success', 'Panel berhasil diedit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $menu = Menu::where('id', $id)->first();
        if ($request->get('name')) {

            $menu->name = $request->get('name');
            $menu->save();
        }
        if ($request->get('link')) {

            $menu->link = $request->get('link');
            $menu->save();
        }
        if ($request->get('icon')) {

            $menu->icon = $request->get('icon');
            $menu->save();
        }
        if ($request->get('ketua')) {
            if($request->get('ketua') == "false"){
                $menu->ketua = "0"; 
            }else{
                $menu->ketua = $request->get('ketua');
            }
            $menu->save();
        }
        if ($request->get('anggota')) {
            if($request->get('anggota') == "false"){
                $menu->anggota = "0"; 
            }else{
                $menu->anggota = $request->get('anggota');
            }
            $menu->save();
        }

        return redirect('/admin/panel/')->with('success', 'Panel berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect('/admin/panel')->with('success', 'Panel berhasil dihapus');
    }
}
