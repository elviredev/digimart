@extends('frontend.dashboard.layouts.master')
@push('styles')
  <!-- Dropzone CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
  <!-- Include Bootstrap Icons -->
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css">

  <style>
    .dz-message {
      padding: 20px;
      border: 2px dashed #6c757d;
      border-radius: 8px;
      background-color: #f8f9fa;
      transition: background-color 0.3s ease;
    }
    .dz-message:hover {
      background-color: #e9ecef;
    }
    .dz-message .bi-plus-circle {
      animation: bounce 2s infinite ease-in-out;
    }
    .dz-message .add-file-icon {
      font-size: 2rem;
      font-weight: bolder;
    }
    .dz-message .add-file-text {
      font-size: 1.5rem;
    }
    .file-text-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .file-list-item {
      background-color: #f8f9fa;
    }
    .dropzone {
      min-height: 150px;
      border: none;
      background: none;
      padding: 0;
    }
  </style>
@endpush

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('Update Item') }}</h5>
        <p>{{ __('Manage your item.') }}</p>
      </div>
      <div>
        <a href="{{ route('user.items.index') }}" class="btn btn-dark">
          {{ __('Back') }}
        </a>
      </div>
    </div>
  </div>

  <!-- Formulaire -->
  <form action="" method="POST" enctype="multipart/form-data" id="product_form">
    @csrf

    <ul class="nav nav-pills mt-4">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('user.items.edit', $item->id) }}">
          Edit Details
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.items.changelog', $item->id) }}">Changelogs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.items.history', $item->id) }}">History</a>
      </li>
    </ul>

    <div class="row">
      <div class="col-md-7">
        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6>{{ __('Name and Description') }}</h6>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <x-frontend.input-text name="name" :label="__('Name')" :required="true" :value="$item->name" />
            </div>

            <div class="col-md-12">
              <x-frontend.text-area name="description" id="editor" :label="__('Description')" :required="true" :value="$item->description" />
            </div>
          </div>
        </div>

        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6>{{ __('Category and Attributes') }}</h6>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <x-frontend.input-text name="category" :label="__('Category')" :value="$item->category->name" disabled />
            </div>
            <div class="col-md-12">
              <x-frontend.input-text name="sub_category" :label="__('Sub Category')" :value="$item->subCategory->name" disabled />
            </div>
            <div class="col-md-12">
              <x-frontend.input-text name="version" :label="__('Version')" :value="$item->version" />
            </div>
            <div class="col-md-12">
              <x-frontend.input-text name="demo_link" :label="__('Demo Link (Optional)')" :value="$item->demo_link" />
            </div>

            <div class="col-md-12">
              <label for="" class="form-label mb-2 font-18 font-heading fw-600">
                {{ __('Tags') }} <span class="text-danger">*</span>
              </label>
              <br>
              <input type="text" name="tags[]" value="{{ implode(',', $item->tags) }}" data-role="tagsinput" />
            </div>
          </div>
        </div>

        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6>{{ __('Files') }}</h6>
          </div>
          <hr>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="dropzone" id="fileUpload">
                <div class="dz-message text-center">
                  <div class="mb-2 file-text-wrapper">
                    <i class="bi bi-plus add-file-icon"></i>
                    <span class="add-file-text">File Upload</span>
                  </div>
                  <p class="text-muted mt-2">Drop files here or click to upload</p>
                </div>
              </div>

              <ul class="list-group" id="fileList">
                <!-- Uploaded files -->
                @foreach ($uploadedItems as $uploadedItem)
                  <li
                  class="list-group-item file-list-item d-flex align-items-center justify-content-between"
                  id="file-{{ $uploadedItem->id }}"
                  >
                    <div class="w-100">
                      <div class="d-flex align-items-center">
                        <i class="bi {{ getIcon($uploadedItem->mime_type) }} fs-3 me-3 text-primary"></i>
                        <span>
                      {{ $uploadedItem->name }}
                      <span class="file-size">({{ formatSize($uploadedItem->size) }})</span>
                    </span>
                      </div>
                      <div class="progress me-3" style="width:100%; height: 5px;">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                        style="width: 100%;" id=""></div>
                      </div>
                    </div>
                    <button
                    type="button"
                    class="btn btn-danger btn-sm justify-content-end ms-3"
                    onclick="removeFile('{{ $uploadedItem->id }}')"
                    >
                      <i class="bi bi-trash3"></i>
                    </button>
                  </li>
                @endforeach
              </ul>
            </div>

            <div class="col-md-12">
              <x-frontend.input-select name="preview_type" :label="__('Preview Type')" >
                <option value="image">{{ __('Image') }}</option>
                <option value="video">{{ __('Video') }}</option>
                <option value="audio">{{ __('Audio') }}</option>
              </x-frontend.input-select>
            </div>

            <div class="col-md-12">
              <x-frontend.input-select name="preview_file" :label="__('Preview File')" id="preview_file_input" >
                @foreach ($uploadedItems as $uploadedItem)
                  <option value="{{ $uploadedItem->path }}">{{ $uploadedItem->name }}</option>
                @endforeach
              </x-frontend.input-select>
            </div>

            <div class="col-md-12">
              <label for="" class="form-label mb-2 font-18 font-heading fw-600">
                {{ __('Main File') }}
              </label>
              <div class="input-group mb-3">
                <select id="main_source_selector" class="form-select" name="source_type">
                  <option value="">{{ __('Select') }}</option>
                  <option value="upload">{{ __('Upload') }}</option>
                  <option value="link">{{ __('Link') }}</option>
                </select>
                <select id="upload_source" class="form-select" name="upload_source">
                  <option value="">{{ __('Select') }}</option>
                  @foreach ($uploadedItems as $uploadedItem)
                    <option value="{{ $uploadedItem->path }}">{{ $uploadedItem->name }}</option>
                  @endforeach
                </select>
                <input type="text" class="form-control d-none" id="link_source" name="link_source" aria-label="Text input with dropdown button">
              </div>
            </div>

            <div class="col-md-12">
              <x-frontend.input-select class="select_2" name="screenshots[]" :label="__('Screenshots')" multiple="multiple" id="screenshots_input">
                @foreach ($uploadedItems as $uploadedItem)
                  <option value="{{ $uploadedItem->path }}">{{ $uploadedItem->name }}</option>
                @endforeach
              </x-frontend.input-select>
            </div>

          </div>
        </div>

        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6>{{ __('Support') }}</h6>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <x-frontend.input-select id="support_input" name="support" :label="__('Item will be supported?')" :required="true" >
                <option @selected($item->is_supported == 1) value="1">{{ __('Yes') }}</option>
                <option @selected($item->is_supported == 0) value="0">{{ __('No') }}</option>
              </x-frontend.input-select>
            </div>

            <div class="col-md-12 d-none" id="support_instructions" >
              <x-frontend.text-area name="support_instructions" :label="__('Support Instructions')" />
            </div>
          </div>
        </div>

        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6>{{ __('Pricing') }}</h6>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-6">
              <x-frontend.input-text name="price" :label="__('Regular Price')" :value="$item->price" :required="true" />
            </div>
            <div class="col-md-6">
              <x-frontend.input-text name="discount_price" :label="__('Discount Price')" :value="$item->discount_price" />
            </div>
          </div>
        </div>

        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6>{{ __('Free item') }}</h6>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div>
                <p class="text-muted">{{ __('You can allow downloading the item free, please note that everyone can download the item directly from the item page without purchasing.') }}</p>
              </div>
              <x-frontend.input-select id="is_free" name="is_free" :label="__('Is item will be free?')" :required="true" >
                <option @selected($item->is_free == 0) value="0">{{ __('No') }}</option>
                <option @selected($item->is_free == 1) value="1">{{ __('Yes') }}</option>
              </x-frontend.input-select>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">
        <div class="wsus__dash_order_table mt-3">
          <div>
            <h6></h6>
          </div>

          <div class="row">
            <div class="col-6">
              <b>{{ __('ID') }}</b>
            </div>

            <div class="col-6 text-end">
              <span>#{{ $item->id }}</span>
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Name') }}</b>
            </div>

            <div class="col-6 text-end">
              <span>{{ $item->name }}</span>
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Category') }}</b>
            </div>

            <div class="col-6 text-end">
              <span>{{ $item->category->name }} / {{ $item->subCategory->name }}</span>
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Status') }}</b>
            </div>

            <div class="col-6 text-end">
              @if ($item->status == 'approved')
                <span class="badge bg-success">{{ __('Approved') }}</span>
              @elseif ($item->status == 'pending')
                <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
              @elseif ($item->status == 'soft_reject')
                <span class="badge bg-secondary">{{ __('Soft Reject') }}</span>
              @elseif ($item->status == 'hard_reject')
                <span class="badge bg-secondary">{{ __('Hard Reject') }}</span>
              @elseif ($item->status == 'resubmitted')
                <span class="badge bg-primary">{{ __('Resubmitted') }}</span>
              @endif
            </div>
            <hr class="mt-2">

            <div class="col-6">
              <b>{{ __('Publish date') }}</b>
            </div>

            <div class="col-6 text-end mb-4">
              <span>{{ formatDate($item->created_at) }}</span>
            </div>


            <div class="col-12">
              <a href="{{ route('user.items.download', $item->id) }}" class="btn btn-sm btn-primary w-100">{{ __('Download') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="wsus__dash_order_table mt-3">
      <div class="row">
        <div class="col-md-12" >
          <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('scripts')
  <!-- Dropzone JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

  <script>
    var notyf = new Notyf({
      duration: 5000
    })

    const csrfToken = "{{ csrf_token() }}";
    // Initialize Dropzone
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#fileUpload", {
      url: "{{ route('user.items.uploads') }}", // Server endpoint
      maxFilesize: 100, // Max file size in MB
      parallelUploads: 5, // Number of files to upload in parallel
      uploadMultiple: true,
      addRemoveLinks: false, // Disable default Dropzone remove links
      previewsContainer: false, // Hide default Dropzone previews
      clickable: "#fileUpload", // Makes the #fileUpload div clickable
      headers: {
        "X-CSRF-TOKEN": csrfToken // Pass CSRF token in headers
      },
      init: function() {
        this.on("addedfile", function(file) {
          // create list item
          createListItem(file);
        });
        this.on("uploadprogress", function(file, progress) {
          // Update progress bar
          const progressBar = document.getElementById(`progress-${file.upload.uuid}`);
          if (progressBar) {
            progressBar.style.width = `${progress}%`;
          }
        });
        this.on("success", function(file, response) {
          const listItem = document.getElementById(`file-${file.upload.uuid}`);
          if (listItem) {
            const progressBar = listItem.querySelector(".progress-bar");
            progressBar.classList.remove("progress-bar-animated");
            progressBar.classList.add("bg-success");
            progressBar.style.width = "100%";
          }

          // Set HTML items
          var fileListWrapper = document.getElementById('fileList')
          fileListWrapper.innerHTML = response.html

          // Parcourir la réponse et afficher les options
          setDynamicOptions(response)

        });
        this.on("error", function(file, errorMessage) {
          var errors = errorMessage.errors
          for (const field in errors) {
            errors[field].forEach((error) => {
              notyf.error(error)
            })
          }

          const listItem = document.getElementById(`file-${file.upload.uuid}`);
          if (listItem) {
            const progressBar = listItem.querySelector(".progress-bar");
            progressBar.classList.remove("progress-bar-animated");
            progressBar.classList.add("bg-danger");
            progressBar.style.width = "100%";
          }
        });
      },
    });

    // Insérer dynamiquement les options dans les listes déroulantes
    function setDynamicOptions(response) {
      var previewFileInput = document.getElementById('preview_file_input')
      var screenshotsInput = document.getElementById('screenshots_input')
      var uploadSourceInput = document.getElementById('upload_source')

      // Vider le contenu précédent
      previewFileInput.innerHTML = ''
      screenshotsInput.innerHTML = ''
      uploadSourceInput.innerHTML = ''

      for (let i = 0; i < response.files.length; i++) {
        // Créer element <option>
        var previewOption = document.createElement('option')
        previewOption.value = response.files[i].path
        previewOption.text = response.files[i].name
        previewFileInput.add(previewOption)

        var screenshotsOption = document.createElement('option')
        screenshotsOption.value = response.files[i].path
        screenshotsOption.text = response.files[i].name
        screenshotsInput.add(screenshotsOption)

        var uploadSourceOption = document.createElement('option')
        uploadSourceOption.value = response.files[i].path
        uploadSourceOption.text = response.files[i].name
        uploadSourceInput.add(uploadSourceOption)
      }
    }

    // Function to get file icon
    function getIcon(fileType) {
      let fileIcon = "bi-file-earmark"; // Default icon
      if (fileType.startsWith("image/")) fileIcon = "bi-file-earmark-image";
      else if (fileType.startsWith("video/")) fileIcon = "bi-file-earmark-play";
      else if (fileType.startsWith("audio/")) fileIcon = "bi-file-earmark-music";
      else if (fileType.endsWith("pdf")) fileIcon = "bi-file-earmark-pdf";
      else if (fileType.startsWith("text/")) fileIcon = "bi-file-earmark-text";
      else if (fileType.startsWith("application/")) fileIcon = "bi-file-earmark-zip";
      return fileIcon;
    }

    // create list item
    function createListItem(file) {
      // Determine file type icon
      const fileIcon = getIcon(file.type);
      // Create list item
      const listItem = document.createElement("li");
      listItem.className =
        "list-group-item file-list-item d-flex align-items-center justify-content-between";
      listItem.id = `file-${file.upload.uuid}`;
      listItem.innerHTML = `
        <div class="w-100">
          <div class="d-flex align-items-center">
            <i class="bi ${fileIcon} fs-3 me-3 text-primary"></i>
            <span>${file.name} <span class="file-size">${getFileSize(file)}</span></span>
          </div>
          <div class="progress me-3" style="width:100%; height: 5px;">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                style="width: 0;" id="progress-${file.upload.uuid}"></div>
          </div>
        </div>
        <button class="btn btn-danger btn-sm justify-content-end ms-3"
            onclick="removeFile('${file.upload.uuid}')"><i class="bi bi-trash3"></i>
        </button>
      `;
      document.getElementById("fileList").appendChild(listItem);
    }

    // get file size
    function getFileSize(file) {
      const size = file.size;
      const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(1024));
      return `(${(size / Math.pow(1024, i)).toFixed(2) * 1} ${["B", "KB", "MB", "GB", "TB"][i]})`;
    }

    // Function to remove file
    function removeFile(uuid) {
      const listItem = document.getElementById(`file-${uuid}`);
      if (listItem) {
        listItem.remove();
      }

      // suppression du fichier en bdd
      $.ajax({
        method: 'DELETE',
        url: '/user/item-destroy/:id'.replace(':id', uuid),
        data: {
          _token: csrfToken
        },
        success: function(response) {
          if (response.status == 'success') {
            notyf.success(response.message)
            setDynamicOptions(response)
          } else {
            notyf.error(response.message)
          }
        },
        error: function() {
        }
      })
    }

    // Select Main File
    document.getElementById('main_source_selector').addEventListener('change', function() {
      const value = this.value
      const uploadSource = document.getElementById('upload_source')
      const linkSource = document.getElementById('link_source')

      if (value === 'upload') {
        uploadSource.classList.remove('d-none')
        linkSource.classList.add('d-none')
      } else {
        uploadSource.classList.add('d-none')
        linkSource.classList.remove('d-none')
      }
    })

    // Gérer le textarea "Support Instructions"
    document.getElementById('support_input').addEventListener('change', function() {
      const value = this.value
      const supportInstructions = document.getElementById('support_instructions')

      if (value === '1') {
        supportInstructions.classList.remove('d-none')
      } else if (value === '0') {
        supportInstructions.classList.add('d-none')
      }
    })

    /** Submit Form */
    $('#product_form').on('submit', function(e) {
      e.preventDefault()

      //let formData = $(this).serialize()
      let formData = new FormData(this)

      // 🔑 Forcer TinyMCE
      formData.set('description', tinymce.get('editor').getContent())

      $.ajax({
        method: 'PUT',
        url: '/user/item/:id/update' .replace(':id', {{ $item->id }}),
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.status == 'success') {
            window.location.href = response.redirect
          }
        },
        error: function (xhr, status, error) {
          var errors = xhr.responseJSON.errors
          $.each(errors, function (key, value) {
            notyf.error(value[0])
          })
        }
      })

    })

  </script>
@endpush
























