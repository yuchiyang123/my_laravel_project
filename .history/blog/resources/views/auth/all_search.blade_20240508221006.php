@extends('layouts.layoutback')

@section('Form')
    <!--StartFragment-->
    <div class="container mt-5">
        <h1 class="mb-4">Search Results</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
          <!-- Replace the following card items with your search results -->
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Article 1</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Article 2</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Article 3</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </div>
            </div>
          </div>
          <!-- End of search results -->
        </div>
      </div>
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection