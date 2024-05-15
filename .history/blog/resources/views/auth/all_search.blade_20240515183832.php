<style>
  body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
  }
  .no-results {
      text-align: center;
  }
  .no-results img {
      width: 200px;
      height: auto;
      margin-bottom: 20px;
  }
</style>
@extends('layouts.layoutback')

@section('Form')
    <!--StartFragment-->
    @if($search_all_all->isEmpty())
    <h3 class="mb-4">搜尋結果:{{ $search }}</h3>
    <div class="container mt-5">
        <div class="row">
          <div class="col">
            <ul class="list-group">
              <!-- Replace the following li items with your search results -->
              @forEach($search_all_all as $search_all)
              <li class="list-group-item" style="width: 750px">
                @php
                    $text = Str::limit(strip_tags($search_all->description), 150);
                    $text1 = Str::limit(strip_tags($search_all->shop_information), 150);
                @endphp
                
                <h3>@if($search_all->shop_name)
                    <a href="/shop_solo/{{ $search_all->id }}">{{ $search_all->shop_name }}</a>
                    @else
                    <a href="/mjoin_solo/{{ $search_all->id }}">{{ $search_all->title }}</a>
                        @endif
                    </h3>
                <p>@if($search_all->description){!! $text !!}@else{!! $text1 !!}@endif</p>
              </li>
              <br>
              
              @endforeach
              <!-- End of search results -->
            </ul>
          </div>
        </div>
      </div>
      @else
        <div class="no-results">
          <img src="https://via.placeholder.com/200" alt="No Results">
          <h1 class="display-4">No Results Found</h1>
          <p class="lead">Sorry, but we couldn't find any results for your search.</p>
          <a href="/" class="btn btn-primary">Go Back to Home</a>
      </div>
      @endif
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection