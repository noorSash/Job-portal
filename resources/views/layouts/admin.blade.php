<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('assets/styles/style.css')}}" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
               @auth('admin')
                <ul class="navbar-nav side-nav">
                
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('admins.dashboard')}}"style="margin-left: 20px;">Home
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view.admins')}}"style="margin-left: 20px;">Admins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('display.categories')}}"style="margin-left: 20px;">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('display.jobs')}}"style="margin-left: 20px;">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('display.apps')}}"style="margin-left: 20px;">Applications</a>
                    </li>
                </ul>
                @endauth
              
                <ul class="navbar-nav ml-md-auto d-md-flex">
                @auth('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admins.dashboard')}}">Home
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::guard('admin')->user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                          </form>


                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('view.login')}}">Login
                        <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @endauth


                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>
<script type="text/javascript">

</script>
</body>
</html>

