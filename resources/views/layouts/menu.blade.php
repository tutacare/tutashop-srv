<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                    <router-link to="/" tag="li"><a>Dashboard</a></router-link>
                    <router-link to="/customers" tag="li"><a>Customers</a></router-link>
                    <router-link to="/items" tag="li"><a>Items</a></router-link>
                    <router-link to="/suppliers" tag="li"><a>Suppliers</a></router-link>
                    <router-link to="/receivings" tag="li"><a>Receivings</a></router-link>
                    <router-link to="/sales" tag="li"><a>Sales</a></router-link>
            </ul>
        </div>
    </div>
</nav>