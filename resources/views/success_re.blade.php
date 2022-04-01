<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Universite Des Comores</title>
  </head>
  <body>
    <section class="form-08">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="_form-08-main">
               @if(Cookie::get('nin') !== null)
              <div class="_form-08-head">
                <h2>Bonjour {{ $post->nom}} {{ $post->prenom}}</h2>
              </div>

              <!-- <div class="form-group">
                <label>Enter Your Email</label>
                <input type="email" name="email" class="form-control" type="text" placeholder="Enter Email" required="" aria-required="true">
              </div>

              <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password" class="form-control" type="text" placeholder="Enter Password" required="" aria-required="true">
              </div>

              <div class="checkbox mb-0 form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="">
                  <label class="form-check-label" for="">
                    Remember me
                  </label>
                </div>
                <a href="#">Forgot Password</a>
              </div> -->
              @isset($message)
              <div class="alert alert-danger col-md-12">{{ $message }}</div>
             @endisset
              <form action="{{route('fiche.store')}}" method="POST">
                @csrf
              <h6 class="text-center">Veuillez continuer votre inscription pédagogique</h6>
              <div class="form-group">
                <div class="row">
                    <div class="col-md-4 col-sm-4"></div>
                    <div class="col-md-8 col-sm-8"><br>
                        <input type="hidden" name="nin" value="{{$post->nin}}">
                        <input type="hidden" name="num_auto" value="{{$post->num_auto}}">
                        <input type="submit" class="btn btn-success text-center" name="ok" value="Continuez">
                    </div>
                  {{-- <a href="{{ route('choix',$post->nin) }}">Continuez</a> --}}
                </div>
                {{-- <p style="text-align:center;" class="fiche"><a href="{{ route('auto') }}">Cliquez ici si vous avez deja une fiche</a></p> --}}
              </div>
              </form>
              <div class="sub-01">
                {{-- <img src="assets/images/shap-02.png"> --}}
              </div>
               @else
               <p class="text-center">Veuillez payer votre droit</p>
            <p class="text-center">Cliquez  <a href="{{route('accueil')}}" style="color: red" >ici</a> pour retourner à la page d'accueil</p>
            @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
