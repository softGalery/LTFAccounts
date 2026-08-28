<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Dashboard | adminHMD</title>
    @include('admin.components.css')
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>
      @include('admin.components.sidebar')
    <div class="admin-main">
        @include('admin.components.nav')
        @yield('content')

      @include('admin.components.footer')
    </div>
  </div>

@include('admin.components.js')
</body>
</html>
