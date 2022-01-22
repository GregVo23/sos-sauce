<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the favorite user's resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        return $user ? User::find($user->id)->favoriteMeals : false;
    }


    /**
     * Store or delete a meal from favorite.
     * Return true if favorite and false where not favorite
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(int $id)
    {
        $user = Auth()->user();
        if ($user) {
            $userId = $user->id;
            $meal = Meal::find($id);
            if (DB::table('meal_user')->where(['meal_id' => $id, 'user_id' => $userId])->exists()) {
                $meal->favoriteUsers()->detach($userId, ['meal_id' => $id]);
                return response()->json(true);
            } else {
                $meal->favoriteUsers()->attach($userId, ['meal_id' => $id]);
                return response()->json(false);
            }
        } else {
            return response()->json([
                'message' => 'Seul un membre connecté peut ajouter un plat dans ses favoris et vice versa !',
                'type' => 'error',
            ]);
        }
    }
}
