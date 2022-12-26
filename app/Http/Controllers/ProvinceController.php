<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\Province\AddProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::search()->paginate(3)->withQueryString();
        return view('province.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProvinceRequest $request)
    {
        try {
            Province::create($request->all());
            return redirect()->route('province.index')->with('message', 'Insert Data Successful');
        } catch (\Throwable $th) {
            dd($th);
        }
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
        $province = Province::find($id);

        return view('province.update', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinceRequest $request, $id)
    {
        try {
            Province::find($id)->update($request->all());
            return redirect()->route('province.index')->with('message', 'Update Data Successful');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $province = Province::find($id);
            if ($province->people->count() > 0) {
                return redirect()->route('province.index')->with('message', 'Delete Data Failed, This Data Has Record');
            } else {
                $province->delete();
                return redirect()->route('province.index')->with('message', 'Delete Data Successful');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
