<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <!-- <a class="navbar-brand" href="{{ url('home') }}">{{config('app.name')}}</a> -->
        <a class="navbar-brand" href="{{ url('home') }}">
            <!-- <img src="{{ url('assets/images/logo_aklima.jpg') }}" width="50px;" height="35px;" alt=""> -->
            AKLIMA <small><text id="identitas-provinsi"></text></small>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ url('assets/images/avatar-1.jpg') }}" alt="" class="user-avatar-md rounded-circle"></a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name"> {{\Auth::user()->name }} </h5>
                            <span class="status"></span>
                            <span class="">Roles:</span>
                            <ul>
                                @foreach(\Auth::user()->roles as $role)
                                    <li class="">{{ $role->name }}</li>
                                @endforeach    
                            </ul>
                            
                        </div>
                        <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off mr-2"></i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>