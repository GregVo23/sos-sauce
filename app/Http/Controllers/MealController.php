<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\MealResource;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MealResource::collection(Meal::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $rules = array(

            'name' => 'required|string|min:3|max:100',
            'description' => 'required|min:20|max:2000',
            //'picture' => 'nullable|image|mimes:jpeg,jpg,png',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'type' => 'error',
            ]);
        } else {
            $meal = new Meal;
            $meal->name = $request->name;
            $meal->description = $request->description;
            $meal->slug = Str::slug($request->name, '-');
            $meal->user_id = 1;

            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                // Get filename with the extension
                $filenameWithExt = $file->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $file->extension();
                // here is the current date time timestamp
                $time = date("d-m-Y") . "-" . time();
                // Filename to store
                $fileNameToStore = $filename . '_' . $time . '.' . $extension;
                // Upload Image

                $path = 'public/meals/' . $meal->id;
                $file->storeAs($path, $fileNameToStore);
                $meal->picture = $fileNameToStore;
                $meal->save();
                return dump($request->picture);
            } else {
                $meal->save();
                //Il faut une image
                return "Il faut une image";
            }
            return dump($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        return MealResource::make(Meal::where('slug', $slug)->first());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
