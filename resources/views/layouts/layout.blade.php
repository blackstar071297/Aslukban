<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/css/styles.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>   
<div class="navbar-fixed mb-2">
  <nav class="nav-extended">
    <div class="nav-wrapper">
      <!-- <a href="#!" class="brand-logo"><i class="left fas fa-car fa-2x  hide-on-med-and-down"></i><span class="">AS Lukban</span></a> -->
      <!-- <a href="#!" class="brand-logo hide-on-med-and-down"style="margin-top:5px;margin-right:10px;margin-left:10px"><img src="images/coverphoto.png"width="40%" alt=""></a> -->
      <a href=""class="brand-logo"><img src="/images/coverphoto.png"style="margin-top:8px;margin-left:8px" width="270px"height="50px" alt="ASLukban logo"></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/"><i class="left material-icons">home</i>Home</a></li>
        <!-- <li><a href="badges.html"><i class="left material-icons">favorite</i>Wishlist</a></li> -->
        @if(Auth::guard('customer')->guest())
          <li><a href="{{ url('/customer/login') }}"><i class="left material-icons">shopping_cart</i>Cart</a></li>
          <li><a href="{{ url('/customer/login') }}">Login</a></li>
          <li><a href="{{ url('/customer/register') }}">Register</a></li>
        @else
        <li><a href="/customer/{{ Auth::guard('customer')->user()->id }}/cart"><i class="left material-icons">shopping_cart</i>Cart<span class="circle-badge">{{count(App\Cart::where('id',Auth::guard('customer')->user()->id)->get())}}</span></a></li>
          <li><a class="dropdown-trigger" href="#!" data-target="user_dropdown">{{ Auth::guard('customer')->user()->first_name }}<i class="material-icons right">arrow_drop_down</i></a></li>
        @endif
      </ul>
    </div>
    @if(Auth::guard('customer')->guest())
    @else
    <ul id="user_dropdown" class="dropdown-content">
      <li><a href="/customer/profile/{{ Auth::guard('customer')->user()->id }}">My Profile</a></li>
      <li><a href="/customer/profile/{{ Auth::guard('customer')->user()->id }}/order">My orders</a></li>
      <li><a href="{{ url('/customer/logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
      <form id="logout-form" action="{{ url('/customer/logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </ul>
    @endif
    <div class="nav-content"style="margin-top:2px;margin-bottom:0px;">
      <div class="row container"style="margin-bottom:0px">
      <form action="/search">
        <div class="input-field col s6">
          <input type="text"class="input-search white default-input"name="q">
          <a href="/search" style="color:#4b4f56"><i class="material-icons right btn-right">search</i></a>
        </div>
      </form>

        <div class="input-field col s6">
           <select class="browser-default white">
              <option value="" disabled selected></option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
        </div>
      </div>
    </div>
  </nav>
</div>


<ul class="sidenav" id="mobile-demo">
  <li><a href="/"><i class="left material-icons">home</i>Home</a></li>
  @if(Auth::guard('customer')->guest())
    <li><a href="{{ url('/customer/login') }}"><i class="left material-icons">shopping_cart</i>Cart<span class="circle-badge">4</span></a></li>
    <li><a href="{{ url('/customer/login') }}"><i class="material-icons">login</i>Login</a></li>
    <li><a href="{{ url('/customer/register') }}"><i class="material-icons">create</i>Register</a></li>
  @else
    <li><a href="/customer/{{ Auth::guard('customer')->user()->id }}/cart"><i class="left material-icons">shopping_cart</i>Cart<span class="circle-badge">4</span></a></li>
    <li><a href="/customer/profile/{{ Auth::guard('customer')->user()->id }}"><i class="material-icons">account_box</i>Profile</a></li>
    <li><a href="{{ url('/customer/logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">login</i>Logout</a></li>
    <form id="logout-form" action="{{ url('/customer/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  @endif
</ul>

@yield('content')
<div class="modal"id="registrationModal"style="background-color:#374A8E">
  <div class="modal-content">
    <div class="container">
      <div class="row">
        <form action="">
          <div class="col s12 center">
            <img src="{{ asset('storage/images/coverphoto.jpg') }}" alt="" class="responsive-img" width="60%">
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix white-text">account_circle</i>
            <input type="text" class="validate white-text"placeholder="Enter username">
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix white-text">lock</i>
            <input type="password" class="validate white-text"placeholder="Enter password">
          </div>
          <div class="input-field col s12">
            <button class="btn w-100"style="background-color:#F58635">Login</button> 
            
          </div>
          <div class="input-field col s12"style="margin-top:5px">
            <p class=" white-text"style="margin:0px;">Or Login with</p>  
            <button class="btn w-100"style="background-color:#4267b2;margin-bottom:10px"><i class="fab fa-facebook-f left"></i>Facebook</button>
            <button class="btn w-100 red"><i class="fab fa-google-plus-g left"></i>Google</button>
          </div>
          <div class="col s12">
            <a href=""class=" white-text"style="margin:0px">Forgot password?</a><br>
            <a href=""class=" white-text"style="margin:0px">Sign up</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<footer class="page-footer">
<div class="container">
  <div class="row">
    <div class="col l3 offset-l1 s12">
      <h5 class="white-text">Payment Method</h5>
      <ul>
        <li><a href="#" class="grey-text text-lighten-3">Gcash</a></li>
        <li><a href="#" class="grey-text text-lighten-3">BDO</a></li>
        <li><a href="#" class="grey-text text-lighten-3">Paymaya</a></li>
        <li><a href="#" class="grey-text text-lighten-3">Paypal</a></li>
        <li><a href="#" class="grey-text text-lighten-3">PNB</a></li>
      </ul>
    </div>
    <div class="col l3 offset-l1 s12">
      <h5 class="white-text">Shipping Method</h5>
      <ul>
        <li><a class="grey-text text-lighten-3" href="#!">LBC</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">JRS Express</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Lalamove</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Apcargo</a></li>
      </ul>
    </div>
    <div class="col l3 offset-l1 s12">
      <h5 class="white-text">Company</h5>
      <ul>
        <li><a class="grey-text text-lighten-3" href="#!">About us</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Our story</a></li>
      </ul>
    </div>


  </div>
  
</div>
<div class="footer-copyright">
  <div class="container">
  <p class="center-align">© 2020 AS Lukban</p>
  </div>
</div>
</footer>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/address.js"></script>
</body>
</html>