<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Recipe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $user = auth()->user();
        if ($user) {
            $meals = [];
            $user_id = $user->id;
            $listOfMeals = Meal::all();
            foreach ($listOfMeals as $meal) {

                $liked = DB::table('meal_user')->where('user_id', $user_id)
                    ->where('meal_id', $meal->id)
                    ->first();

                if (empty($liked)) {
                    $like = ["like" => false];
                } else {
                    $like = ["like" => true];
                }
                $dataMeal = json_decode(json_encode($meal), true);
                array_push($meals, ($like + $dataMeal));
            }
            return response()->json(['data' => $meals]);
        } else {
            return MealResource::collection(Meal::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $id)
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
        $meal = Meal::where('slug', $slug)->first();
        $meals = $meal->recipes->all();
        $mealIngredients = [];
        $like = ["like" => false];

        $user = auth()->user();
        if ($user) {
            $liked = DB::table('meal_user')
                ->where('user_id', $user->id)
                ->where('meal_id', $meal->id)
                ->first();

            if (empty($liked)) {
                $like = ["like" => false];
            } else {
                $like = ["like" => true];
            }
        }


        if (!$meals) {

            $mealIngredients = false;
        } elseif (count($meals) < 2) {

            $meals = Meal::where('slug', $slug)->first()->recipes->first()->ingredient;

            $mealIngredients[] =
                [
                    "id" => $meals->id,
                    "name" => $meals->name,
                    "unit" => $meals->unit,
                    "quantity" => Meal::where('slug', $slug)->first()->recipes->first()->quantity,
                ];
        } else {

            foreach ($meals[0]->ingredients as $ingredient) {
                $mealIngredients[] =
                    [
                        "id" => $ingredient->id,
                        "name" => $ingredient->name,
                        "unit" => $ingredient->unit,
                        "quantity" => $meals[0]->quantity
                    ];
            }
        }

        return response()->json([$meal, $mealIngredients, $like]);
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
    public function destroy(string $slug)
    {
        $meal = Meal::where("slug", $slug)->first();
        DB::table('meal_user')->where('meal_id', $meal->id)->delete();
        $recipeId = Recipe::where('meal_id', $meal->id)->get();
        foreach ($recipeId as $step) {
            DB::table('ingredient_recipe')->where('recipe_id', $step->id)->delete();
        }
        DB::table('recipes')->where('meal_id', $meal->id)->delete();
        if ($meal->delete()) {
            return true;
        }
    }
}
