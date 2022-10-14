<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

use App\Http\Controllers\pageController;
use App\Http\Controllers\QuitusController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\FinInsController;
use App\Http\Controllers\PostInscriptionController;
use App\Models\carte;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $dt = new DateTime();
    $date= $dt->format('Y-m-d');
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->first();
    return view('index',compact('post','date'));
});

Route::get('/', function () {

    $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
    $dt = new DateTime();
    $date= $dt->format('Y-m-d');
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->first();
    return view('index',compact('post','date','s'));
})->name('accueil');

Route::get('/accepturl', function () {

    $Annee=DB::table('annee')->orderByDesc('id_annee')->first();
    $nin=Cookie::get('nin');
    // $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$Annee->Annee)->first();
    // $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
    // $dt = new DateTime();
    // $date= $dt->format('Y-m-d');
    // return view('success',compact('post',"s","date"));

    $et=DB::table("etudiant")->where("NIN",$nin)->first();
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
                    return view ("fiche",compact("message","data",'datas'));
                
});

// Route::get('/notification', function () {

//     $Annee=DB::table('annee')->orderByDesc('id_annee')->first();
//     $nin=Cookie::get('nin');
//     $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$Annee->Annee)->first();
//     $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
//     $dt = new DateTime();
//     $date= $dt->format('Y-m-d');
//     $paymentref=$_GET['paymentref'];
//     $purchaseref= substr($_GET['purchaseref'], 1);
//     $ins_quitus=DB::table("Trans")->insert([
//         "reference"=>$paymentref,
//        "nin"=>$purchaseref
//     ]);
//     // return view('success',compact('post',"s","date"));
// });

Route::get('/accepturl_83594384', function () {

    $Annee=DB::table('annee')->orderByDesc('id_annee')->first();
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$Annee->Annee)->first();
    $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
    $dt = new DateTime();
    $date= $dt->format('Y-m-d');
    return view('success_re',compact('post',"date","s"));
});


Route::get('/cancelurl', function () {
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->first();
    return view('cancel',compact('post'));
});

Route::get('/declineurl', function () {
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->first();
    return view('failed',compact('post'));
});

Route::get('/photo_nga/{id}',[CarteController::class, 'photo_nga'])->name('photo_nga');
Route::get('/photo_an/{id}',[CarteController::class, 'photo_an'])->name('photo_an');
Route::get('/choix', [pageController::class, 'choix'])->name('choix');
Route::post('/inscription', [pageController::class,'inscription'])->name('inscription');
Route::get('/inscription', [pageController::class,'inscription'])->name('inscription');
Route::post('/Candidat_nouveau', [CandidatController::class,'candidat_nv'])->name('recherche_candidat');
Route::post('/etudiant', [CandidatController::class,'candidat_an'])->name('recherche_etudiant');
Route::post('/autorisation_etudiant', [PostInscriptionController::class,'autorisation_an'])->name('autorisation_an');
Route::resource('/autorisation', PostInscriptionController::class);
Route::resource('/fiche', QuitusController::class);
Route::get('/photo_cartes',[CarteController::class,'index'])->name('photo_cartes');
Route::get('/notification',[QuitusController::class,'notification']);
Route::post('/add_photo',[CarteController::class,'store'])->name('add_photo');
Route::post('photo_ngazidja/getDepartement',[CarteController::class,'getDepartement'])->name('getDepartement');
Route::get('/filtre_ngazidja',[CarteController::class,'filtre_ngazidja'])->name('filtre_ngazidja');
Route::get('/filtre_anjouan',[CarteController::class,'filtre_anjouan'])->name('filtre_anjouan');
Route::post('/photo_ngazidja',[CarteController::class,'photo_ngazidja'])->name('photo_ngazidja');
Route::post('/photo_anjouan',[CarteController::class,'photo_anjouan'])->name('photo_anjouan');
// Route::get('/photo_nga/{$id}',[CarteController::class,'photo_nga'])->name('photo_nga');

// Route::get('/fin_inscription',[FinInsController::class,'index'])->name('fin_inscription');
Route::resource('/fin_inscription', FinInsController::class);
Route::post('/recherche_auto', [PostInscriptionController::class,'recherche_autorisation'])->name('recherche_auto');
Route::post('/recherche_autorisation', function () {
	   $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
	    $dt = new DateTime();
	    $date= $dt->format('Y-m-d');
    return view('recherche_auto',compact("s","date"));
})->name('auto');

Route::get('/recherche_autorisation_83594384', function () {
	$s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
	    $dt = new DateTime();
	    $date= $dt->format('Y-m-d');

    return view('recherche_auto_re',compact("s","date"));
})->name('auto');


Route::get('/recherche_fiche', function () {
    return view('recherche_fiche');
})->name('fiche');

Route::post('/fiche_renseignement', function (Request $request) {
    $data1 = DB::table('inscription')
        ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
        ->select('inscription.*','etudiant.*')
        ->where("inscription.mat_etud",$request->matricule)->orderByDesc("Annee")->get();
        if($data1->count() >=1)
        {
            $Annee=DB::table('annee')->orderByDesc('id_annee')->first();
            $data2 = DB::table('inscription')
            ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
            ->select('inscription.*','etudiant.*')
            ->where("inscription.mat_etud",$request->matricule)->where("inscription.Annee",$Annee->Annee)->orderByDesc("Annee")->get();
            if($data2->count()>=1){

                $data = DB::table('inscription')
                ->join('etudiant', 'inscription.mat_etud', '=', 'etudiant.mat_etud')
                ->select('inscription.*','etudiant.*')
                ->where("inscription.mat_etud",$request->matricule)->orderByDesc("Annee")->first();
                $datas = DB::table('inscription')
                ->join('niveau', 'inscription.code_niv', '=', 'niveau.code_niv')
                ->join('departement', 'inscription.code_depart', '=', 'departement.code_depart')
                ->join('faculte', 'departement.code_facult', '=', 'faculte.code_facult')
                ->select('inscription.*','niveau.*','departement.*','faculte.*')
                ->where("inscription.mat_etud",$request->matricule)->orderByDesc("Annee")->get();
                return view('fiche',compact('data','datas'));
            }
            else
            {
                $message="Vous n'etes pas inscris cette annee";
                return view('recherche_fiche',compact('message'));
            }

        }
        else{

            $message="Cette matricule n'existe pas";
            return view('recherche_fiche',compact('message'));

        }

 })->name('renseignement');


