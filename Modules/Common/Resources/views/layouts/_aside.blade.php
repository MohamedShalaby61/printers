<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ url('storage/'. auth()->user()->avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> اونلاين</a>
            </div>
        </div>
        <!-- search form -->
       
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">القائمة الرئيسية</li>
            <li class="treeview">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>الرئيسية</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

        


            @if(auth()->user()->role_id == 1)
                        <li><a href="{{ route('super_admin') }}"><i class="fa fa-users"></i>المشرفين</a></li>
                    @endif
                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                        <li><a href="{{ route('owner_admin') }}"><i class="fa fa-print"></i>اصحاب المطابع</a></li>
                    @endif
                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                        <li><a href="{{ route('sub_owner_admin') }}"><i class="fa fa-user-o"></i>العاملين بالمطبعة</a></li>
                    @endif

                    @if(auth()->user()->role_id == 1 || (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) )
                        <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i>اضف عضو جديد</a></li>
                    @endif


            
                <li><a href="{{ route('printers.index') }}"><i class="fa fa-file"></i>المطابع</a></li>
                        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 )
                            <li><a href="{{ route('printers.create') }}"><i class="fa fa-plus"></i>اضف مطبعة جديدة</a></li>
                        @endif

            <li class="treeview">
                <a href="{{ route('orders.index') }}">
                    <i class="fa fa-file-archive-o"></i> <span>الطلبات</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>

            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                <li class="treeview">
                    <a href="{{ route('offers.index') }}">
                        <i class="fa fa-gift"></i> <span>العروض</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="{{ route('offers.create') }}">
                        <i class="fa fa-plus"></i> <span>اضف عرض</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
            @endif    
            @if(auth()->user()->role_id == 1 || (auth()->user()->role_id == 2 || auth()->user()->role_id == 3))  
                <li class="treeview">
                    <a href="{{ route('customer') }}">
                        <i class="fa fa-user"></i> <span>العملاء</span>
                        <span class="pull-right-container">
                </span>
                    </a>
                </li>
            @endif
            
            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)

                <li class="treeview">
                <a href="{{ route('configs') }}">
                    <i class="fa fa-gears"></i> <span>الاعدادات</span>
                    <span class="pull-right-container">
                </span>
                    </a>
                </li>


            @endif    

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
