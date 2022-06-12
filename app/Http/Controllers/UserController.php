<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    /**
     * Show all user's meals
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserMeals()
    {
        $id = auth()->user()->id;
        $meals = User::where('id',$id)->first()->meals;
        return response()->json($meals);
    }

    /**
     * Show the number of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function nbUsers()
    {
        $users = User::all()->count();
        return response()->json($users);
    }

    /**
     * Upload a new avatar.
     *
     * @param Request $request
     * @param Id $id
     * @return \Illuminate\Http\Response
     */
    public function saveAvatar(Request $request, $id)
    {
        
        $user_id = Auth()->user()->id;

        if ($user_id == $id){
            $rules = array(

                'file' => 'image|mimes:jpg,jpeg,png,PNG|max:9000'
            );
            $validator = Validator::make($request->all(), $rules);

            // process
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors(),
                    'type' => 'error',
                ]);
            } else {

                $user_id = Auth()->user()->id;

                if ($user_id == $id){
                    $user = User::find($id);

                    if ($request->file()) {
                        $file_name = time() . '_' . $request->file->getClientOriginalName();
                        $file_path = $request->file('file')->storeAs('avatar/' . $user->id, $file_name, 'public');
                        
                        if (File::exists($user->avatar)) {
                            File::delete($user->avatar);
                        }
                        $user->avatar = '/storage/' . $file_path;
                        $result = $user->save();
                        if ($result){
                            return response()->json([
                                'message' => "Votre profil a été mis à jours.",
                                'type'=> "success",
                            ], 200);
                        } else {
                            return response()->json([
                                'message' => 'Un problème est survenu, veuillez réessayer plus tard.',
                                'type'=> "error",
                            ], 500);
                        }
                    } else {
                        return response()->json([
                            'message' => 'Absence de photo !',
                            'type'=> "error",
                        ], 500);
                    }
                }
            }
        } else {
            return response()->json([
                'message' => 'Seul le propriétaire peut changer son avatar !',
                'type'=> "error",
            ], 422);
        }
    }

    /**
     * Update the User's data: firstname, lastname, phone and email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveProfil(Request $request, $id)
    {
        
        $user_id = Auth()->user()->id;
        $user = User::findOrFail($id);
    
        $user->last_name = $request->user()->last_name;
        $user->save();

        if ($user_id == $id){
            return response()->json([
                'message' => 'ok !',
                'type'=> "success",
                'request' => $request->user()
            ], 200);
        } else {
            return response()->json([
                'message' => 'pas ok !',
                'type'=> "error",
            ], 403);            
        }

    }
    
    /**
     * Remove the User and all user's files and folders from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return flash message
     */
    public function destroy($id)
    {
        $userConnected = Auth()->user();
        if ($userConnected->id == $id || $userConnected->role === 2 ){
            $user = User::findOrFail($id);

            $projects = $user->projects;
            foreach ($projects as $project){

                //Delete all user data
                $picture_path = '/storage/project/cover/'. $project->id;
                $document_path = '/storage/project/doc/'. $project->id;

                //Pictures
                if (File::exists(public_path($picture_path . '/' . $project->picture))) {
                    //Delete small project image
                    File::delete(public_path($picture_path . '/' . $project->picture));
                    //Delete XL project image
                    File::delete(public_path('/project/cover/' . $project->picture));
                    //Delete all directories
                    File::deleteDirectory(public_path($picture_path));
                    File::deleteDirectory(public_path('storage/project/cover/' . $project->user_id));
                }

                //Documents
                if (!empty($project->document)) {
                    $documents = json_decode($project->document);
                    foreach ($documents as $document) {
                        if (File::exists(public_path($document_path . '/' . $document))) {
                            File::delete(public_path($document_path . '/' . $document));
                            File::deleteDirectory(public_path($document_path));
                            File::deleteDirectory(public_path('storage/project/doc/' . $project->user_id));
                        }
                    }
                }
                $project->delete();

                //Avatar
                if (File::exists($user->avatar)) {
                    if($user->avatar != "./images/profil.png"){
                        File::delete($user->avatar);
                    }
                }
            }
            $user->tokens()->delete();
            $result = $user->delete();
            if ($result){
                session()->regenerate();
                Session::flash('success', "Votre compte est supprimé avec succés.");
                return response()->json(['success' => "L'utilisateur est désormais supprimé avec succés."], 200);
            } else {
                session()->regenerate();
                Session::flash('error', "Un problème est survenu lors de la suppression de votre compte.");
                return response()->json(['errors' => "Un problème est survenu lors de la suppression de l'utilisateur."], 500);
            }
        } else {
            session()->regenerate();
            Session::flash('error', "Vous n'êtes pas autorisé à supprimer ce compte.");
            return response()->json(['errors' => "Vous n'êtes pas autorisé à supprimer ce compte."], 422);
        }
    }
}
