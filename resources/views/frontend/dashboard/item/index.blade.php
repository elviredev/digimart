@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>My Items</h5>
        <p>Manage your items.</p>
      </div>
      <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          {{ __('Add Item') }}
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th class="sn">
            serial
          </th>
          <th class="details">
            details
          </th>
          <th class="p_date">
            Purchase Date
          </th>
          <th class="e_date">
            Expired Date
          </th>
          <th class="price">
            Price
          </th>
          <th class="action">
            action
          </th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="sn">
            <p>1</p>
          </td>
          <td class="details">
            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
          </td>
          <td class="p_date">
            <p>2021-12-28</p>
          </td>
          <td class="e_date">
            <p>2021-12-28</p>
          </td>
          <td class="price">
            <p>$300</p>
          </td>
          <td class="action">
            <a class="view" href="#"><i class="ti ti-eye"></i></a>
          </td>
        </tr>
        <tr>
          <td class="sn">
            <p>2</p>
          </td>
          <td class="details">
            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
          </td>
          <td class="p_date">
            <p>2021-12-28</p>
          </td>
          <td class="e_date">
            <p>2021-12-28</p>
          </td>
          <td class="price">
            <p>$300</p>
          </td>
          <td class="action">
            <a class="view" href="#"><i class="ti ti-eye"></i></a>
          </td>
        </tr>
        <tr>
          <td class="sn">
            <p>3</p>
          </td>
          <td class="details">
            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
          </td>
          <td class="p_date">
            <p>2021-12-28</p>
          </td>
          <td class="e_date">
            <p>2021-12-28</p>
          </td>
          <td class="price">
            <p>$300</p>
          </td>
          <td class="action">
            <a class="view" href="#"><i class="ti ti-eye"></i></a>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <form action="{{ route('user.items.create') }}" method="GET">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Select Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <x-frontend.input-select name="category" :label="__('Category')" :required="true" >
              @foreach($categories as $category)
                <option value="{{ $category->slug }}">{{ $category->name }}</option>
              @endforeach
            </x-frontend.input-select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-main btn-md">Next</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

