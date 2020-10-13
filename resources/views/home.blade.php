@extends('layouts.layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col s12 center mt-1">
        <p class="alert green-text">{{session('message')}}</p>
    </div>
    <div class="col s12 mb-1 banner-slider">
      <div class="carousel carousel-slider center">
        <div class="carousel-item white-text" href="#one!">
          <a href="#">
            <img class="responsive-img"src="images/lukban web cover.png" alt="" height="100%">
          </a>
        </div>
        <div class="carousel-item white-text" href="#one!">
          <a href="#">
            <img class="responsive-img"src="images/lukban web cover.png" alt="" height="100%">
          </a>
        </div>
        <div class="carousel-item  white-text" href="#one!">
          <a href="#">
            <img class="responsive-img"src="https://xeecovers.com/wp-content/uploads/2013/07/Ferrari-458-Italia.png" alt=""height="100%">
          </a>
        </div>
        <div class="carousel-item  white-text" href="#one!">
          <a href="#">
            <img class="responsive-img"src="https://covernator.com/coverImages/ferrari-italia.jpg" alt=""height="100%">
          </a>
        </div>
      </div>
    </div>

    <div class="col s12 m12 l12">
      <h4 class="flow-text"style="font-weight:bold">Products</h4>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/products/product-1.jpg" alt="product 1">
        </div>
        <div class="card-content">
          <a href="product.php" class="product-name truncate flow-text">Alternator - Isuzu</a>
          <h6 class="product-price">P1600</h6>
          <a href=""class="yellow-text">
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
          </a><br>
          <a href="#"class="grey-text">Depo</a>
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/products/product-1.jpg" alt="product 1">
        </div>
        <div class="card-content">
          <a href="product.php" class="product-name truncate flow-text">Alternator - Isuzu</a>
          <h6 class="product-price">P1600</h6>
          <a href=""class="yellow-text">
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
          </a><br>
          <a href="#"class="grey-text">Depo</a>
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/products/product-1.jpg" alt="product 1">
        </div>
        <div class="card-content">
          <a href="product.php" class="product-name truncate flow-text">Alternator - Isuzu</a>
          <h6 class="product-price">P1600</h6>
          <a href=""class="yellow-text">
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
          </a><br>
          <a href="#"class="grey-text">Depo</a>
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/products/product-1.jpg" alt="product 1">
        </div>
        <div class="card-content">
          <a href="product.php" class="product-name truncate flow-text">Alternator - Isuzu</a>
          <h6 class="product-price">P1600</h6>
          <a href=""class="yellow-text">
            <i class="material-icons tiny">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
            <i class="material-icons tiny grey-text text-lighten-1">star</i>
          </a><br>
          <a href="#"class="grey-text">Depo</a>
        </div>
      </div>
    </div>
    <div class="col s12">
      <a href="/customer/search/all" class="btn blue right">Show more</a>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <h5 class="flow-text"style="font-weight:bold">Car Brand</h5>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://www.car-brand-names.com/wp-content/uploads/2015/08/Chevrolet-logo.png" alt="" height="100%">
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://www.carlogos.org/logo/Kia-symbol-2560x1440.png" alt="">
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://1000logos.net/wp-content/uploads/2018/04/Hyundai-Logo.png" alt="">
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="https://www.carlogos.org/logo/Isuzu-logo-1991-3840x2160.png" alt="">
        </div>
      </div>
    </div>
    <div class="col s12">
      <button class="btn blue right">Show more...</button>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <h5 class="flow-text"style="font-weight:bold">Car parts</h5>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/category/bosskit.jpg" alt="">
        </div>
        <div class="content">
          <h5 class="flow-text center-align"style="font-weight:bold">Bosskit</h5>
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/category/bosskit.jpg" alt="">
        </div>
        <div class="content">
          <h5 class="flow-text center-align"style="font-weight:bold">Bosskit</h5>
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/category/bosskit.jpg" alt="">
        </div>
        <div class="content">
          <h5 class="flow-text center-align"style="font-weight:bold">Bosskit</h5>
        </div>
      </div>
    </div>
    <div class="col s6 m6 l3">
      <div class="card">
        <div class="card-image">
          <img src="images/category/bosskit.jpg" alt="">
        </div>
        <div class="content">
          <h5 class="flow-text center-align"style="font-weight:bold">Bosskit</h5>
        </div>
      </div>
    </div>
    <div class="col s12">
      <button class="btn right blue">Show more...</button>
    </div>
  </div>
</div>

@endsection