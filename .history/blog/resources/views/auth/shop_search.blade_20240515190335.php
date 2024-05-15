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
      <h3 style="text-align: center;" class="display-6">結果</h3>
      @if($search_all_all->isNotEmpty())
      <div class="container mt-5">
          <div class="row">
            <div class="col">
              <ul class="list-group">
                <!-- Replace the following li items with your search results -->
                @foreach($search_all_all as $search_all)
                <li class="list-group-item" style="width: 750px">
                  @php
                      $text = Str::limit(strip_tags($search_all->description), 150);
                      $text1 = Str::limit(strip_tags($search_all->shop_information), 150);
                  @endphp
                  
                  <h3>
                      @if($search_all->shop_name)
                          <a href="/shop_solo/{{ $search_all->id }}">{{ $search_all->shop_name }}</a>
                      @else
                          <a href="/mjoin_solo/{{ $search_all->id }}">{{ $search_all->title }}</a>
                      @endif
                  </h3>
                  <p>
                      @if($search_all->description)
                          {!! $text !!}
                      @else
                          {!! $text1 !!}
                      @endif
                  </p>
                </li>
                <br>
                @endforeach
                <!-- End of search results -->
              </ul>
            </div>
          </div>
      </div>
      @else
      <div class="no-results text-center">
          <img src="https://via.placeholder.com/200" alt="No Results">
          <h1 class="display-4">無結果</h1>
          <p class="lead">抱歉，沒有搜尋到結果。請換一個關鍵字再試一次。</p>
          <a href="/" class="btn btn-primary">回前頁</a>
      </div>
      @endif
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  @endsection
  