<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="@if (request()->is('admin/dashboard')) nav-link @else nav-link collapsed @endif"
                href="{{ route('admin.dashboard.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="@if (request()->is('admin/product')) nav-link @else nav-link collapsed @endif"
                href="{{ route('admin.product.index') }}">
                <i class="bi bi-box"></i>
                <span>Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="@if (request()->is('admin/category')) nav-link @else nav-link collapsed @endif"
                href="{{ route('admin.category.index') }}">
                <i class="bi bi-list-check"></i>
                <span>Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="">
                <i class="bi bi-journal-text"></i><span>Transaction</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.transaction.index') }}">
                        <i class="bi bi-circle"></i><span>Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.history.index') }}">
                        <i class="bi bi-circle"></i><span>History</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.history.index') }}">
                <i class="bi bi-stars"></i>
                <span>Review</span>
            </a>
        </li>

        <li class="nav-heading">Settings</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.profile.index') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
