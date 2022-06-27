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
    // $dt->add(new DateInterval('P6D'));
    $date= $dt->format('Y-m-d');
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->first();
    return view('index',compact('post','date','s'));
})->name('accueil');
Route::get('/carte_jour', function () {

    $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
    $dt = new DateTime();
    // $dt->add(new DateInterval('P6D'));
    $date= $dt->format('Y-m-d');
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->first();
    return view('carte_jour',compact('date','s'));
})->name('carte_jour');

Route::get('/accepturl', function () {

    $Annee=DB::table('annee')->orderByDesc('id_annee')->first();
    $nin=Cookie::get('nin');
    $post=DB::table("post_inscription")->where("nin",$nin)->where("Annee",$Annee->Annee)->first();
    $s=DB::table('date_fin')->where('type',2)->orderByDesc('id_date')->first();
    $dt = new DateTime();
    $date= $dt->format('Y-m-d');
    return view('success',compact('post',"s","date"));
});

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

Route::get('/choix', [pageController::class, 'choix'])->name('choix');
Route::post('/inscription', [pageController::class,'inscription'])->name('inscription');
Route::get('/inscription', [pageController::class,'inscription'])->name('inscription');
Route::post('/Candidat_nouveau', [CandidatController::class,'candidat_nv'])->name('recherche_candidat');
Route::post('/etudiant', [CandidatController::class,'candidat_an'])->name('recherche_etudiant');
Route::post('/autorisation_etudiant', [PostInscriptionController::class,'autorisation_an'])->name('autorisation_an');
Route::resource('/autorisation', PostInscriptionController::class);
Route::resource('/fiche', QuitusController::class);
Route::get('/photo_cartes',[CarteController::class,'index'])->name('photo_cartes');

Route::post('/add_photo',[CarteController::class,'store'])->name('add_photo');
// Route::get('/fin_inscription',[FinInsController::class,'index'])->name('fin_inscription');
Route::resource('/fin_inscription', FinInsController::class);
Route::post('/recherche_auto', [PostInscriptionController::class,'recherche_autorisation'])->name('recherche_auto');
Route::get('/recherche_autorisation', function () {
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


