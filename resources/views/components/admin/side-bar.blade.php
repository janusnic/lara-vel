<!-- resources/views/components/admin/side-bar.blade.php -->
<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">

    <div class="p-6">
        <a href="/admin" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> New Report
        </button>
    </div>
    
    <nav class="text-white text-base font-semibold pt-3">
        <a href="/admin" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
            <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
        </a>
        <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
                Blank Page
        </a>
        @can('category-list')
        <a href="/admin/categories" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
                Categories
        </a>
        @endcan
        @can('brand-list')
        <a href="/admin/brands" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
                Brands
        </a>
        @endcan

        @can('user-list')
        <a href="/admin/users" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-table mr-3"></i>
                Users
        </a>
        @endcan

        @can('post-list')
        <a href="/admin/posts" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
                Posts
        </a>
        @endcan
        <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tablet-alt mr-3"></i>
                Tabbed Content
        </a>
        <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-calendar mr-3"></i>
                Calendar
        </a>
    </nav>
    
</aside>
