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

@if(!Auth::guard('admin')->guest())
    <ul class="sidenav sidenav-fixed">
 
        <div class="blue center">
            <h3 class="white-text">Admin Panel</h3>
            <a href="#name"><span class="white-text name">{{ Auth::guard('admin')->user()->name }}</span></a><br>
            <a href="#name"><span class="white-text name">Administrator</span></a>
        </div>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="/admin/dashboard"class="collapsible-header"><i class="material-icons">dashboard</i>Dashboard</a>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">local_offer</i>Catalogs<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                    <ul>
                        <li><a href="/admin/category">Categories</a></li>
                        <li><a href="/admin/products">Products</a></li>
                        <li><a href="/admin/manufacturer">Manufacturers</a></li>
                    </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">computer</i>Design<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                    <ul>
                        <li><a href="#!">Banners</a></li>
                    </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">shopping_cart</i>Sales<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                    <ul>
                        <li><a href="/admin/orders">Orders</a></li>
                        <li><a href="/admin/shipping">Shipping rate</a></li>
                    </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">groups</i>Customers<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                    <ul>
                        <li><a href="/admin/customers">Customers</a></li>
                    </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">groups</i>Employees<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                    <ul>
                        <li><a href="/admin/employees">Employees</a></li>
                        @if(Auth::guard('admin')->user()->role == 0)
                            <li><a href="/admin/new-employee">New employees</a></li>
                        @endif
                    </ul>
                    </div>
                </li>
            </ul>
        </li>
        <div class="divider"></div>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">person</i>Account<i class="material-icons right">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ url('/admin/logout') }}"onclick="event.preventDefault();document.getElementById('admin-logout-form').submit();"><i class="material-icons">login</i>Logout</a></li>
                        <form id="admin-logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
@endif

@yield('content')

<!--JavaScript at end of body for optimized loading-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/js/script.js"></script>
<script src="/js/address.js"></script>
@stack('scripts')
</body>
</html>