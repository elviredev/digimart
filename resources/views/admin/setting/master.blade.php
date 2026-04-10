@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">Settings</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="row g-0">
            <!-- Sidebar Partie Gauche -->
            <div class="col-12 col-md-3 border-end">
              <div class="card-body">
                <h4 class="subheader">Business settings</h4>
                <div class="list-group list-group-transparent">
                  <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">General Settings</a>
                  <a href="{{ route('admin.settings.commission.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">Author Commission Settings</a>
                  <a href="{{ route('admin.settings.logo.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">Logo Settings</a>
                </div>
                <h4 class="subheader mt-4">Experience</h4>
                <div class="list-group list-group-transparent">
                  <a href="#" class="list-group-item list-group-item-action">Give Feedback</a>
                </div>
              </div>
            </div>

            <!-- Contenu Partie Droite -->
            @yield('setting_content')
          </div>
        </div>
      </div>
    </div>
    <!-- END PAGE BODY -->

  </div>
@endsection