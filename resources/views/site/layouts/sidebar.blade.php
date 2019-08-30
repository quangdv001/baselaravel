<div class="list-post-aside sticky-top" style="top: 60px;">

  <!-- categories scoped -->
@if (isset($categoryChild) && count($categoryChild) > 0)
<h3 class="module-title"><a href="#">Danh mục</a></h3>
    @foreach ($categoryChild as $category)
      <div class="news-post line-bottom list-style-post small-post">
        <div class="news-post-content">
          <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="{{ route('site.home.category', ['slug' => $category['slug']]) }}"><b>{{ $category['name'] }}</b></a></div>
        </div>
      </div>
    @endforeach
@endif
</div>
  <!-- categories scoped -->

  @include('site.components.latestNews')
  @if (isset($verticalAdvertise) && count($verticalAdvertise) > 0)
    @foreach ($verticalAdvertise as $advertise)
      <div class="row"><a href="@if (isset($advertise['url'])){{ $advertise['url'] }} @else # @endif" target="_blank"><img src="{{ $advertise['img'] }}" alt="" width="100%" height="auto" /></a></div>
    @endforeach
  @endif
</div>