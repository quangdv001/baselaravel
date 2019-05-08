@if($item) 
    {{-- <div class="news-post line-bottom list-style-post small-post">
        <div class="news-post-content">
        <div class="post-title title">
            <i class="list-icon fas fa-circle"></i>
            <a class="news-post-link" href="/posts/{{ $item->slug}}">{{ $item->title }}</a></div>
        </div>
    </div> --}}
    <div class="news-post line-bottom small-post"><a class="news-post-image-link" href="/posts/{{ $item->slug}}">
        <figure class="image-container">
        <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $item->img }}" alt="title alt"/>
        </figure></a>
      <div class="news-post-content">
        <h3 class="post-title title"><a class="news-post-link" href="/posts/{{ $item->slug}}">{{ $item->title }}</a></h3>
        <div class="post-meta-container">
            <span class="post-meta-item"><i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}</span>
            <span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $item->admin_name_c }}</a></span>
        </div>
      </div>
    </div>
@endif

{{-- <div class="news-post line-bottom small-post"><a class="news-post-image-link" href="./single.html">
    <figure class="image-container">
      <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="./assets/images/services_02.png" alt="title alt"/>
    </figure></a>
  <div class="news-post-content">
    <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
    <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
  </div>
</div> --}}