<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/animation.css">
    @stack('css')
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>AS lukban</title>
</head>

<body>   
<div class=""id="navbar-fixed">
  <nav class="nav-extended">
    <div class="nav-wrapper hide-on-med-and-down">
      <a href="/"class="brand-logo"><img src="/images/coverphoto.png"width="250px"height="50px" alt="ASLukban logo"style="margin:10px"></a>
      <ul class="right">
        @php
          $category = App\Category::all();
        @endphp
        @foreach($category as $category)
          <li><a href="/search?q={{$category->category_name}}">{{$category->category_name}}</a></li>
        @endforeach
        @if(Auth::guard('customer')->guest())
          <li><a href="{{ url('/customer/login') }}">Login</a></li>
          <li><a href="{{ url('/customer/register') }}">Register</a></li>
        @else
          <li><a class="dropdown-trigger" href="#!" data-target="user_dropdown">{{ Auth::guard('customer')->user()->first_name }}<i class="material-icons right">arrow_drop_down</i></a></li>
        @endif
      </ul>
    </div>
    <div class="nav-content"style="background:transparent">
      <div class="row"style="margin-bottom:0 !important">
        <div class="col s2 show-on-medium-and-down">
          <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
        <div class="col s8 m8 l12"style="margin-top:10px">
          <div class="wrap">
            <div class="search">
              <form action="/search" class="search-form">
                  <input type="text"class="searchTerm" placeholder="What are you looking for?"name="q">
                  <select name="category" id=""class="browser-default searchFilter hide-on-med-and-down">
                    <option value=""disabled selected>All Category</option>
                    <option value="">Radiator Assembly</option>
                  </select>
                  <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                  </button>
              </form>
            </div>
          </div>
        </div>
        <div class="col s2 center-align">
        <a href="#" data-target="filter-nav" class="sidenav-trigger"><i class="material-icons">filter_alt</i></a>
        </div>

      </div>
      
    </div>
    <ul id="category_dropdown" class="dropdown-content">
      <li></li>
    </ul>
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
  </nav>
</div>

<ul class="sidenav" id="mobile-nav">
    <li><a href="/"><i class="left material-icons">home</i>Home</a></li>
  @if(Auth::guard('customer')->guest())
    <li><a href="{{ url('/customer/login') }}"><i class="left material-icons">shopping_cart</i>Cart<span class="circle-badge">4</span></a></li>
    <li><a href="{{ url('/customer/login') }}"><i class="material-icons">login</i>Login</a></li>
    <li><a href="{{ url('/customer/register') }}"><i class="material-icons">create</i>Register</a></li>
  @else
    <li><a href="/customer/profile/{{ Auth::guard('customer')->user()->id }}"><i class="material-icons">account_box</i>Profile</a></li>
    <li><a href="{{ url('/customer/logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">login</i>Logout</a></li>
    <form id="logout-form" action="{{ url('/customer/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
  @endif
</ul>
<form action="" method="get">
@csrf
  <ul class="sidenav collapsible" id="filter-nav">
    <li>
      <div class="collapsible-header text-bold">Category <i class="material-icons">arrow_drop_down</i></div>
      <div class="collapsible-body"style="line-height: 0 !important">
        <div class="input-field"style="display:none">
            <input id="query"type="hidden" name="q" value="@if(isset($q)) $q @endif">
        </div>
        @php
            $category = App\Category::all()
        @endphp
        @foreach($category as $category)
            @php
                $checked = ''
            @endphp
            @if(!empty(old('category')))
                @foreach(old('category') as $old)
                    @if($category->category_name === $old) 
                        @php
                            $checked = 'checked' 
                        @endphp  
                    @endif
                @endforeach
            @endif

            <p>
                <label>
                    <input type="checkbox" name="category[]" value="{{$category->category_name}}"  {{$checked}}/>
                    <span class="black-text">{{$category->category_name}}</span>
                </label>
            </p>
        @endforeach 
      </div>
    </li>
    <li>
    <div class="collapsible-header text-bold">Product brand<i class="material-icons">arrow_drop_down</i></div>
      <div class="collapsible-body"style="line-height: 0 !important">
        @php
            $manufacturers = App\Manufacturer::all()
        @endphp
        @foreach($manufacturers as $manufacturer)
            @php
                $checked = ''
            @endphp
            @if(!empty(old('manufacturer')))
                @foreach(old('manufacturer') as $old)
                    @if($manufacturer->manufacturer_name === $old) 
                        @php
                            $checked = 'checked' 
                        @endphp  
                    @endif
                @endforeach
            @endif
            <p style="margin:0 !important">
                <label>
                    <input type="checkbox" name="manufacturer[]" value="{{$manufacturer->manufacturer_name}}" {{$checked}}/>
                    <span>{{$manufacturer->manufacturer_name}}</span>
                </label>
            </p>
        @endforeach
      </div>
    </li>
    <li>
      <button type="submit"class="btn blue w-100">Apply Filter</button>
    </li>
    <li>
      <button type="submit"class="btn w-100"style="margin-top:2px" id="reset_btn">Reset filter</button>
    </li>
  </ul>
</form>
@yield('content')
<div class="row right">
    <div class="col s12">
      <div class="shopping-cart fixed-action-btn">
        @if(Auth::guard('customer')->guest())
          <a href="{{ url('/customer/login') }}"class="btn-floating btn-large blue pulse">
            <i class="large material-icons">shopping_cart</i>
          </a>
        @else
          <a href="/customer/{{ Auth::guard('customer')->user()->id }}/cart"class="btn-floating btn-large blue pulse">
            <i class="left material-icons">shopping_cart</i>Cart
            @if(count(App\Cart::where('id',Auth::guard('customer')->user()->id)->get())) > 0)
              <span class="circle-badge">{{count(App\Cart::where('id',Auth::guard('customer')->user()->id)->get())}}</span>
            @endif
          </a>
        @endif
      </div>
    </div>
  </div>
</div>

<footer class="page-footer">
  <div class="center">
      <a href="#" class="scrollToTop btn btn-small btn-floating blue"><i class="material-icons center">arrow_upward</i></a>
    </div>
  <div class="row">
    <div class="col m4 l4 s12 center">
      <h5 class="white-text">Payment Method</h5>
      <ul>
        <li><a href="#" class="grey-text text-lighten-3">Gcash</a></li>
        <li><a href="#" class="grey-text text-lighten-3">BDO</a></li>
        <li><a href="#" class="grey-text text-lighten-3">Paymaya</a></li>
        <li><a href="#" class="grey-text text-lighten-3">Paypal</a></li>
        <li><a href="#" class="grey-text text-lighten-3">PNB</a></li>
      </ul>
    </div>
    <div class="col m4 l4 s12 center">
      <h5 class="white-text">Shipping Method</h5>
      <ul>
        <li><a class="grey-text text-lighten-3" href="#!">LBC</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">JRS Express</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Lalamove</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Apcargo</a></li>
      </ul>
    </div>
    <div class="col m4 l4 s12 center">
      <h5 class="white-text">Company</h5>
      <ul>
        <li><a class="grey-text text-lighten-3" href="/about-us">About us</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Our story</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-copyright">
    <p class="">© 2020 AS Lukban</p>
  </div>
</footer>
<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/address.js"></script>
<script src="/js/animation.js"></script>
@stack('scripts')
</body>
</html>