<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\People\AddPeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::search()->paginate(4)->withQueryString();
        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view('people.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPeopleRequest $request)
    {
        try {
            $file_name = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads'), $file_name);
            $request->merge(['avatar' => $file_name]);

            People::create($request->all());
            return redirect()->route('people.index')->with('message', 'Insert Data Succesfully');
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
        $provinces = Province::all();
        $people = People::find($id);
        return view('people.update', compact('provinces', 'people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleRequest $request, $id)
    {
        try {
            $file_name = People::find($id)->avatar;

            if ($request->has('image')) {
                $file_name = time() . $request->image->getClientOriginalName();
                unlink('uploads/' . People::find($id)->avatar);
                $request->image->move(public_path('uploads'), $file_name);
            }
            $request->merge(['avatar' => $file_name]);
            People::find($id)->update($request->all());
            return redirect()->route('people.index')->with('message', 'Update Data Succesfully');
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
            $people = People::find($id);
            unlink('uploads/' . $people->avatar);
            $people->delete();
            return redirect()->route('people.index')->with('message', 'Delete Data Succesfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
