<!-- Sidebar -->
    <nav class="bg-dark text-light p-3 flex-shrink-0" style="width:250px;">
        <div class="text-center mb-4">
            <h4>Admin Panel</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
          
            {{-- <li class="nav-item">
                <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseProducts" role="button">
                    Products
                </a>
                <div class="collapse ps-3" id="collapseProducts">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link text-light" href="#">Add Product</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="#">Manage Products</a></li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseCategories" role="button">
                    Categories
                </a>
                <div class="collapse ps-3" id="collapseCategories">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('stichedForm') }}">S&U Form</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('su_display') }}">Display </a></li>
                        {{-- <li class="nav-item"><a class="nav-link text-light" href="{{ route('homePageForm') }}">Home page</a></li> --}}
                    </ul>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link text-light" href="#">Users</a></li>
        </ul>
    </nav>
