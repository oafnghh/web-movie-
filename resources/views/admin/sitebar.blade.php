@php
$user = Auth::user();
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a style="color: aliceblue;" class="sidebar-brand brand-logo" href="index.html">LMH WATCH</a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle" src="https://dashboard.dienthoaivui.com.vn/uploads/wp-content/uploads/2023/01/avatar-tet15.jpg" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">ADMIN</h5>
            <span>admin web</span>
          </div>
        </div>
        <a href="" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="/profile/{{ $user->id }}" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Admin</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/logout" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Đăng xuất</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">:)</span>
    </li>
    <!-- Your menu items -->
    <!-- Please ensure that the following items are replaced with your dynamic URLs -->
    <!-- Use proper route names or dynamic data for href attributes -->
    <!-- Update the menu labels as necessary -->

    <!-- Dashboard -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="/admin/noen">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Trang chủ</span>
      </a>
    </li>

    <!-- Slider -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-slider" aria-expanded="false" aria-controls="ui-slider">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Slider</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-slider">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin/slider/add">Thêm Slider</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/slider/list">Danh sách Slider</a></li>
        </ul>
      </div>
    </li>

    <!-- Thêm Movie -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-movie" aria-expanded="false" aria-controls="ui-movie">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Thêm Movie</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-movie">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin/movie/add">Thêm Video</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/movie/list">Danh sách Video</a></li>
        </ul>
      </div>
    </li>

    <!-- Thêm Video -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-video" aria-expanded="false" aria-controls="ui-video">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Thêm Video</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-video">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin/listMovie/add">Thêm listMovie</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/listMovie/list">Danh sách listMovie</a></li>
        </ul>
      </div>
    </li>

    <!-- Thêm Thể Loại -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-genre" aria-expanded="false" aria-controls="ui-genre">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Thêm Thể Loại</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-genre">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/admin/genre/add">Thêm genre</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/genre/list">Danh sách genre</a></li>
        </ul>
      </div>
    </li>

    <!-- Thống kê -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="/admin/statistical">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Thống kê</span>
      </a>
    </li>
  </ul>
  <div style="position: relative;" class="div">
    <img style="width:150px;position: absolute;" src="/noel-main/image/noen ne.gif">
  </div>
</nav>