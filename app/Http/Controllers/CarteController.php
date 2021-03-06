<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $etudiant=DB::table("etudiant")   
            ->where("mat_etud", $request->matricule)
            ->first();

            if (!isset($carte)) {

                $departement=DB::table("departement")
                ->where("code_depart",$inscription->code_depart)
                ->first();
                $faculte=DB::table("faculte")
                ->where("code_facult",$departement->code_facult)
                ->first();
                $niveau=DB::table("niveau")
                ->where("code_niv",$inscription->code_niv)
                ->first();
                
                $request->validate([
                    'image' =>'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);

                $imageName = $request->matricule.'.'.$request->image->extension();

                $request->image->move(public_path('photo_carte'), $imageName);

                $add_carte=DB::table("carte")->insert([
                    'matricule'=>$request->matricule,
                    'nom'=>$etudiant->nom,
                    'prenom'=>$etudiant->prenom,
                    'date_nais'=>$etudiant->date_naiss,
                    'lieu_nais'=>$etudiant->lieu_naiss,
                    'faculte'=>$faculte->design_facult,
                    'departement'=>$departement->design_depart,
                    'niveau'=>$niveau->intit_niv,
                    'annee' =>$annee->Annee,
                    'photo'=>$request->matricule,
                ]);

                /* Store $imageName name in DATABASE from HERE */
                $message="t??l??versement de la photo a ??t?? effectu?? avec succ??s ";

                $carte= DB::table("carte")
                ->where("matricule",$request->matricule)
                ->where("annee",$annee->Annee)
                ->first();

                $dt = new DateTime();
                $dt->add(new DateInterval('P7D'));
                $date= $dt->format('Y-m-d');
                return view("carte_jour",compact("date","carte"));
            } else {
                $message = "Vous avez dej?? une photo";
                return view("carte",compact("message"));
            }
        } else {

            $message = "Vous n'??tes pas inscris cette ann??e";
            return view("carte",compact("message"));
        }
    }
}
