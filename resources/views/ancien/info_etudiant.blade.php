<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Universite des comores</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/masonry/">



    <!-- Bootstrap core CSS -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="styles.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>

<main class="container py-5">




   <div class="container text-center rad" style="margin-top:150px;">
        <h2 class="text-center">Information Etudiant</h2><br>
        @isset($resultat)
            <h6>Resultat: {{$resultat}}</h6>
        @endisset
        <form method="POST" action="{{route('autorisation_an')}}">
            @csrf
            <div class="container" >


                <div class="row mb-3">

                    <div class="col-md-2 ">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                    <div class="col-md-4 ">
                        <h4>Nin: {{$nin}}</h4>
                    </div>
                    <div class="col-md-4 ">
                    @if($p==1)
                        <h4>Matricule: {{$matricule}}</h4>
                    @elseif($p==0)
                        <h4>Type de Pré-inscription: {{$recu->nom_type}}</h4>

                    @endif

                    </div>
                    <div class="col-md-2 ">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                  </div>
                  <div class="row mb-3">
                   <div class="col-md-2 ">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                    <div class="col-md-4">
                        <h4>Nom: {{$nom}}</h4>

                    </div>
                    <div class="col-md-4">
                        <h4>Prenom: {{$prenom}}</h4>
                      </div>
                      <div class="col-md-2">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                  </div>

                   <div class="row mb-3">
                   <div class="col-md-2 ">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                    <div class="col-md-4">
                        <h4>Date Naissance: {{$date_n}}</h4>

                    </div>
                    <div class="col-md-4">
                        <h4>Lieu Naissance: {{$lieu_naiss}}</h4>
                      </div>
                      <div class="col-md-2 ">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                  </div>
                   <div class="row mb-3">
                   <div class="col-md-2">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                    <div class="col-md-4">
                        {{-- <h4>Retenu: {{$departement->design_depart}}</h4> --}}
                        @if($p==0)
                        <h4><h4>Retenu: {{$departement->design_depart}}</h4></h4>

                    @endif
                    </div>
                   <div class="col-md-2 ">

                      {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                    </div>
                  </div>
                     @if($p==0)
                        @if($type_recu==4 || $type_recu==5)
                        <div class="row mb-3">
                    <div class="col-md-4">

                        {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="niveau">
                                <option value="l1">License 1</option>
                                <option value="l2">License 2</option>
                                <option value="l3">License 3</option>
                                <option value="N4">Master 1</option>
                                <option value="N5">Master 2</option>

                            </select>
                        </div>
                    <div class="col-md-4 ">

                        {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                        </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-4">

                        {{-- <input type="text" class="form-control" placeholder="Nin" id="inputEmail3"> --}}
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="telephone" placeholder="Telephone">
                        </div>
                    <div class="col-md-2 ">
                        @elseif($type_recu==1)
                        <input type="hidden" value="l1" name="niveau" class="form-control"  id="inputEmail3">
                        @elseif($type_recu==2)
                        <input type="hidden" value="l2" name="niveau" class="form-control"  id="inputEmail3">
                        @elseif($type_recu==3)
                        <input type="hidden" value="l3" name="niveau" class="form-control"  id="inputEmail3">
                        @elseif($type_recu==6)
                        <input type="hidden" value="N4" name="niveau" class="form-control"  id="inputEmail3">
                        @elseif($type_recu==7)
                        <input type="hidden" value="N5" name="niveau" class="form-control"  id="inputEmail3">
                        </div>
                    </div>
                    @endif
                  @endif
                  <input type="hidden" value="{{$nin}}" name="nin" class="form-control"  id="inputEmail3">
                  <input type="hidden" value="{{$matricule}}" name="matricule" class="form-control"  id="inputEmail3">
            </div>



            <button type="Envoyez" class="btn btn-primary">Confirmez</button>
          </form>
   </div>



</main>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

      <script async src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"></script>
  </body>
</html>
