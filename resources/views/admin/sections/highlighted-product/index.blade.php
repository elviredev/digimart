@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
    <div class="page-body">
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ __('Highlighted Products Section') }}</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('admin.highlighted-products-section.update', 1) }}" class="x-form" method="POST">
              @csrf
              @method('PUT')

              <x-admin.input-text name="title" label="Title" :value="$highlightedProduct?->title" />
              <x-admin.input-textarea name="subtitle" label="Subtitle" :value="$highlightedProduct?->subtitle" />
              <x-admin.input-select class="item_select" multiple name="item_ids[]" :label="__('Highlighted Items')">
                @foreach($selectedProducts as $item)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @endforeach
              </x-admin.input-select>
            </form>
          </div>

          <div class="card-footer text-end">
            <x-admin.submit-button :label="__('Update')" onclick="$('.x-form').submit()" />
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    'use strict'
    $(function () {
      $(".item_select").select2({
        ajax: {
          url: "{{ route('admin.ajax.product-search') }}",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page || 1
            }
          },
          processResults: function (data, params) {
            params.page = params.page || 1

            return {
              results: data.results.map(function(item) {
                let image;
                if(item.preview_type == 'image'){
                  image = item.preview_image
                } else if(item.preview_type == 'video'){
                  image = "{{ asset('defaults/video.webp') }}"
                } else if(item.preview_type == 'audio') {
                  image = "{{ asset('defaults/audio.webp') }}"
                }

                return {
                  id: item.id,
                  text: item.name,
                  description: item.description,
                  image: image,
                  author: item.author.name
                }
              }),
              pagination: {
                more: data.pagination.more
              }
            }
          },
          cache: true
        },
        placeholder: "{{ __('Search Products') }}",
        minimumInputLength: 3,
        templateResult: formatProduct,
        templateSelection: formatProductSelection
      })

      // template pour afficher les infos du produit
      function formatProduct(product) {
        if (product.loading) {
          return product.text; // titre du produit
        }

        var $container = $(
          "<div class='select2-result-repository clearfix' style='display: flex; align-items: center; gap: 10px;'>" +
          "<div class='select2-result-repository__avatar'><img style='width: 50px; height: 50px; object-fit: cover' src='" + product.image + "' /></div>" +
          "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'></div>" +
          "<div class='select2-result-repository__author'>" +
          "</div>" +
          "</div>" +
          "</div>"
        );

        $container.find(".select2-result-repository__title").text(product.text);
        $container.find(".select2-result-repository__author").text(`Author: ${product.author}`);

        return $container;
      }

      // chaque fois qu'on clique sur un produit, on doit le sélectionner
      function formatProductSelection(product) {
        return product.text;
      }
    })
  </script>
@endpush





