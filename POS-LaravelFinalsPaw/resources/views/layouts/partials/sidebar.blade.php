<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-purple elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('images/poslg.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 18px;">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->getAvatar() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->getFullname() }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{route('home')}}" class="nav-link {{ activeSegment('') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('products.index') }}" class="nav-link {{ activeSegment('products') }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Products</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('owner','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('stok.index') }}" class="nav-link {{ activeSegment('stok') }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Stock</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ activeSegment('customers') }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('suppliers.index') }}" class="nav-link {{ activeSegment('suppliers') }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Suppliers</p>
                    </a>
                </li>
                @endunless

                {{-- <li class="nav-item has-treeview">
                    <a href="{{ route('cart.index') }}" class="nav-link {{ activeSegment('cart') }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>POS System</p>
                    </a>
                </li> --}}

                @unless(auth()->user()->hasRole('gudang'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('penjualan.index') }}" class="nav-link {{ activeSegment('penjualan') }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Sale System</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('orders.index') }}" class="nav-link {{ activeSegment('orders') }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Orders</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('purchases.index') }}" class="nav-link {{ activeSegment('purchase') }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Purchase System</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('ordersuppliers.index') }}" class="nav-link {{ activeSegment('ordersuppliers') }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Purchase List</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ activeSegment('settings') }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
                @endunless

                @unless(auth()->user()->hasRole('gudang','kasir'))
                <li class="nav-item has-treeview">
                    <a href="{{ url('/register') }}" class="nav-link {{ activeSegment('regiter') }}">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>Add Users</p>
                    </a>
                </li>
                @endunless

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
