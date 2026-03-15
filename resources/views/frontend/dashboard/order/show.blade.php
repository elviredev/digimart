@extends('frontend.dashboard.layouts.master')

@section('content')
  <div class="wsus__dash_order_table">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h5>{{ __('License Certificate') }}</h5>
        <p>{{ __('Your items license information.') }}</p>
      </div>
      <div>
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Go Back</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td><b>{{ __('Licensors Author Name') }}</b></td>
            <td class="text-start">{{ $purchaseItem->item->author->name }}</td>
          </tr>
          <tr>
            <td><b>{{ __('Licensee') }}</b></td>
            <td class="text-start">{{ $purchaseItem->user->name }}</td>
          </tr>
          <tr>
            <td><b>{{ __('Item ID') }}</b></td>
            <td class="text-start">#{{ $purchaseItem->item->id }}</td>
          </tr>
          <tr>
            <td><b>{{ __('Item Name') }}</b></td>
            <td class="text-start">{{ $purchaseItem->item->name }}</td>
          </tr>
          <tr>
            <td><b>{{ __('Item URL') }}</b></td>
            <td class="text-start">
              <a href="{{ route('products.show', $purchaseItem->item->slug) }}">
                {{ route('products.show', $purchaseItem->item->slug) }}
              </a>
            </td>
          </tr>
          <tr>
            <td><b>{{ __('Item Purchase Code') }}</b></td>
            <td class="text-start">{{ $purchaseItem->purchase_key }}</td>
          </tr>
          <tr>
            <td><b>{{ __('Purchase Date') }}</b></td>
            <td class="text-start">{{ formatDate($purchaseItem->created_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
@endsection

