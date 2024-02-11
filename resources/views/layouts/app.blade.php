<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HR System</title>

    <!-- style sheet -->
    <link href="{{asset('dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('select.css')}}" rel="stylesheet">
    <link href="{{asset('style.css')}}" rel="stylesheet">
    

    <!-- Scripts -->
    <script src="{{asset('jquery.js')}}"></script>
    <script src="{{asset('datatables.js')}}"></script>  
    <script src="{{asset('select.js')}}"></script>  
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark shadow-lg">
            <div class="container-fluid">
                <a class="navbar-brand d-flex" href="{{ route('employee-info') }}">
                    <h4 class="fw-bold text-light">
                    <i class="fa-solid fa-fade fas fa-oil-well ms-1" style="color: #ffe144"></i>
                    Oil-corp
                </h4>
            </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 19px; font-weight: 300;">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">الموظفين</a>
                            <div class="dropdown-menu text-end">
                                
                        <a href="{{ route('employee-info') }}" class="dropdown-item fw-bold d-flex"><i class="fas fa-file-lines me-auto"></i>التقارير</a>

                        <a href="{{ url('/Employee/create') }}" class="dropdown-item fw-bold d-flex"> <i class="fas fa-folder-plus me-auto"></i>إضافة</a>

                        </div>
                        </li>
                        
                    @if (in_array(auth()->user()->role_id, [1,2]))
                    
                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">المستخدمين</a>
                        <div class="dropdown-menu text-end">
                            <a href="{{ route('User-info') }}" class="dropdown-item fw-bold align-items-center d-flex"><i class="fas fa-circle-user me-auto"></i>بيانات المستخدمين </a>
                            <a href="{{ route('register') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-user-plus me-auto"></i>إضافة مستخدم جديد</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">إدارة الأقسام</a>
                        <div class="dropdown-menu text-end">
                                <a href="{{ route('DPT-info') }}" class="dropdown-item fw-bold align-items-center d-flex "> <i class="fas fa-building-user me-auto"></i>الأقسام</a>
                                <a href="{{ Route('DPT-create') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-building me-auto"></i>إضافة قسم جديد</a>
                        </div>
                    </li>

                    @endif
                    @if (in_array(auth()->user()->role_id, [1,2,3]))
                        
                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">الرواتب</a>
                        <div class="dropdown-menu text-end">

                        <a href="{{ route('Payroll-info') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-money-check me-auto"></i> التقارير</a>
                        <a href="{{ route('Payroll-reports') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-money-check-dollar me-auto"></i> سجل المعاملات</a>
                        <a href="{{ url('/Payroll/create') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-file-import me-auto"></i> إضافة</a>
                        <a href="{{ url('/Payroll/transaction') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-sack-dollar me-auto"></i> معاملة جديدة</a>
                        </div>
                        
                    </li>
                        
                        
                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">الحسابات</a>
                        <div class="dropdown-menu  text-end">
                            
                            <a href="{{ route('Account-info') }}" class="dropdown-item fw-bold align-items-center d-flex"><i class="fas fa-file-invoice me-auto"></i> التقارير</a>
                            {{-- <a href="{{ route('Account-reports') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-file-invoice-dollar me-auto"></i>سجل المعاملات</a> --}}
                            <a href="{{ url('/Account/create') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-file-circle-plus me-auto"></i> إضافة</a>
                            <a href="{{ route('Account-transaction') }}" class="dropdown-item fw-bold align-items-center d-flex"> <i class="fas fa-sack-dollar me-auto"></i>معاملة جديدة </a>
                            
                        </div>
                        
                    </li>
                        

                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">المصارف</a>
                        <div class="dropdown-menu text-end">
                            
                            <a href="{{ route('Bank-info') }}" class="dropdown-item fw-bold align-items-center d-flex"><i class="fas fa-piggy-bank me-auto"></i>  الحسابات المصرفية</a>
                            <a href="{{ route('Bank-create') }}" class="dropdown-item fw-bold align-items-center d-flex"><i class="fas fa-sack-dollar me-auto"></i> إنشاء حساب</a>
                            <a href="{{ route('Bank-transaction') }}" class="dropdown-item fw-bold align-items-center d-flex"><i class="fas fa-sack-dollar me-auto"></i> إجراء معاملة</a>
                            <a href="{{ route('Bank-reports') }}" class="dropdown-item fw-bold align-items-center d-flex"><i class="fas fa-sack-dollar me-auto"></i> سجل المعاملات</a>
                        </div>
                        
                    </li>
                    @endif

                        <li class="nav-item dropdown">
                            <a id="dropdown" href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">الإستقطاعات</a>
                        <div class="dropdown-menu text-end">
                            <a href="{{ route('Deduction-info') }}" class="dropdown-item align-items-center d-flex fw-bold"><i class="fas fa-file-invoice me-auto"></i> التقارير</a>
                            <a href="{{ route('Deduction-reports') }}" class="dropdown-item align-items-center d-flex fw-bold"><i class="fas fa-file-invoice-dollar me-auto"></i> سجل المعاملات</a>
                            <a href="{{ url('/Deduction/create') }}" class="dropdown-item align-items-center d-flex fw-bold"><i class="fas fa-file-circle-plus me-auto"></i> إضافة</a>
                            <a href="{{ url('/Deduction/transaction') }}" class="dropdown-item align-items-center d-flex fw-bold"><i class="fas fa-sack-dollar me-auto"></i> معاملة جديدة</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle fw-bold" role="button" data-bs-toggle="dropdown">البدلات</a>
                    
                        <div class="dropdown-menu text-end">
                            <a href="{{ route('Allowance-info') }}" class="dropdown-item align-items-center d-flex fw-bold"> <i class="fas fa-file-invoice me-auto"></i> التقارير</a>
                            <a href="{{ route('Allowance-reports') }}" class="dropdown-item align-items-center d-flex fw-bold"> <i class="fas fa-file-invoice-dollar me-auto"></i> سجل المعاملات</a>
                            <a href="{{ url('/Allowance/create') }}" class="dropdown-item align-items-center d-flex fw-bold"> <i class="fas fa-file-circle-plus me-auto"></i> إضافة</a>
                            <a href="{{ url('/Allowance/transaction') }}" class="dropdown-item align-items-center d-flex fw-bold"> <i class="fas fa-sack-dollar me-auto"></i> معاملة جديدة</a>
                        </div>
                    </li>
                    @endauth
                </ul>
                
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل دخول') }}</a>
                    </li>
                    @endif
                    
                    {{-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('إضافة مستخدم') }}</a>
                    </li>
                    @endif --}}
                    @else
                        <li class="nav-item dropdown me-4" style="transition-delay: 0.9s"><a href="#" class="nav-link text-white"  role="button" data-bs-toggle="dropdown"><i class="fas fa-bell"></i></a>
                    
                            <div class="dropdown-menu notification-ui_dd" id="notification" >
                                <div class="notification-ui_dd-header">
                                    <h5 class="text-center fw-bold">Notifications ({{auth()->user()->UnreadNotifications->count()}})</h5>
                                </div>
                                <div class="notification-ui_dd-content text-end">
                                  @forelse (auth()->user()->UnreadNotifications as $item)
                                      
                                  <div class="notification-list notification-list--unread">
                                        
                                    <div class="notification-list_detail">
                                            <p class="mb-2"><b class="fw-bold">{{$item->data['title']}}</b></p>
                                            <p><a href="{{route('Notification-show', $item->id)}}" class="dropdown-item">{{$item->data['name'] ?? ' '}}</a></p>
                                            <p><a href="{{route('Notification-show', $item->id)}}" class="dropdown-item">{{$item->data['detail']}}</a></p>
                                            <p class="dropdown-item">{{$item->data['user']}} تمت العملية بواسطة</p>
                                            <small style="font-size: 10px">{{$item->created_at}}</small>
                                        </div>

                                    </div>
                                        @empty
                                        <div class="notification-list_detail">
                                            <p><a href="/Employee" class="dropdown-item">لاتوجد إشعارات</a></p>
                                        </div>
                                        @endforelse
                                      
                                    </div>
                                    <div class="notification-ui_footer">
                                        <a role="button" class="btn btn-primary d-block"  href="#notification-panel" data-bs-toggle="modal">view All</a>
                                    </div>
                                    
                                </div>
                            </li>
                            <x-notifications-panel />
                            <x-toast />
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <i class="fas fa-user-tie"></i>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item d-flex align-items-center fw-bold" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-fade fas fa-power-off text-danger me-auto"></i>{{ __('تسجيل خروج') }} 
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function(){
            $('.form-select').select2();
        });
    </script>
    <footer class="container d-flex align-items-end justify-content-center" style="margin-top:auto;">
            <p class="text-dark text-center"> &copy; جميع الحقوق محفوظة نظام الموارد البشرية {{date('Y')}}</p>
    </footer>
</body>
</html>
