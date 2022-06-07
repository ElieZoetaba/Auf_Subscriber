<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbonneController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonnes = Abonne::all();
        return view('abonnes.index', compact('abonnes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("abonnes/edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "nom" => "bail|required|string|max:200",
            "prenom" => "bail|required|string|max:256",
            "abonnement_fin" => "bail|required|date",
            "telephone" => "bail|required|unique:abonnes|max:26",
            "email" => "bail|required|string|unique:abonnes|max:256",
            "photo" => "bail|image|required|max:1024"
        ]);
        $img_path = $request->photo->store("abonnes");
        Abonne::create(
            [
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "abonnement_fin" => $request->abonnement_fin,
                "telephone" => $request->telephone,
                "email" => $request->email,
                "photo" =>  $img_path
            ]
        );

        return redirect(route("abonne.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
     */
    public function show(Abonne $abonne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
     */
    public function edit(Abonne $abonne)
    {

        return view("abonnes/edit", compact("abonne"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abonne $abonne)
    {

        $rules = [
            "nom" => "bail|required|string|max:200",
            "prenom" => "bail|required|string|max:256",
            "abonnement_fin" => "bail|required|date",
            "telephone" => "bail|required|max:26",
            "email" => "bail|required|string|max:256"
        ];

        if ($request->has("photo")) {
            $rules["photo"] = "bail|image|required|max:1024";
        }
        $this->validate($request, $rules);
        if ($request->has("photo")) {
            Storage::delete($abonne->photo);
            $img_path = $request->photo->store("abonnes");
        }
        $abonne->update(
            [
                "nom" => $request->nom,
                "prenom" => $request->prenom,
                "abonnement_fin" => $request->abonnement_fin,
                "telephone" => $request->telephone,
                "email" => $request->email,
                "photo" =>  isset($img_path) ? $img_path : $abonne->photo
            ]
        );
        return redirect(route("abonne.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abonne  $abonne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abonne $abonne)
    {
        Storage::delete($abonne->photo);
        $abonne->delete();
        return redirect(route("abonne.index"));
    }
}
