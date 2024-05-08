@extends('layouts.layoutback')

@section('Form')
    <!--StartFragment-->
    <div class="container mt-5">
        <h1 class="mb-4">Search Results</h1>
        <!-- Each row contains multiple cards -->
        <!-- Replace the following card items with your search results -->
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Article 1</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Article 2</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Article 3</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
              </div>
            </div>
          </div>
          <!-- Add more cards as needed -->
        </div>
        <!-- End of search results -->
      </div>
      <!-- Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection