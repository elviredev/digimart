@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Wipe Database') }}</h3>
          </div>

          <div class="card-body">
            <div class="alert alert-danger" role="alert">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="alert-heading">{{ __('Warning !') }}</h4>
                  <p>
                    {{ __('Are you sure you want to wipe the database? This action cannot be undone.') }}
                  </p>
                </div>
                <div>
                  <form action="" method="POST" class="wipe-database-form">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger wipe-database-btn">{{ __('Wipe Database') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    'use strict'
    $(function() {
      $('.wipe-database-form').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({
              method: 'DELETE',
              url: "{{ route('admin.wipe-database.destroy') }}",
              data: formData,
              beforeSend: function() {
                Swal.fire({
                  title: 'Please Wait',
                  html: 'Processing your request',
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  didOpen: () => {
                    Swal.showLoading()
                  }
                })
              },
              success: function(response) {
                if (response.status == 'success') {
                  location.reload();
                }
              },
              error: function(xhr, status, error) {

              }
            })
          }
        });


      })
    })
  </script>
@endpush














