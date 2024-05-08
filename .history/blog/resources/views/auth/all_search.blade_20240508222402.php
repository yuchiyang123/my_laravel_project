@extends('layouts.layoutback')

@section('Form')
    <!--StartFragment-->
    @if($search_all_all)
    <h1 class="mb-4">{{ $search }}</h1>
    <div class="container mt-5">
        <div class="row">
          <div class="col">
            <ul class="list-group">
              <!-- Replace the following li items with your search results -->
              @forEach($search_all_all as $search_all)
              <li class="list-group-item">
                @php
                    $text = Str::limit(strip_tags($mjoin->description), 150);
                @endphp
                <h3>@if($search_all->shop_name){{ $search_all->shop_name }}@else{{ $search_all->title }}@endif</h3>
                <p>@if($search_all->description){!! $text !!}@else{!! $search_all->shop_information !!}@endif</p>
              </li>
              <br>
              
              @endforeach
              <!-- End of search results -->
            </ul>
          </div>
        </div>
      </div>
      @endif
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection