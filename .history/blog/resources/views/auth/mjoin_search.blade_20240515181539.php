@extends('layouts.layoutback')

@section('Form')
    <!--StartFragment-->
    @if($search_all_all)
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
      @endif
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection