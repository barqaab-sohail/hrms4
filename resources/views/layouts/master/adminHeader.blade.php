<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <!-- Logo icon --><b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon 
                    <img src="{{asset('Massetss/images/bqb-white-logo-1.png') }}" alt="homepage" class="dark-logo" />
                    -->
                    <!-- Light Logo icon -->
                    <img src="{{asset('Massets/images/bqb-white-logo-1.png') }}" alt="HRMS" class="light-logo" style="height:50px" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <h3 class="light-logo"> <img src="{{asset('Massets/images/bqb-white-logo-2.png')}}"/></h3>
                </span> 
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>



                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== 
                <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                -->
                </li>
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                
                <!-- Top Right Side User Picutre  -->
                <!-- Message -->
                 
 
                

           
 

                <!-- Notification -->
                <li class="nav-item dropdown"> 

                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark"  href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell" ></i>
                    </a>
                     <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li><a href=""  class="link" data-toggle="tooltip" title="Notification List"><i class="fa fa-tv"></i> View Notifications</a></li>
                             
 
                           
                            <li><a href=""  class="link" data-toggle="tooltip" title="Create Notification"><i class="fa fa-bell"></i> Create Notification</a></li>
                           
 
                        
                            <li><a href=""  class="link" data-toggle="tooltip" title="Send Notification to HR"><i class="fas fa-arrow-right"></i> Send Message to HR</a></li>
                           

                        </ul>
                        
                    </div>
                    
                </li>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  
                    
                    <img src="{{asset(isset(Auth::User()->employee->picture->name)? 'storage/pictures/'.Auth::User()->employee->picture->name: 'Massets/images/default.png') }}" onerror="this.src ='{{asset('Massets/images/default.png')}}';" alt="user" class="profile-pic" height="30" width="50%"/></a>
                    
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                           <!-- <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                    <img  src="" onerror="this.src ='{{asset('Massets/images/default.png')}}';" alt="user" width="30" height="80"></div>
                                    <div class="u-text">
                                        <h4><br></h4>
                                       
                                        <p class="text-muted" style="font-size:12px;"></p><a href="#" class="btn btn-rounded btn-danger btn-sm"></a>
                                    </div>
                                </div>
                            </li> -->
                            <!--
                            <li role="separator" class="divider"></li>
                            {{--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>--}}
                            {{--<li><a href="#"><i class="ti-email"></i> Inbox</a></li>--}}
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            -->
                            <li><a id="logout" href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="link" data-toggle="tooltip" title=""><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    
                        <!-- If URL Manualy then redirect to login -->
                       <!--  @if(!isset($_SERVER['HTTP_REFERER']))
                        {
                            <script>window.location.href = "{{route('login')}}";</script>
                        }
                        @endif -->
                        

                    </div>
                </li>
                
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== 
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>--}}
                {{--</li>--}}
                -->
            </ul>
        </div>
    </nav>
    
</header>