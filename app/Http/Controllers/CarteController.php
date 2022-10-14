<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarteController extends Controller
{
    public function index()
    {
        return view('carte');
    }

    public function store(Request $request)
    {

        $annee = DB::table("annee")->orderByDesc("id_annee")->first();

        $inscription = DB::table("inscription")
            ->where("mat_etud", $request->matricule)
            ->where("Annee", $annee->Annee)
            ->orderByDesc("mat_etud")
            ->first();
        if (isset($inscription)) {

            $carte = DB::table('carte')
                ->where("matricule", $request->matricule)
                ->where("annee", $annee->Annee)
                ->first();
            $etudiant = DB::table("etudiant")
                ->where("mat_etud", $request->matricule)
                ->first();

            if (!isset($carte)) {

                $dates = new Date("Y/m/d");
                $departement = DB::table("departement")
                    ->where("code_depart", $inscription->code_depart)
                    ->first();
                $faculte = DB::table("faculte")
                    ->where("code_facult", $departement->code_facult)
                    ->first();
                $niveau = DB::table("niveau")
                    ->where("code_niv", $inscription->code_niv)
                    ->first();

                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
                ]);

                $imageName = $request->matricule . '.' . $request->image->extension();

                $request->image->move(public_path('photo_carte'), $imageName);

                $add_carte = DB::table("carte")->insert([
                    'matricule' => $request->matricule,
                    'nom' => $etudiant->nom,
                    'prenom' => $etudiant->prenom,
                    'date_nais' => $etudiant->date_naiss,
                    'lieu_nais' => $etudiant->lieu_naiss,
                    'faculte' => $faculte->design_facult,
                    'departement' => $departement->design_depart,
                    'niveau' => $niveau->intit_niv,
                    'annee' => $annee->Annee,
                    'date' => now(),
                    'photo' => $imageName,
                ]);

                /* Store $imageName name in DATABASE from HERE */
                $message = "téléversement de la photo a été effectué avec succès ";

                $carte = DB::table("carte")
                    ->where("matricule", $request->matricule)
                    ->where("annee", $annee->Annee)
                    ->first();

                $dt = new DateTime();
                $dts = new DateTime();

                // $dt->add(new DateInterval('P7D'));
                // $date = $dt->format('Y-m-d');
                $dt->add(new DateInterval('P7D'));
                $date = $dt->format('l-Y-m-d');
                if($dt->format('l')=="Sunday")
                {
                    $dts->add(new DateInterval('P8D'));
                    $dates = $dts->format('l-Y-m-d');


                }
                else
                {
                    $dts->add(new DateInterval('P7D'));
                    $dates = $dts->format('l-Y-m-d');
                }
                // \Carbon\Carbon::parse($date)->translatedFormat('l j F Y');
                return view("carte_jour", compact("date", "carte","dates"));
            } else {
                $message = "Vous avez dejà une photo";
                return view("carte", compact("message"));
            }
        } else {

            $message = "Vous n'êtes pas inscris cette année";
            return view("carte", compact("message"));
        }
    }

    public function filtre_ngazidja()
    {

        $facultes = DB::table("faculte")
        ->get();
        $photos = DB::table("carte")->get();
        return view("filtre", compact('photos', 'facultes'));
    }
    public function filtre_anjouan()
    {

        $facultes = DB::table("departement"
        )->where("code_facult",'like','%'."SP".'%')
        ->where("statut",1)
        ->get();
        $photos = DB::table("carte")->get();
        return view("filtre_anjouan", compact('photos', 'facultes'));
    }


    public function getDepartement(Request $request)
    {
        $dep = DB::table("departement")
            ->where("code_facult", $request->faculte)
            ->where("statut", 1)
            ->pluck("design_depart", "code_depart");

        return response()->json($dep);
    }

    public function photo_ngazidja(Request $request)
    {
        $datas = DB::table("carte")
            ->join("faculte", "faculte.design_facult", "=", "carte.faculte")
            ->join("departement", "departement.design_depart", "=", "carte.departement")
            ->select("carte.*", "faculte.code_facult", "departement.code_depart")
            ->where("faculte.code_facult", "=", $request->faculte)
            ->where("departement.code_depart", "=", $request->departement)
            ->where("date", 'like', '%' . $request->dates . '%')
            ->where("etat", "=", 0)
            ->get();

        Session::put("faculte", $request->faculte);
        Session::put("departement", $request->departement);
        Session::put("dates", $request->dates);

        return view("photo_ngazidja", compact("datas"));
    }

    public function photo_anjouan(Request $request)
    {
        $datas = DB::table("carte")
            // ->join("faculte", "faculte.design_facult", "=", "carte.faculte")
            ->join("departement", "departement.design_depart", "=", "carte.departement")
            ->select("carte.*", "departement.code_depart")
            // ->where("faculte.code_facult", "=", $request->faculte)
            ->where("departement.code_depart", "=", $request->departement)
            ->where("date", 'like', '%' . $request->dates . '%')
            ->where("etat", "=", 0)
            ->get();

        // Session::put("faculte", $request->faculte);
        Session::put("departement", $request->departement);
        Session::put("dates", $request->dates);

        return view("photo_anjouan", compact("datas"));
    }

    public function photo_nga($id)
    {


        $update=DB::table("carte")
        ->where("matricule",$id)
        ->update([
            'etat'=>1
        ]); 

        $datas=DB::table("carte")
        ->join("faculte","faculte.design_facult","=","carte.faculte")
        ->join("departement","departement.design_depart","=","carte.departement")
        ->select("carte.*","faculte.code_facult","departement.code_depart")
        ->where("faculte.code_facult","=",Session::get('faculte'))
        ->where("departement.code_depart","=",Session::get('departement'))
        ->where("date",'like','%'.Session::get('dates').'%')
        ->where("etat","=",0)
        ->get();

        return view("photo_ngazidja",compact("datas"));

       
    }

    public function photo_an($id)
    {


        $update=DB::table("carte")
        ->where("matricule",$id)
        ->update([
            'etat'=>1
        ]); 

        $datas=DB::table("carte")
        ->join("faculte","faculte.design_facult","=","carte.faculte")
        ->join("departement","departement.design_depart","=","carte.departement")
        ->select("carte.*","faculte.code_facult","departement.code_depart")
        // ->where("faculte.code_facult","=",Session::get('faculte'))
        ->where("departement.code_depart","=",Session::get('departement'))
        ->where("date",'like','%'.Session::get('dates').'%')
        ->where("etat","=",0)
        ->get();

        return view("photo_anjouan",compact("datas"));

       
    }
}
