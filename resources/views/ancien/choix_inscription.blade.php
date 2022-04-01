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
        <h2 class="text-center">Que voulez-vous faire?</h2><br>
        <form method="POST" action="{{ route('inscription') }}">
            @csrf
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inscription" id="inlineRadio1" value="re-inscription" style="font-size:25px;">
                <label class="form-check-label" for="inlineRadio1"><span style="font-size:25px;">Re-inscription<span></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inscription" id="inlineRadio2" value="nv_inscription" style="font-size:25px;">
                <label class="form-check-label" for="inlineRadio2"><span style="font-size:25px;">Nouvel inscription<span></label>
            </div>
            <div class="row">
                <div class="col-"><br>
                    <button type="submit" class="btn btn-success">Envoyez</button>
                </div>
            </div>
        </form>
   </div>



</main>


    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

      <script async src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"></script>
  </body>
</html>
