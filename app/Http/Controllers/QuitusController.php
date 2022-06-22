<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class QuitusController extends Controller
{
    //
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        // $quitus=DB::table('quitus')->where("nin",$request->nin)->where("Annee")->get();

        $annee=DB::table('annee')->orderByDesc("id_annee")->first();
        $quitus=DB::table('quitus')->where("nin",$request->nin)->where("Annee",$annee->Annee)->get();
        if($quitus->count()==0)
        {
            $annees=DB::table('quitus')->where("Annee",$annee->Annee)->get();
            if($annees->count()==0){
                $ins_quitus=DB::table("quitus")->insert([
                    "num_quitus"=>1,
                    "num_auto"=>$request->num_auto,
                    "nin"=>$request->nin,
                    "Annee"=>$annee->Annee,
                ]);

                $nin=Cookie::get('nin');

                $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee->Annee)->first();
                if(!empty($post->matricule)){

                    $etudiants=DB::table("etudiant")->where("mat_etud",$post->matricule)->first();
                    $inscription=DB::table("inscription")->where("mat_etud",$etudiants->mat_etud)->where('Annee',$annee->Annee)->get();
                    if($inscription->count()==0){
                        $admission=DB::table('admission')->where('matricule',$etudiants->mat_etud)->get();
                        $admissions=DB::table('admission')->where('matricule',$etudiants->mat_etud)->first();

                        if($admission->count()==0)
                        {
                            $resultat="ajourné";
                            $session="";
                            $mention="";
                        }
                        else{
                            $resultat="admis";
                            $session=$admissions->session;
                            $mention=$admissions->mention;
                        }

                         $dateJ=date('Y-m-d');
                         $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee->Annee)->first();
                         $etud = DB::table('etudiant')
                        ->where("mat_etud",$post->matricule)
                        ->update(['NIN' => $post->nin,"Tel_Etud"=>$post->tel_mobile,"date_j"=>$dateJ]);
                        $ins=$post->num_auto."/".$annee->Annee;
                        $inscri=DB::table("inscription")->insert([
                            "Num_Inscrip"=>$ins,
                            "NIN"=>$post->nin,
                            "Date_Inscrip"=>$dateJ,
                            "Mt_Regl_Inscrip"=>$post->droit,
                            // "Date_Reg_Inscrip"=>$post->nin,
                            "code_depart"=>$post->code_depart,
                            "code_niv"=>$post->code_niv,
                            "Annee"=>$post->Annee,
                            "mat_etud"=>$post->matricule,
                            "Parour_Etud"=>"Ancien",
                            "Resultat"=>$resultat,
                            "Session"=>$session,
                            "Mention"=>$mention,
                        ]);

                        $composante=DB::table("faculte")->where("code_facult",$post->code_facult)->first();
                        $departement=DB::table("departement")->where("code_depart",$post->code_depart)->first();
                        $niveau=DB::table("niveau")->where("code_niv",$post->code_niv)->first();
                        // $carte=DB::table('carte')->insert([
                        //     "matricule"=>$post->matricule,
                        //     "nom"=>$post->nom,
                        //     "prenom"=>$post->prenom,
                        //     "date_nais"=>$post->date_naiss,
                        //     "lieu_nais"=>$post->lieu_naiss,
                        //     "faculte"=>$composante->design_facult,
                        //     "departement"=>$departement->design_depart,
                        //     "niveau"=>$niveau->intit_niv,
                        //     "annee"=>$post->Annee,
                        //     "Photo"=>$post->matricule,
                        // ]);
                        // $nin=Cookie::get('nin');
                        // $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee)->first();
                        $data = DB::table('inscription')
                            ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
                            ->select('inscription.*','etudiant.*')
                            ->where("inscription.mat_etud",$post->matricule)->orderByDesc("Annee")->first();

                            $datas = DB::table('inscription')
                            ->join('niveau', 'inscription.code_niv', '=', 'niveau.code_niv')
                            ->join('departement', 'inscription.code_depart', '=', 'departement.code_depart')
                            ->join('faculte', 'departement.code_facult', '=', 'faculte.code_facult')
                            ->select('inscription.*','niveau.*','departement.*','faculte.*')
                            ->where("inscription.mat_etud",$post->matricule)->orderByDesc("Annee")->get();

                        $message="success";
                        return view ("fiche",compact("message",'data',"post",'datas'));
                    }
                    else{
                        $message="vous etes deja inscris cette année";
                        $nin=Cookie::get('nin');
                        $post=DB::table("post_inscription")->where("nin",$nin)->first();
                        return view ("success",compact("message",'post'));
                    }
                }
                else{

                    $etudiants=DB::table("etudiant")->where("mat_etud",$post->matricule)->first();
                    $etud=DB::table("etudiant")->orderByDesc("id")->first();
                    $mat=$etud->mat_etud;
                    $dernier = intval($etud->mat_etud);
                    $dernier++;
                    $mat = (string) $dernier;
                    $candidat=DB::table("candidats")->where("nin",$request->nin)->first();
                    // $admission=DB::table('admission')->where('matricule',$etudiants->mat_etud)->get();
                    // $admissions=DB::table('admission')->where('matricule',$etudiants->mat_etud)->first();



                    $date = date('Y-m-d H:i:s');
                    // $dateJ=date('Y-m-d');

                    $dateJ=date('Y-m-d');
                    $ins=$post->num_auto."/".$annee->Annee;
                    $et=DB::table("etudiant")->where('nin',$candidat->nin)->get();
                    if($et->count()==0)
                    {
                        $inscriptions=DB::table("etudiant")->insert([
                            'mat_etud'=>$mat,
                            'nin'=>$candidat->nin,
                            'nom'=>$candidat->nom,
                            'prenom'=>$candidat->prenom,
                            'date_naiss'=>$candidat->date_naiss,
                            'lieu_naiss'=>$candidat->lieu_naiss,
                            'nationalite'=>$candidat->nationalite,
                            'sexe'=>$candidat->sexe,
                            'Adr_Etud'=>$candidat->adresse_cand,
                            'Tel_Etud'=>$candidat->lieu_naiss,
                            'ile'=>$candidat->ile,
                            'situat_familliale'=>$candidat->situation,
                            'nbr_enfants'=>$candidat->Nbr_enfants,
                            'serie_bac'=>$candidat->serie,
                            'mention_bac'=>$candidat->mention,
                            'annee_bac'=>$candidat->annee,
                            'lieu_obt_bac'=>$candidat->centre,
                            'eqv_bac'=>$candidat->equiv,
                            'code_niv'=>$post->code_niv,
                            'code_depart'=>$post->code_depart,
                            'Num_preinscr'=>$candidat->num_recu,
                            'Date_preinscr'=>$candidat->datePrescript,
                            'An_Univ'=>$post->Annee,
                            'date_j'=>$date,
                            'profession'=>$candidat->pro
                        ]);
                    }
                    $ins=$post->num_auto."/".$annee->Annee;
                    $inscri=DB::table("inscription")->insert([
                        "Num_Inscrip"=>$ins,
                        "NIN"=>$post->nin,
                        "Date_Inscrip"=>$dateJ,
                        "Mt_Regl_Inscrip"=>$post->droit,
                        // "Date_Reg_Inscrip"=>$post->nin,
                        "code_depart"=>$post->code_depart,
                        "code_niv"=>$post->code_niv,
                        "Annee"=>$post->Annee,
                        "mat_etud"=>$mat,
                        "Parour_Etud"=>"Nouveau",
                        "Resultat"=>"",
                        "Session"=>"",
                        "Mention"=>"",
                    ]);

                    $composante=DB::table("faculte")->where("code_facult",$post->code_facult)->first();
                    $departement=DB::table("departement")->where("code_depart",$post->code_depart)->first();
                    $niveau=DB::table("niveau")->where("code_niv",$post->code_niv)->first();
                    $et=DB::table("etudiant")->where("NIN",$post->nin)->first();
                    // $carte=DB::table('carte')->insert([
                    //     "matricule"=>$et->mat_etud,
                    //     "nom"=>$post->nom,
                    //     "prenom"=>$post->prenom,
                    //     "date_nais"=>$post->date_naiss,
                    //     "lieu_nais"=>$post->lieu_naiss,
                    //     "faculte"=>$composante->design_facult,
                    //     "departement"=>$departement->design_depart,
                    //     "niveau"=>$niveau->intit_niv,
                    //     "annee"=>$post->Annee,
                    //     "Photo"=>$et->mat_etud,
                    // ]);

                    $data = DB::table('inscription')
                    ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
                    ->select('inscription.*','etudiant.*')
                    ->where("inscription.mat_etud",$et->mat_etud)->orderByDesc("Annee")->first();

                    $datas = DB::table('inscription')
                    ->join('niveau', 'inscription.code_niv', '=', 'niveau.code_niv')
                    ->join('departement', 'inscription.code_depart', '=', 'departement.code_depart')
                    ->join('faculte', 'departement.code_facult', '=', 'faculte.code_facult')
                    ->select('inscription.*','niveau.*','departement.*','faculte.*')
                    ->where("inscription.mat_etud",$et->mat_etud)->orderByDesc("Annee")->get();
                    $message="Matricule Ajouté avec succés!";
                    return view ("fiche",compact("message","post","data",'datas'));
                }


            }
            else{
                $nin=Cookie::get('nin');
                $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee->Annee)->first();
                $quitus_in=DB::table("quitus")->where("Annee",$annee->Annee)->orderByDesc("num_quitus")->first();
                $num=intval($quitus_in->num_quitus + 1);
                $ins_quitus=DB::table("quitus")->insert([
                    "num_quitus"=>$num,
                    "num_auto"=>$request->num_auto,
                    "nin"=>$request->nin,
                    "Annee"=>$annee->Annee,
                ]);
                $nin=Cookie::get('nin');
                $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee->Annee)->first();
                if(!empty($post->matricule)){

                    $etudiants=DB::table("etudiant")->where("mat_etud",$post->matricule)->first();
                    $inscription=DB::table("inscription")->where("mat_etud",$etudiants->mat_etud)->where('Annee',$annee->Annee)->get();
                    if($inscription->count()==0){
                        $admission=DB::table('admission')->where('matricule',$etudiants->mat_etud)->get();
                        $admissions=DB::table('admission')->where('matricule',$etudiants->mat_etud)->first();

                        if($admission->count()==0)
                        {
                            $resultat="ajourné";
                            $session="";
                            $mention="";
                        }
                        else{
                            $resultat="admis";
                            $session=$admissions->session;
                            $mention=$admissions->mention;
                        }

                         $dateJ=date('Y-m-d');
                         $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee->Annee)->first();
                         $etud = DB::table('etudiant')
                        ->where("mat_etud",$post->matricule)
                        ->update(['NIN' => $post->nin,"Tel_Etud"=>$post->tel_mobile,"date_j"=>$dateJ]);
                        $ins=$post->num_auto."/".$annee->Annee;
                        $inscri=DB::table("inscription")->insert([
                            "Num_Inscrip"=>$ins,
                            "NIN"=>$post->nin,
                            "Date_Inscrip"=>$dateJ,
                            "Mt_Regl_Inscrip"=>$post->droit,
                            // "Date_Reg_Inscrip"=>$post->nin,
                            "code_depart"=>$post->code_depart,
                            "code_niv"=>$post->code_niv,
                            "Annee"=>$post->Annee,
                            "mat_etud"=>$post->matricule,
                            "Parour_Etud"=>"Ancien",
                            "Resultat"=>$resultat,
                            "Session"=>$session,
                            "Mention"=>$mention,
                        ]);

                        $composante=DB::table("faculte")->where("code_facult",$post->code_facult)->first();
                        $departement=DB::table("departement")->where("code_depart",$post->code_depart)->first();
                        $niveau=DB::table("niveau")->where("code_niv",$post->code_niv)->first();
                        // $carte=DB::table('carte')->insert([
                        //     "matricule"=>$post->matricule,
                        //     "nom"=>$post->nom,
                        //     "prenom"=>$post->prenom,
                        //     "date_nais"=>$post->date_naiss,
                        //     "lieu_nais"=>$post->lieu_naiss,
                        //     "faculte"=>$composante->design_facult,
                        //     "departement"=>$departement->design_depart,
                        //     "niveau"=>$niveau->intit_niv,
                        //     "annee"=>$post->Annee,
                        //     "Photo"=>$post->matricule,
                        // ]);
                        // $nin=Cookie::get('nin');
                        // $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$annee)->first();
                        $data = DB::table('inscription')
                        ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
                        ->select('inscription.*','etudiant.*')
                        ->where("inscription.mat_etud",$post->matricule)->orderByDesc("Annee")->first();

                        $datas = DB::table('inscription')
                        ->join('niveau', 'inscription.code_niv', '=', 'niveau.code_niv')
                        ->join('departement', 'inscription.code_depart', '=', 'departement.code_depart')
                        ->join('faculte', 'departement.code_facult', '=', 'faculte.code_facult')
                        ->select('inscription.*','niveau.*','departement.*','faculte.*')
                        ->where("inscription.mat_etud",$post->matricule)->orderByDesc("Annee")->get();
                        $message="success";
                        return view ("fiche",compact("message",'post','data','datas'));
                    }
                    else{
                        $message="vous etes deja inscris cette année";
                        $nin=Cookie::get('nin');
                        $post=DB::table("post_inscription")->where("nin",$nin)->first();
                        $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date= $dt->format('Y-m-d');
                        return view ("success",compact("message",'post',"s","date"));
                    }
                }
                else{

                    $etudiants=DB::table("etudiant")->where("mat_etud",$post->matricule)->first();
                    $etud=DB::table("etudiant")->orderByDesc("id")->first();
                    $matmat=$etud->mat_etud;
                    $dernier = intval($etud->mat_etud);
                    $dernier++;
                    $mat = (string) $dernier;
                    $candidat=DB::table("candidats")->where("nin",$request->nin)->first();
                    // $admission=DB::table('admission')->where('matricule',$etudiants->mat_etud)->get();
                    // $admissions=DB::table('admission')->where('matricule',$etudiants->mat_etud)->first();



                    $date = date('Y-m-d H:i:s');
                    // $dateJ=date('Y-m-d');

                    $dateJ=date('Y-m-d');
                    // $ins=$post->num_auto."/".$annee->Annee;
                    $et=DB::table("etudiant")->where('nin',$candidat->nin)->get();
                    if($et->count()==0)
                    {
                        $inscriptions=DB::table("etudiant")->insert([
                            'mat_etud'=>$mat,
                            'nin'=>$candidat->nin,
                            'nom'=>$candidat->nom,
                            'prenom'=>$candidat->prenom,
                            'date_naiss'=>$candidat->date_naiss,
                            'lieu_naiss'=>$candidat->lieu_naiss,
                            'nationalite'=>$candidat->nationalite,
                            'sexe'=>$candidat->sexe,
                            'Adr_Etud'=>$candidat->adresse_cand,
                            'Tel_Etud'=>$candidat->lieu_naiss,
                            'ile'=>$candidat->ile,
                            'situat_familliale'=>$candidat->situation,
                            'nbr_enfants'=>$candidat->Nbr_enfants,
                            'serie_bac'=>$candidat->serie,
                            'mention_bac'=>$candidat->mention,
                            'annee_bac'=>$candidat->annee,
                            'lieu_obt_bac'=>$candidat->centre,
                            'eqv_bac'=>$candidat->equiv,
                            'code_niv'=>$post->code_niv,
                            'code_depart'=>$post->code_depart,
                            'Num_preinscr'=>$candidat->num_recu,
                            'Date_preinscr'=>$candidat->datePrescript,
                            'An_Univ'=>$post->Annee,
                            'date_j'=>$date,
                            'profession'=>$candidat->pro,
                        ]);
                    }

                    $ins=$post->num_auto."/".$annee->Annee;
                    $inscri=DB::table("inscription")->insert([
                        "Num_Inscrip"=>$ins,
                        "NIN"=>$post->nin,
                        "Date_Inscrip"=>$dateJ,
                        "Mt_Regl_Inscrip"=>$post->droit,
                        // "Date_Reg_Inscrip"=>$post->nin,
                        "code_depart"=>$post->code_depart,
                        "code_niv"=>$post->code_niv,
                        "Annee"=>$post->Annee,
                        "mat_etud"=>$mat,
                        "Parour_Etud"=>"Nouveau",
                        "Resultat"=>"",
                        "Session"=>"",
                        "Mention"=>"",
                    ]);

                    $composante=DB::table("faculte")->where("code_facult",$post->code_facult)->first();
                    $departement=DB::table("departement")->where("code_depart",$post->code_depart)->first();
                    $niveau=DB::table("niveau")->where("code_niv",$post->code_niv)->first();
                    $et=DB::table("etudiant")->where("NIN",$post->nin)->first();
                    // $carte=DB::table('carte')->insert([
                    //     "matricule"=>$et->mat_etud,
                    //     "nom"=>$post->nom,
                    //     "prenom"=>$post->prenom,
                    //     "date_nais"=>$post->date_naiss,
                    //     "lieu_nais"=>$post->lieu_naiss,
                    //     "faculte"=>$composante->design_facult,
                    //     "departement"=>$departement->design_depart,
                    //     "niveau"=>$niveau->intit_niv,
                    //     "annee"=>$post->Annee,
                    //     "Photo"=>$et->mat_etud,
                    // ]);


                    $data = DB::table('inscription')
                    ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
                    ->select('inscription.*','etudiant.*')
                    ->where("inscription.mat_etud",$et->mat_etud)->orderByDesc("Annee")->first();

                    $datas = DB::table('inscription')
                    ->join('niveau', 'inscription.code_niv', '=', 'niveau.code_niv')
                    ->join('departement', 'inscription.code_depart', '=', 'departement.code_depart')
                    ->join('faculte', 'departement.code_facult', '=', 'faculte.code_facult')
                    ->select('inscription.*','niveau.*','departement.*','faculte.*')
                    ->where("inscription.mat_etud",$et->mat_etud)->orderByDesc("Annee")->get();
                    $message="Matricule Ajouté avec succés!";
                    return view ("fiche",compact("message","post","data",'datas'));

                }




            }
        }
        else{
            $nin=Cookie::get('nin');
            $post=DB::table("post_inscription")->where("nin",$nin)->first();
            $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
            $dt = new DateTime();
            $date= $dt->format('Y-m-d');
            $message="Vous avez dejà un quitus";
                return view ("success",compact("message","post","s","date"));
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
