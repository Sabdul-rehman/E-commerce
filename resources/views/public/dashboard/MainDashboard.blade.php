<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom scroll for sidebar */
        .sidebar {
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255,77,77,0.7);
            border-radius: 3px;
        }

        /* Hover and active menu */
        .menu-item:hover {
            background-color: #ff4d4d;
            color: white;
        }

        .menu-active {
            background-color: #ff4d4d;
            color: white;
        }
    </style>
</head>
<body class="flex h-screen font-sans bg-gray-100">

    <!-- Sidebar -->
    <aside class="sidebar w-64 bg-gray-900 text-gray-200 flex-shrink-0">
        <div class="p-6 text-center font-bold text-xl border-b border-gray-700">
            Admin Panel
        </div>
        <nav class="mt-6">
            <ul>
                <li class="menu-item px-6 py-3 cursor-pointer menu-active">Dashboard</li>
                <li class="menu-item px-6 py-3 cursor-pointer">
                    Orders
                    <ul class="ml-4 mt-1">
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">All Orders</li>
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Pending</li>
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Shipped</li>
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Completed</li>
                    </ul>
                </li>
                <li class="menu-item px-6 py-3 cursor-pointer">
                    Products
                    <ul class="ml-4 mt-1">
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Add Product</li>
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Manage Products</li>
                    </ul>
                </li>
                <li class="menu-item px-6 py-3 cursor-pointer">
                    Categories
                    <ul class="ml-4 mt-1">
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Stiched</li>
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Unstiched</li>
                    </ul>
                </li>
                <li class="menu-item px-6 py-3 cursor-pointer">
                    Banners
                    <ul class="ml-4 mt-1">
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Home</li>
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Shop</li>
                    </ul>
                </li>
                <li class="menu-item px-6 py-3 cursor-pointer">
                    Users
                    <ul class="ml-4 mt-1">
                        <li class="px-4 py-1 cursor-pointer hover:bg-gray-700 rounded">Customer List</li>
                    </ul>
                </li>
                <li class="menu-item px-6 py-3 cursor-pointer">Settings</li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <!-- Topbar -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
            <div class="flex items-center gap-4">
                <input type="text" placeholder="Search..." class="px-3 py-2 border rounded-md">
                <div class="bg-gray-200 px-3 py-2 rounded-md cursor-pointer">Admin</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-gray-500">Total Orders</h2>
                <p class="text-2xl font-bold text-gray-800">120</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-gray-500">Total Revenue</h2>
                <p class="text-2xl font-bold text-gray-800">Rs 250,000</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-gray-500">Products</h2>
                <p class="text-2xl font-bold text-gray-800">50</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-gray-500">Customers</h2>
                <p class="text-2xl font-bold text-gray-800">80</p>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <a href="#" class="bg-red-500 text-white py-3 px-4 rounded text-center hover:bg-red-600">Add Product</a>
            <a href="#" class="bg-red-500 text-white py-3 px-4 rounded text-center hover:bg-red-600">Upload Banner</a>
            <a href="#" class="bg-red-500 text-white py-3 px-4 rounded text-center hover:bg-red-600">View Orders</a>
        </div>

        <!-- Placeholder for charts / tables -->
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Sales Chart</h2>
            <div class="h-64 bg-gray-100 flex items-center justify-center text-gray-400">
                Chart Placeholder
            </div>
        </div>
    </main>

</body>
</html>
