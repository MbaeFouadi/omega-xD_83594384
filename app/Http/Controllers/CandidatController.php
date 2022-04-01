<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;


class CandidatController extends Controller
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

     public function candidat_nv(Request $request){

        $etudiant=DB::table('etudiant')->where('NIN',$request->nin)->get();
        if($etudiant->count()==1)
        {
            $message="Vous avez un parcours à l'UDC c'est donc une préinscription";
            return view("inscription",compact("message"));
        }
        else{

            $annee=DB::table('annee')->orderByDesc("id_annee")->first();
            $autorisation=DB::table('post_inscription')->where("nin",$request->nin)->where("Annee",$annee->Annee)->get();
            if($autorisation->count()==1){
                $message="Vous avez déja une fiche d'autorisation de paie";
                return view("inscription",compact("message"));

            }
            else{

                $candidat=DB::table("candidats")->where("nin",$request->nin)->first();

                $candidats=DB::table("candidats")->where("nin",$request->nin)->get();
                if($candidats->count()==0)
                {
                    $message="Vous n'etes pas pré-inscrit cette année";
                    return view("inscription",compact("message"));

                }

                elseif($candidat->retenu=="nR1" || $candidat->retenu=="nR2" || $candidat->retenu=="nR3" || $candidat->retenu=='' || $candidat->retenu='0')
                {
                    $message="Vous n'avez pas encore  été retenu dans un département";
                    return view("inscription",compact("message"));

                }
                else
                {
                    $candidat=DB::table("candidats")->where("nin",$request->nin)->first();
                    $type_recu=$candidat->id_type;
                    $dep=$candidat->retenu;
                    $recu=DB::table('type_recu')->where("id_type",$type_recu)->first();
                    $departement=DB::table('departement')->where("code_depart",$dep)->first();
                    $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
                    $dt = new DateTime();
                    $date= $dt->format('Y-m-d');
                    return view("info_candidat",compact("candidat","recu","departement","s","date"));

                }
            }
        }
     }

     public function candidat_an(Request $request){

        // $etudiant=DB::table('etudiant')->where('NIN',$request->nin)->get();

        $annee=DB::table('annee')->orderByDesc("id_annee")->first();
        $autorisation=DB::table('post_inscription')->where("nin",$request->nin)->where("Annee",$annee->Annee)->get();
        // if($etudiant->count()==1)
        if($autorisation->count()==1)
        {
            // $message="Vous avez un parcours à l'UDC c'est donc une préinscription";
            $message="Vous avez déja une fiche d'autorisation de paie";

            return view("re-inscription",compact("message"));
        }
        else{

            // $annee=DB::table('annee')->orderByDesc("id_annee")->first();
            $etudiant=DB::table('etudiant')->where("mat_etud",$request->matricule)->get();
            if($etudiant->count()==0){
                $message="cet etudiant n'a pas un parcours à l'UDC";
                return view("re-inscription",compact("message"));

            }
            else{


                $candidats=DB::table("candidats")->where("nin",$request->nin)->get();
                if($candidats->count()==1)
                {
                    $candidat=DB::table("candidats")->where("nin",$request->nin)->first();
                    if($candidat->retenu=="nR1" || $candidat->retenu=="nR2" || $candidat->retenu=="nR3" || $candidat->retenu=='' || $candidat->retenu='0')
                    {
                        $message="Vous n'avez pas encore  été retenu dans un département";
                        return view("re-inscription",compact("message"));
                    }
                    else{
                        $p=0;
                        $candidat=DB::table("candidats")->where("nin",$request->nin)->first();
                        $etudiant=DB::table('etudiant')->where("mat_etud",$request->matricule)->first();
                        $type_recu=$candidat->id_type;
                        // if($type_recu==4 || $type_recu==5){
                        //     $type="transfert&reprise"
                        // }
                        $nom=$candidat->nom;
                        $prenom=$candidat->prenom;
                        $date_n=$candidat->date_naiss;
                        $lieu_naiss=$candidat->lieu_naiss;
                        $nin=$request->nin;
                        $matricule=$request->matricule;
                        $dep=$candidat->retenu;
                        $recu=DB::table('type_recu')->where("id_type",$type_recu)->first();
                        $departement=DB::table('departement')->where("code_depart",$dep)->first();
                        $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date= $dt->format('Y-m-d');
                        return view("info_etudiant",compact("nom","prenom","date_n","lieu_naiss","matricule","nin","recu","departement","candidat","etudiant","p","type_recu","date","s"));
                    }


                }
                else
                {
                    $p=1;
                    $inscription=DB::table('inscription')->where('mat_etud',$request->matricule)->orderByDesc("Annee")->first();
                    $etudiant=DB::table('etudiant')->where("mat_etud",$request->matricule)->first();
                    $nom=$etudiant->nom;
                    $prenom=$etudiant->prenom;
                    $date_n=$etudiant->date_naiss;
                    $lieu_naiss=$etudiant->lieu_naiss;
                    $nin=$request->nin;
                    $matricule=$request->matricule;
                    $admission=DB::table('admission')->where('matricule',$request->matricule)->get();
                    if($admission->count()==0){
                        $resultat="Ajourné";
                        $inscription=DB::table("inscription")->where("mat_etud",$request->matricule)->orderByDesc("annee")->first();
                        $niveau=$inscription->code_niv;
                        $nive=DB::table("niveau")->where("code_niv",$niveau)->first();
                        $niv=$nive->intit_niv;
                    }
                    else{
                        $resultat="Admis";
                        $inscription=DB::table("inscription")->where("mat_etud",$request->matricule)->orderByDesc("annee")->first();
                        $niveau=$inscription->code_niv;
                        $code_dep=$inscription->code_depart;

                        switch ($niveau) {
                            case 'N1':
                                $code="N2";
                                break;
                            case 'N2':
                                $code="N3";
                                break;
                            case 'N3':
                                $code="N4";
                                break;
                            case 'N4':
                                $code="N5";
                                break;
                            case 'P1':
                                $code="P2";
                                break;
                            case 'P2':
                                $code="P3";
                                break;
                            default:
                                $m="le niveau suivant n'est pas disponible";
                                break;
                        }
                        $nive=DB::table("niveau")->where("code_niv",$code)->first();
                        $niv=$nive->intit_niv;
                    }
                    $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
                    $dt = new DateTime();
                    $date= $dt->format('Y-m-d');
                    return view("info_etudiant",compact("nom","prenom","date_n","lieu_naiss","matricule","nin","inscription","etudiant","p","resultat","niv","date","s"));

                }
            }
        }
     }
}
