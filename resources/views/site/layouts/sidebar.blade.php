<div class="list-post-aside sticky-top" style="top: 60px;">

    <!-- categories scoped -->
  <h3 class="module-title"><a href="#">Danh mục</a></h3>
  @if ($categories->count() > 0)
      @foreach ($categories as $category)
        <div class="news-post line-bottom list-style-post small-post">
          <div class="news-post-content">
            <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="#route"><b>{!! $category->name !!}</b></a></div>
          </div>
        </div>
      @endforeach
  @endif
</div>
    <!-- categories scoped -->

    @include('site.components.latestNews')
    <div class="row"><img src="https://file4.batdongsan.com.vn/2019/03/12/RUFz0fap/20190312163851-0eab.jpg" alt="" width="100%" height="369px" /></div>

</div>