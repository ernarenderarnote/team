<!DOCTYPE html>
<html>
<head>
  @include("AdminLte::common.head")
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- include top nav from common file -->
    @include('AdminLte::common.header')
    <!-- include left nav from common file -->
    @include('AdminLte::common.left-sidebar')
    <!-- Content Wrapper. page contents -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    @include("AdminLte::common.footer")
  </div>
  @include('AdminLte::common.script')
</body>
</html>
