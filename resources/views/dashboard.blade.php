<x-app-layout>
<div class="d-flex" style="min-height:100vh;">

    <!-- Sidebar -->
    <nav class="bg-dark text-light p-3 flex-shrink-0" style="width:250px;">
        <div class="text-center mb-4">
            <h4>Admin Panel</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-light" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseOrders" role="button">
                    Orders
                </a>
                <div class="collapse ps-3" id="collapseOrders">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link text-light" href="#">All Orders</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="#">Pending</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="#">Shipped</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="#">Completed</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseProducts" role="button">
                    Products
                </a>
                <div class="collapse ps-3" id="collapseProducts">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link text-light" href="#">Add Product</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="#">Manage Products</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" data-bs-toggle="collapse" href="#collapseCategories" role="button">
                    Categories
                </a>
                <div class="collapse ps-3" id="collapseCategories">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('stichedForm') }}">Stitched&Unstitched</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="{{ route('homePageForm') }}">Home page</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link text-light" href="#">Banners</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link text-light" href="#">Settings</a></li>
        </ul>
    </nav>


    
    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light">
        <!-- Header + Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard</h2>
            <input type="text" class="form-control w-auto" placeholder="Search...">
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Orders</h6>
                        <h3>120</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Revenue</h6>
                        <h3>Rs 250,000</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Products</h6>
                        <h3>50</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Customers</h6>
                        <h3>80</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="mb-4">
            <a href="#" class="btn btn-danger me-2">Add Product</a>
            <a href="#" class="btn btn-danger me-2">Upload Banner</a>
            <a href="#" class="btn btn-danger">View Orders</a>
        </div>

        <!-- Recent Orders Table -->
        <div class="card">
            <div class="card-header">
                Recent Orders
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>Customer 1</td>
                            <td>Rs 2500</td>
                            <td class="text-success">Completed</td>
                            <td>2026-02-07</td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>Customer 2</td>
                            <td>Rs 3000</td>
                            <td class="text-warning">Pending</td>
                            <td>2026-02-06</td>
                        </tr>
                        <tr>
                            <td>#1003</td>
                            <td>Customer 3</td>
                            <td>Rs 1500</td>
                            <td class="text-danger">Cancelled</td>
                            <td>2026-02-05</td>
                        </tr>
                        <tr>
                            <td>#1004</td>
                            <td>Customer 4</td>
                            <td>Rs 4000</td>
                            <td class="text-success">Completed</td>
                            <td>2026-02-04</td>
                        </tr>
                        <tr>
                            <td>#1005</td>
                            <td>Customer 5</td>
                            <td>Rs 3500</td>
                            <td class="text-info">Processing</td>
                            <td>2026-02-03</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
