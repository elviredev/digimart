'use strict'

const csrf = $('meta[name="csrf-token"]').attr('content');

let notyf = new Notyf();

$(function () {
  $('.delete-item').on('click', function (e) {
    e.preventDefault();
    let url = $(this).attr('href');

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
          url: url,
          method: 'DELETE',
          data: {
            _token: csrf,
          },
          success: function (data) {
            if (data.status === 'success') {
              window.location.reload();
            }
          },
          error: function (xhr, status, error) {
            const errorMessage = xhr.responseJSON?.message || 'An unexpected error occurred.';
            notyf.error(errorMessage);
          }
        })
      }
    });
  })
})

