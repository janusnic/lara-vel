<!-- resources/views/components/admin/sidebar/index.blade.php -->

<aside class="relative bg-sidebar h-full w-64 sm:block shadow-xl">

    <x-admin.sidebar.header></x-admin.sidebar.header>
    
    <nav class="text-white text-base font-semibold pt-3">
        <x-admin.sidebar.item url="/admin" fa_type="tachometer-alt" active=true>Dashboard</x-admin.sidebar.item>
        <x-admin.sidebar.item url="/admin/products" fa_type="sticky-note">Products</x-admin.sidebar.item>
        <x-admin.sidebar.item url="/admin/brands" fa_type="table">Brands</x-admin.sidebar.item>
        <x-admin.sidebar.item url="/admin/categories" fa_type="table">Categories</x-admin.sidebar.item>

        <x-admin.sidebar.item url="/blank" fa_type="sticky-note">Blank Page</x-admin.sidebar.item>
        <x-admin.sidebar.item url="/blank" fa_type="sticky-note">Blank Page</x-admin.sidebar.item>
        <x-admin.sidebar.item url="/blank" fa_type="sticky-note">Blank Page</x-admin.sidebar.item>
        <x-admin.sidebar.item url="/blank" fa_type="sticky-note">Blank Page</x-admin.sidebar.item>

        

        
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
