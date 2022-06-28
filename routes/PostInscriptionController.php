<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class PostInscriptionController extends Controller
{
    //

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
        $niveau = $request->niveau;
        // $candidat=DB::table("candidats")->where("nin",$request->nin)->first();
        // $departement=DB::table('departement')->where("code_depart",$candidat->retenu)->first();
        // $depart=$departement->design_depart;
        // $code_facult=$departement->code_facult;
        // $concours=$departement->concours;
        // $faculte=DB::table('faculte')->where('code_facult',$code_facult)->first();
        // $facult=$faculte->design_facult;

        $concours = DB::table("candidats")
            ->join("departement", "candidats.retenu", "=", "departement.code_depart")
            ->select("candidats.*", "departement.*")
            ->where("nin", $request->nin)
            ->first();
        if ($concours->concours == 1) {

            $pro = DB::table("candidats")
                ->join("montant", "candidats.id_type", "=", "montant.id_type")
                ->select("candidats.*", "montant.*")
                ->where("candidats.nin", $request->nin)
                ->where("montant.niveau", $niveau)
                ->first();
            if ($pro->pro == 1) {
                $candidat = DB::table("candidats")
                    ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                    ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                    ->join("montant", "candidats.id_type", "=", "montant.id_type")
                    ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                    ->where("candidats.nin", $request->nin)
                    ->where("montant.niveau", $niveau)
                    ->where("montant.concours", 1)
                    ->where("montant.statut", 1)
                    ->first();
            } else {

                $candidat = DB::table("candidats")
                    ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                    ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                    ->join("montant", "candidats.id_type", "=", "montant.id_type")
                    ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                    ->where("candidats.nin", $request->nin)
                    ->where("montant.niveau", $niveau)
                    ->where("montant.concours", 1)
                    ->where("montant.statut", 0)
                    ->first();
            }
        } else {


            $pro = DB::table("candidats")
                ->join("montant", "candidats.id_type", "=", "montant.id_type")
                ->select("candidats.*", "montant.*")
                ->where("candidats.nin", $request->nin)
                ->where("montant.niveau", $niveau)
                ->first();
            if ($pro->pro == 1) {
                $candidat = DB::table("candidats")
                    ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                    ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                    ->join("montant", "candidats.id_type", "=", "montant.id_type")
                    ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                    ->where("candidats.nin", $request->nin)
                    ->where("montant.niveau", $niveau)
                    ->where("montant.concours", 0)
                    ->where("montant.statut", 1)
                    ->first();
            } else {

                $candidat = DB::table("candidats")
                    ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                    ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                    ->join("montant", "candidats.id_type", "=", "montant.id_type")
                    ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                    ->where("candidats.nin", $request->nin)
                    ->where("montant.niveau", $niveau)
                    ->where("montant.concours", 0)
                    ->where("montant.statut", 0)
                    ->first();
            }
        }

        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
        $annees = $annee->Annee;
        $post = DB::table("post_inscription")->where("nin", $request->nin)->where('Annee', $annees)->get();
        if ($post->count() == 0) {
            $nom = $candidat->nom;
            $prenom = $candidat->prenom;
            $lieu_naiss = $candidat->lieu_naiss;
            $date_naiss = $candidat->date_naiss;
            $date = date('d/m/Y');
            $inscription = DB::table("inscription")->Where("NIN", $request->nin)->get();
            $inscriptions = DB::table("inscription")->Where("NIN", $request->nin)->first();
            if ($inscription->count() > 0) {
                $mat = $inscriptions->mat_etud;
                $an = DB::table("post_inscription")->where("Annee", $annees)->get();
                if ($an->count() == 0) {
                    DB::table('post_inscription')->insert([
                        'num_auto' => '1',
                        'nin' => $request->nin,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'lieu_naiss' => $lieu_naiss,
                        'date_naiss' => $date_naiss,
                        'statut' => 2,
                        'code_depart' => $candidat->retenu,
                        'code_niv' => $candidat->n,
                        'date_delivrance_fiche' => $date,
                        'code_facult' => $candidat->code_faculte,
                        'tel_mobile' => $candidat->tel_mobile,
                        'droit' => $candidat->udc,
                        'droit_lettre' => $candidat->lettre,
                        'matricule' => $mat,
                        'Annee' => $annees
                    ]);

                    Cookie::queue('nin', $request->nin, 10);
                    $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                    $annees = $annee->Annee;
                    $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                    $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                    $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                    $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();
                    $candidats = DB::table("candidats")->where("nin", $request->nin)->first();

                    $ch = curl_init();
                    // define options
                    $optArray = array(
                        CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);

                    // var_dump($errors);
                    $sessionId = substr($result, 3);

                    $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                    $dt = new DateTime();
                    $date = $dt->format('Y-m-d');
                    return view("autorisation", compact("data", "composante", "departement", "niveau", "candidats", "sessionId", 's', 'date'));
                } else {
                    $post_in = DB::table("post_inscription")->where("Annee", $annees)->orderByDesc("num_auto")->first();
                    $num = $post_in->num_auto + 1;
                    DB::table('post_inscription')->insert([
                        'num_auto' => $num,
                        'nin' => $request->nin,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'lieu_naiss' => $lieu_naiss,
                        'date_naiss' => $date_naiss,
                        'statut' => 2,
                        'code_depart' => $candidat->retenu,
                        'code_niv' => $candidat->n,
                        'date_delivrance_fiche' => $date,
                        'code_facult' => $candidat->code_faculte,
                        'tel_mobile' => $candidat->tel_mobile,
                        'droit' => $candidat->udc,
                        'droit_lettre' => $candidat->lettre,
                        'matricule' => $mat,
                        'Annee' => $annees
                    ]);
                    Cookie::queue('nin', $request->nin, 10);
                    $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                    $annees = $annee->Annee;
                    $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                    $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                    $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                    $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();
                    $candidats = DB::table("candidats")->where("nin", $request->nin)->first();

                    $ch = curl_init();
                    // define options
                    $optArray = array(
                        CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);

                    // var_dump($errors);
                    $sessionId = substr($result, 3);

                    $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                    $dt = new DateTime();
                    $date = $dt->format('Y-m-d');
                    return view("autorisation", compact("data", "composante", "departement", "niveau", "candidats", "sessionId", "s", "date"));
                }
            } else {
                $an = DB::table("post_inscription")->where("Annee", $annees)->get();
                if ($an->count() == 0) {
                    DB::table('post_inscription')->insert([
                        'num_auto' => '1',
                        'nin' => $request->nin,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'lieu_naiss' => $lieu_naiss,
                        'date_naiss' => $date_naiss,
                        'statut' => 2,
                        'code_depart' => $candidat->retenu,
                        'code_niv' => $candidat->n,
                        'date_delivrance_fiche' => $date,
                        'code_facult' => $candidat->code_faculte,
                        'tel_mobile' => $candidat->tel_mobile,
                        'droit' => $candidat->udc,
                        'droit_lettre' => $candidat->lettre,

                        'Annee' => $annees
                    ]);

                    Cookie::queue('nin', $request->nin, 10);
                    $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                    $annees = $annee->Annee;
                    $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                    $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                    $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                    $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();
                    $candidats = DB::table("candidats")->where("nin", $request->nin)->first();

                    $ch = curl_init();
                    // define options
                    $optArray = array(
                        CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);

                    // var_dump($errors);
                    $sessionId = substr($result, 3);
                    $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                    $dt = new DateTime();
                    $date = $dt->format('Y-m-d');
                    return view("autorisation", compact("data", "composante", "departement", "niveau", "candidats", "sessionId", "s", "date"));
                } else {
                    $post_in = DB::table("post_inscription")->where("Annee", $annees)->orderByDesc("num_auto")->first();
                    $num = $post_in->num_auto + 1;
                    DB::table('post_inscription')->insert([
                        'num_auto' => $num,
                        'nin' => $request->nin,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'lieu_naiss' => $lieu_naiss,
                        'date_naiss' => $date_naiss,
                        'statut' => 2,
                        'code_depart' => $candidat->retenu,
                        'code_niv' => $candidat->n,
                        'date_delivrance_fiche' => $date,
                        'code_facult' => $candidat->code_faculte,
                        'tel_mobile' => $candidat->tel_mobile,
                        'droit' => $candidat->udc,
                        'droit_lettre' => $candidat->lettre,

                        'Annee' => $annees
                    ]);

                    Cookie::queue('nin', $request->nin, 10);
                    $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                    $annees = $annee->Annee;
                    $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                    $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                    $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                    $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();
                    $candidats = DB::table("candidats")->where("nin", $request->nin)->first();

                    $ch = curl_init();
                    // define options
                    $optArray = array(
                        CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);

                    // var_dump($errors);
                    $sessionId = substr($result, 3);
                    $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                    $dt = new DateTime();
                    $date = $dt->format('Y-m-d');
                    return view("autorisation", compact("data", "composante", "departement", "niveau", "candidats", "sessionId", "s", "date"));
                }
            }
        } else {
            $message = "Vous avez deja une fiche";
        }



        // if($niveau=="N4" || $niveau=="N5"){
        //     $udc="60000 KMF";
        //     $lettre="Soixante mille Francs Comoriens";
        // }
        // if( $concours==1){
        //     if($niveau=="l1" || $niveau=="l2"){
        //         $udc="45000 KMF";
        //         $lettre="Quarante cinq mille Francs Comoriens";
        //     } elseif($niveau=="l3"){
        //         $udc="55000 KMF";
        //         $lettre="Cinquante cinq mille Francs Comoriens";
        //     }
        // }else{
        //     if($niveau=="l1" || $niveau=="l2" ){
        //         $udc="40000 KMF";
        //         $lettre="Quarante mille Francs Comoriens";
        //     } elseif($niveau=="l3"){
        //         $udc="50000 KMF";
        //         $lettre="Cinquante mille Francs Comoriens";
        //     }

        // }
        // if($niveau=="l1"){
        //     if($concours==1 and $code_facult!="EMSP"){
        //         $niv="1ère Année" ;
        //         $n="P1" ;
        //     }
        //     if($concours==0 || $code_facult=="EMSP"){
        //         $niv="Licence 1" ;
        //         $n="N1" ;
        //     }
        // } if($niveau=="l2"){
        //     if($concours==1 and $code_facult!="EMSP"){
        //         $niv="2ème Année" ;
        //         $n="P2" ;
        //     }
        //     if($concours==0 || $code_facult=="EMSP"){
        //         $niv="Licence 2" ;
        //         $n="N2" ;
        //     }
        // }if($niveau=="l3"){
        //     if($concours==1 and $code_facult!="EMSP"){
        //         $niv="3ème Année" ;
        //         $n="P3" ;
        //     }
        //     if($concours==0 || $code_facult=="EMSP"){
        //         $niv="Licence 3" ;
        //         $n="N3" ;
        //     }
        // }
        // if($niveau=="N4"){

        //         $niv="Master 1" ;
        //         $n="N4" ;
        // }
        // if($niveau=="N5"){

        //         $niv="Master 2" ;
        //         $n="N5" ;

        // }



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

    public function autorisation_an(Request $request)
    {

        $cand = DB::table('candidats')->Where("nin", $request->nin)->get();
        if ($cand->count() == 1) {
            $niveau = $request->niveau;
            // $candidat = DB::table("candidats")->where("nin", $request->nin)->first();
            // $departement = DB::table('departement')->where("code_depart", $candidat->retenu)->first();
            // $depart = $departement->design_depart;
            // $code_facult = $departement->code_facult;
            // $concours = $departement->concours;
            // $faculte = DB::table('faculte')->where('code_facult', $code_facult)->first();
            // $facult = $faculte->design_facult;
            $concours = DB::table("candidats")
                ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                ->select("candidats.*", "departement.*")
                ->where("nin", $request->nin)
                ->first();
            if ($concours->concours == 1) {
                // $candidat = DB::table("candidats")
                //     ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                //     ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                //     ->join("montant", "candidats.id_type", "=", "montant.id_type")
                //     ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                //     ->where("candidats.nin", $request->nin)
                //     ->where("montant.niveau", $niveau)
                //     ->where("montant.concours", 1)
                //     ->first();

                    $pro = DB::table("candidats")
                    ->join("montant", "candidats.id_type", "=", "montant.id_type")
                    ->select("candidats.*", "montant.*")
                    ->where("candidats.nin", $request->nin)
                    ->where("montant.niveau", $niveau)
                    ->first();
                if ($pro->pro == 1) {
                    $candidat = DB::table("candidats")
                        ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                        ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                        ->join("montant", "candidats.id_type", "=", "montant.id_type")
                        ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                        ->where("candidats.nin", $request->nin)
                        ->where("montant.niveau", $niveau)
                        ->where("montant.concours", 1)
                        ->where("montant.statut", 1)
                        ->first();
                } else {
    
                    $candidat = DB::table("candidats")
                        ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                        ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                        ->join("montant", "candidats.id_type", "=", "montant.id_type")
                        ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                        ->where("candidats.nin", $request->nin)
                        ->where("montant.niveau", $niveau)
                        ->where("montant.concours", 1)
                        ->where("montant.statut", 0)
                        ->first();
                }
            } else {
                // $candidat = DB::table("candidats")
                //     ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                //     ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                //     ->join("montant", "candidats.id_type", "=", "montant.id_type")
                //     ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                //     ->where("candidats.nin", $request->nin)
                //     ->where("montant.niveau", $niveau)
                //     ->where("montant.concours", 0)
                //     ->first();

                    $pro = DB::table("candidats")
                    ->join("montant", "candidats.id_type", "=", "montant.id_type")
                    ->select("candidats.*", "montant.*")
                    ->where("candidats.nin", $request->nin)
                    ->where("montant.niveau", $niveau)
                    ->first();
                if ($pro->pro == 1) {
                    $candidat = DB::table("candidats")
                        ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                        ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                        ->join("montant", "candidats.id_type", "=", "montant.id_type")
                        ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                        ->where("candidats.nin", $request->nin)
                        ->where("montant.niveau", $niveau)
                        ->where("montant.concours", 0)
                        ->where("montant.statut", 1)
                        ->first();
                } else {
    
                    $candidat = DB::table("candidats")
                        ->join("departement", "candidats.retenu", "=", "departement.code_depart")
                        ->join("faculte", "departement.code_facult", "=", "faculte.code_facult")
                        ->join("montant", "candidats.id_type", "=", "montant.id_type")
                        ->select("candidats.*", "departement.*", "faculte.code_facult as code_faculte", "montant.code_niv as n", 'montant.Montant_chiffre as udc', 'montant.Montant_lettre as lettre', 'montant.niveau as niveau', 'montant.concours as concours')
                        ->where("candidats.nin", $request->nin)
                        ->where("montant.niveau", $niveau)
                        ->where("montant.concours", 0)
                        ->where("montant.statut", 0)
                        ->first();
                }
            }

            // if ($niveau == "N4" || $niveau == "N5") {
            //     $udc = "60000 KMF";
            //     $lettre = "Soixante mille Francs Comoriens";
            // }
            // if ($concours == 1) {
            //     if ($niveau == "l1" || $niveau == "l2") {
            //         $udc = "45000 KMF";
            //         $lettre = "Quarante cinq mille Francs Comoriens";
            //     } elseif ($niveau == "l3") {
            //         $udc = "55000 KMF";
            //         $lettre = "Cinquante cinq mille Francs Comoriens";
            //     }
            // } else {
            //     if ($niveau == "l1" || $niveau == "l2") {
            //         $udc = "40000 KMF";
            //         $lettre = "Quarante mille Francs Comoriens";
            //     } elseif ($niveau == "l3") {
            //         $udc = "50000 KMF";
            //         $lettre = "Cinquante mille Francs Comoriens";
            //     }
            // }
            // if ($niveau == "l1") {
            //     if ($concours == 1 and $code_facult != "EMSP") {
            //         $niv = "1ère Année";
            //         $n = "P1";
            //     }
            //     if ($concours == 0 || $code_facult == "EMSP") {
            //         $niv = "Licence 1";
            //         $n = "N1";
            //     }
            // }
            // if ($niveau == "l2") {
            //     if ($concours == 1 and $code_facult != "EMSP") {
            //         $niv = "2ème Année";
            //         $n = "P2";
            //     }
            //     if ($concours == 0 || $code_facult == "EMSP") {
            //         $niv = "Licence 2";
            //         $n = "N2";
            //     }
            // }
            // if ($niveau == "l3") {
            //     if ($concours == 1 and $code_facult != "EMSP") {
            //         $niv = "3ème Année";
            //         $n = "P3";
            //     }
            //     if ($concours == 0 || $code_facult == "EMSP") {
            //         $niv = "Licence 3";
            //         $n = "N3";
            //     }
            // }
            // if ($niveau == "N4") {

            //     $niv = "Master 1";
            //     $n = "N4";
            // }
            // if ($niveau == "N5") {

            //     $niv = "Master 2";
            //     $n = "N5";
            // }

            $annee = DB::table('annee')->orderByDesc("id_annee")->first();
            $annees = $annee->Annee;
            $post = DB::table("post_inscription")->where("nin", $request->nin)->where('Annee', $annees)->get();
            if ($post->count() == 0) {
                $nom = $candidat->nom;
                $prenom = $candidat->prenom;
                $lieu_naiss = $candidat->lieu_naiss;
                $date_naiss = $candidat->date_naiss;
                $date = date('d/m/Y');
                $inscription = DB::table("inscription")->Where("mat_etud", $request->matricule)->get();
                $inscriptions = DB::table("inscription")->Where("mat_etud", $request->matricule)->first();
                if ($inscription->count() > 0) {
                    $mat = $inscriptions->mat_etud;
                    $an = DB::table("post_inscription")->where("Annee", $annees)->get();
                    if ($an->count() == 0) {
                        DB::table('post_inscription')->insert([
                            'num_auto' => '1',
                            'nin' => $request->nin,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'lieu_naiss' => $lieu_naiss,
                            'date_naiss' => $date_naiss,
                            'statut' => 2,
                            'code_depart' => $candidat->retenu,
                            'code_niv' => $candidat->n,
                            'date_delivrance_fiche' => $date,
                            'code_facult' => $candidat->code_faculte,
                            'tel_mobile' => $candidat->tel_mobile,
                            'droit' => $candidat->udc,
                            'droit_lettre' => $candidat->lettre,
                            'matricule' => $mat,
                            'Annee' => $annees
                        ]);

                        Cookie::queue('nin', $request->nin, 10);
                        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                        $annees = $annee->Annee;
                        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                        $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                        $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                        $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();

                        $ch = curl_init();
                        // define options
                        $optArray = array(
                            CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                            CURLOPT_RETURNTRANSFER => true
                        );

                        // apply those options
                        curl_setopt_array($ch, $optArray);

                        // execute request and get response
                        $result = curl_exec($ch);

                        // also get the error and response code
                        $errors = curl_error($ch);
                        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        // var_dump($errors);
                        $sessionId = substr($result, 3);

                        $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date = $dt->format('Y-m-d');

                        return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "s", "date"));
                    } else {
                        $post_in = DB::table("post_inscription")->where("Annee", $annees)->orderByDesc("num_auto")->first();
                        $num = $post_in->num_auto + 1;
                        DB::table('post_inscription')->insert([
                            'num_auto' => $num,
                            'nin' => $request->nin,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'lieu_naiss' => $lieu_naiss,
                            'date_naiss' => $date_naiss,
                            'statut' => 2,
                            'code_depart' => $candidat->retenu,
                            'code_niv' => $candidat->n,
                            'date_delivrance_fiche' => $date,
                            'code_facult' => $candidat->code_faculte,
                            'tel_mobile' => $candidat->tel_mobile,
                            'droit' => $candidat->udc,
                            'droit_lettre' => $candidat->lettre,
                            'matricule' => $mat,
                            'Annee' => $annees
                        ]);

                        Cookie::queue('nin', $request->nin, 10);
                        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                        $annees = $annee->Annee;
                        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                        $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                        $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                        $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();

                        $ch = curl_init();
                        // define options
                        $optArray = array(
                            CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                            CURLOPT_RETURNTRANSFER => true
                        );

                        // apply those options
                        curl_setopt_array($ch, $optArray);

                        // execute request and get response
                        $result = curl_exec($ch);

                        // also get the error and response code
                        $errors = curl_error($ch);
                        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        // var_dump($errors);
                        $sessionId = substr($result, 3);

                        $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date = $dt->format('Y-m-d');
                        return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "s", "date"));
                    }
                } else {
                    $an = DB::table("post_inscription")->where("Annee", $annees)->get();
                    if ($an->count() == 0) {
                        DB::table('post_inscription')->insert([
                            'num_auto' => '1',
                            'nin' => $request->nin,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'lieu_naiss' => $lieu_naiss,
                            'date_naiss' => $date_naiss,
                            'statut' => 2,
                            'code_depart' => $candidat->retenu,
                            'code_niv' => $candidat->n,
                            'date_delivrance_fiche' => $date,
                            'code_facult' => $candidat->code_faculte,
                            'tel_mobile' => $candidat->tel_mobile,
                            'droit' => $candidat->udc,
                            'droit_lettre' => $candidat->lettre,

                            'Annee' => $annees
                        ]);

                        Cookie::queue('nin', $request->nin, 10);
                        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                        $annees = $annee->Annee;
                        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                        $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                        $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                        $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();

                        $ch = curl_init();
                        // define options
                        $optArray = array(
                            CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                            CURLOPT_RETURNTRANSFER => true
                        );

                        // apply those options
                        curl_setopt_array($ch, $optArray);

                        // execute request and get response
                        $result = curl_exec($ch);

                        // also get the error and response code
                        $errors = curl_error($ch);
                        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        // var_dump($errors);
                        $sessionId = substr($result, 3);

                        $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date = $dt->format('Y-m-d');
                        return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "s", "date"));
                    } else {
                        $post_in = DB::table("post_inscription")->where("Annee", $annees)->orderByDesc("num_auto")->first();
                        $num = $post_in->num_auto + 1;
                        DB::table('post_inscription')->insert([
                            'num_auto' => $num,
                            'nin' => $request->nin,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'lieu_naiss' => $lieu_naiss,
                            'date_naiss' => $date_naiss,
                            'statut' => 2,
                            'code_depart' => $candidat->retenu,
                            'code_niv' => $candidat->n,
                            'date_delivrance_fiche' => $date,
                            'code_facult' => $candidat->code_faculte,
                            'tel_mobile' => $candidat->tel_mobile,
                            'droit' => $candidat->udc,
                            'droit_lettre' => $candidat->lettre,

                            'Annee' => $annees
                        ]);

                        Cookie::queue('nin', $request->nin, 10);
                        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                        $annees = $annee->Annee;
                        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                        $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                        $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                        $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();

                        $ch = curl_init();
                        // define options
                        $optArray = array(
                            CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?2274832632922162',
                            CURLOPT_RETURNTRANSFER => true
                        );

                        // apply those options
                        curl_setopt_array($ch, $optArray);

                        // execute request and get response
                        $result = curl_exec($ch);

                        // also get the error and response code
                        $errors = curl_error($ch);
                        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        // var_dump($errors);
                        $sessionId = substr($result, 3);
                        $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date = $dt->format('Y-m-d');
                        return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "s", "date"));
                    }
                }
            } else {
                $message = "Vous avez deja une fiche";
            }
        } else {
            $etudiants = DB::table("etudiant")->where("mat_etud", $request->matricule)->get();
            $etudiant = DB::table("etudiant")->where("mat_etud", $request->matricule)->first();
            if ($etudiants->count() == 1) {
                $admission = DB::table("admission")->where('matricule', $request->matricule)->get();

                if ($admission->count() == 1) {
                    $resultat = "Admis";
                    $inscription = DB::table("inscription")
                        ->where("mat_etud", $request->matricule)
                        ->orderByDesc("annee")->first();
                    $niveau = $inscription->code_niv;
                    $code_dep = $inscription->code_depart;

                    switch ($niveau) {
                        case 'N1':
                            $code = "N2";
                            break;
                        case 'N2':
                            $code = "N3";
                            break;
                        case 'N3':
                            $code = "N4";
                            break;
                        case 'N4':
                            $code = "N5";
                            break;
                        case 'P1':
                            $code = "P2";
                            break;
                        case 'P2':
                            $code = "P3";
                            break;
                        default:
                            $m = "le niveau suivant n'est pas disponible";
                            break;
                    }

                    $nive = DB::table("niveau")->where("code_niv", $code)->first();
                    $niv = $nive->intit_niv;

                    $depz = DB::table("departement")->where("code_depart", $code_dep)->first();
                    $depart = $depz->design_depart;
                    $code_fac = $depz->code_facult;
                    $concours = $depz->concours;
                    $fa = DB::table("faculte")->where("code_facult", $code_fac)->first();
                    $facult = $fa->design_facult;
                } else {

                    $resultat = "Ajourné";
                    $inscription = DB::table("inscription")
                        ->where("mat_etud", $request->matricule)
                        ->orderByDesc("annee")->first();
                    $niveau = $inscription->code_niv;
                    $code_dep = $inscription->code_depart;
                    $nive = DB::table("niveau")->where("code_niv", $niveau)->first();
                    $niv = $nive->intit_niv;
                    $depz = DB::table("departement")->where("code_depart", $code_dep)->first();
                    $depart = $depz->design_depart;
                    $code_fac = $depz->code_facult;
                    $concours = $depz->concours;
                    $fa = DB::table("faculte")->where("code_facult", $code_fac)->first();
                    $facult = $fa->design_facult;
                }
            }

            if ($resultat == "Admis") {
                $n = $code;
            } elseif ($resultat == "Ajourné") {
                $n = $niveau;
            }

            // if ($n == "N4" || $n == "N5") {
            //     $udc = "60000 KMF";
            //     $lettre = "Soixante mille Francs Comoriens";
            // }
            // if ($concours == 1) {
            //     if ($n == "N1" || $n == "N2" || $n == "P1" || $n == "P2") {
            //         $udc = "45000 KMF";
            //         $lettre = "Quarante cinq mille Francs Comoriens";
            //     } elseif ($n == "N3" || $n == "P3") {
            //         $udc = "55000 KMF";
            //         $lettre = "Cinquante cinq mille Francs Comoriens";
            //     }
            // } else {
            //     if ($n == "N1" || $n == "N2" || $n == "P1" || $n == "P2") {
            //         $udc = "40000 KMF";
            //         $lettre = "Quarante mille Francs Comoriens";
            //     } elseif ($n == "N3" || $n == "P3") {
            //         $udc = "50000 KMF";
            //         $lettre = "Cinquante mille Francs Comoriens";
            //     }
            // }

            // $n=DB::table("montant")
            // ->join('inscription',"montant.code_niv","=","inscription.code_niv")
            // ->select("montant.code_niv as n","montant.Montant_chiffre as udc","montant.Montant_lettre as lettre","inscription.*")
            // ->where("NIN",$request->nin)
            // ->where("code_niv",$n)
            // ->orderByDesc("annee")
            // ->first();

            $n = DB::table("montant")
                ->join("etudiant","montant.statut","etudiant.profession")
                ->select("montant.*","etudiant.*")
                ->where("montant.code_niv", $n)
                ->where("mat_etud",$request->matricule)
                ->first();


            $annee = DB::table('annee')->orderByDesc("id_annee")->first();
            $annees = $annee->Annee;
            $post = DB::table("post_inscription")->where("nin", $request->nin)->where('Annee', $annees)->get();
            if ($post->count() == 0) {
                $nom = $etudiant->nom;
                $prenom = $etudiant->prenom;
                $lieu_naiss = $etudiant->lieu_naiss;
                $date_naiss = $etudiant->date_naiss;
                $date = date('d/m/Y');
                $inscription = DB::table("inscription")
                    ->Where("mat_etud", $request->matricule)
                    ->get();
                $inscriptions = DB::table("inscription")
                    ->Where("mat_etud", $request->matricule)->first();
                $inscription1 = DB::table("inscription")->where("mat_etud", $request->matricule)->orderByDesc("annee")->first();
                if ($inscription->count() > 0) {
                    $mat = $inscriptions->mat_etud;
                    $an = DB::table("post_inscription")->where("Annee", $annees)->get();
                    if ($an->count() == 0) {
                        DB::table('post_inscription')->insert([
                            'num_auto' => '1',
                            'nin' => $request->nin,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'lieu_naiss' => $lieu_naiss,
                            'date_naiss' => $date_naiss,
                            'statut' => 2,
                            'code_depart' => $inscription1->code_depart,
                            'code_niv' =>  $n->code_niv,
                            'date_delivrance_fiche' => $date,
                            'code_facult' => $code_fac,
                            'tel_mobile' => $etudiant->Tel_Etud,
                            'droit' =>  $n->Montant_chiffre,
                            'droit_lettre' => $n->Montant_lettre,
                            'matricule' => $mat,
                            'Annee' => $annees
                        ]);

                        Cookie::queue('nin', $request->nin, 10);
                        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                        $annees = $annee->Annee;
                        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                        $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                        $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                        $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();

                        $ch = curl_init();
                        // define options
                        $optArray = array(
                            CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                            CURLOPT_RETURNTRANSFER => true
                        );

                        // apply those options
                        curl_setopt_array($ch, $optArray);

                        // execute request and get response
                        $result = curl_exec($ch);

                        // also get the error and response code
                        $errors = curl_error($ch);
                        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        // var_dump($errors);
                        $sessionId = substr($result, 3);

                        $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date = $dt->format('Y-m-d');
                        return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "date", "s"));
                    } else {
                        $post_in = DB::table("post_inscription")->where("Annee", $annees)->orderByDesc("num_auto")->first();
                        $num = $post_in->num_auto + 1;
                        DB::table('post_inscription')->insert([
                            'num_auto' => $num,
                            'nin' => $request->nin,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'lieu_naiss' => $lieu_naiss,
                            'date_naiss' => $date_naiss,
                            'statut' => 2,
                            'code_depart' => $inscription1->code_depart,
                            'code_niv' =>  $n->code_niv,
                            'date_delivrance_fiche' => $date,
                            'code_facult' => $code_fac,
                            'tel_mobile' => $etudiant->Tel_Etud,
                            'droit' =>  $n->Montant_chiffre,
                            'droit_lettre' =>  $n->Montant_lettre,
                            'matricule' => $mat,
                            'Annee' => $annees
                        ]);
                        Cookie::queue('nin', $request->nin, 10);
                        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
                        $annees = $annee->Annee;
                        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
                        $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                        $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                        $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();

                        $ch = curl_init();
                        // define options
                        $optArray = array(
                            CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                            CURLOPT_RETURNTRANSFER => true
                        );

                        // apply those options
                        curl_setopt_array($ch, $optArray);

                        // execute request and get response
                        $result = curl_exec($ch);

                        // also get the error and response code
                        $errors = curl_error($ch);
                        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                        curl_close($ch);

                        // var_dump($errors);
                        $sessionId = substr($result, 3);
                        $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                        $dt = new DateTime();
                        $date = $dt->format('Y-m-d');
                        return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "s", "date"));
                    }
                }
            }
        }
    }

    public function recherche_autorisation(Request $request)
    {
        $annee = DB::table('annee')->orderByDesc("id_annee")->first();
        $annees = $annee->Annee;
        $data = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->first();
        $datas = DB::table("post_inscription")->where("nin", $request->nin)->where("Annee", $annees)->get();
        $inscription = DB::table("inscription")->where("nin", $request->nin)->where("Annee", $annees)->orderByDesc("Annee")->get();
        if ($inscription->count() == 0) {
            if ($datas->count() == 1) {
                $composante = DB::table("faculte")->where("code_facult", $data->code_facult)->first();
                $departement = DB::table("departement")->where("code_depart", $data->code_depart)->first();
                $niveau = DB::table("niveau")->where("code_niv", $data->code_niv)->first();
                $candidat = DB::table("candidats")->where("nin", $request->nin)->get();
                $candidats = DB::table("candidats")->where("nin", $request->nin)->first();
                Cookie::queue('nin', $request->nin, 10);

                $ch = curl_init();
                // define options
                $optArray = array(
                    CURLOPT_URL => 'https://26900.tagpay.fr/online/online.php?merchantid=2274832632922162',
                    CURLOPT_RETURNTRANSFER => true
                );

                // apply those options
                curl_setopt_array($ch, $optArray);

                // execute request and get response
                $result = curl_exec($ch);

                // also get the error and response code
                $errors = curl_error($ch);
                $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                curl_close($ch);

                // var_dump($errors);
                $sessionId = substr($result, 3);
                $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                $dt = new DateTime();
                $date = $dt->format('Y-m-d');
                if ($candidat->count() == 0) {
                    return view("autorisation", compact("data", "composante", "departement", "niveau", "sessionId", "s", "date"));
                } else {
                    return view("autorisation", compact("data", "composante", "departement", "niveau", "candidats", "sessionId", "s", "date"));
                }
            } else {
                $message = "Vous n'avez pas encore une fiche";
                $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
                $dt = new DateTime();
                $date = $dt->format('Y-m-d');
                return view("recherche_auto", compact("message", "s", "date"));
            }
        } else {

            $message = "Vous etes deja inscris cette année";
            $s = DB::table('date_fin')->where('type', 2)->orderByDesc('id_date')->first();
            $dt = new DateTime();
            $date = $dt->format('Y-m-d');

            return view("recherche_auto", compact("message", "s", "date"));
        }
    }
}
