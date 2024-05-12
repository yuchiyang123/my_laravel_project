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
                <h3>{{ $search_all->title }}</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </li>
              <br>
              <li class="list-group-item">
                <h3>Article 2</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </li>
              <li class="list-group-item">
                <h3>Article 3</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </li>
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