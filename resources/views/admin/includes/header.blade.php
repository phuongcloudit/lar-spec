 <!-- Left navbar links -->
 <ul class="navbar-nav">
     <li class="nav-item">
         <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
     </li>
     {{-- <li class="nav-item d-none d-sm-inline-block">
         <a href="index3.html" class="nav-link">Home</a>
     </li>
     <li class="nav-item d-none d-sm-inline-block">
         <a href="#" class="nav-link">Contact</a>
     </li> --}}
 </ul>

 <!-- SEARCH FORM -->
 {{-- <form class="form-inline ml-3">
     <div class="input-group input-group-sm">
         <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
         <div class="input-group-append">
             <button class="btn btn-navbar" type="submit">
                 <i class="fas fa-search"></i>
             </button>
         </div>
     </div>
 </form> --}}

 <!-- Right navbar links -->
 <ul class="navbar-nav ml-auto">
     <li class="nav-item dropdown">
     <a href="{{ url('/') }}" class="nav-link" data-toggle="dropdown" aria-expanded="true">
              <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="">
              <span class="hidden-xs"> 
                {{ Auth::user()->name }}
              </span>
            </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
             <a href="#" class="dropdown-item dropdown-footer">Profile</a>
             <div class="dropdown-divider"></div>
         <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>

        <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
         </div>
     </li>
     
 </ul>