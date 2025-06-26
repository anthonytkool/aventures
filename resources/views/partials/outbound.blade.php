<h2 class="text-center my-4 fw-bold">Outbound Tours</h2>

@if (!empty($outboundTours) && count($outboundTours) > 0)
  <div id="outboundCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @foreach (array_chunk($outboundTours, 3) as $groupIndex => $group)
        <div class="carousel-item {{ $groupIndex === 0 ? 'active' : '' }}">
          <div class="row">
            @foreach ($group as $tour)
              <div class="col-md-4">
                @include('partials.outbound-card', [
                  'title' => $tour['title'],
                  'desc' => $tour['desc'],
                  'image' => $tour['image'],
                  'pdf' => $tour['pdf'],
                ])
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#outboundCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#outboundCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
@else
  <p class="text-center text-muted">No outbound tours available at the moment.</p>
@endif
