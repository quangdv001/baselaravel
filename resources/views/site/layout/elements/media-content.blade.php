<section class="session-media-header margin-topless-15 ">
    <div class="container-fluid">
        <div class="row align-items-center">
            @if (isset($image))
                <div class="col block-media">
                    <div class="row">
                        <img src="{{ $image }}" class="img-fluid" alt="Responsive image">
                    </div>
                </div>                
            @endif
            <div class="col block-content {{ isset($image) ? '' : 'text-center'}}">
                @if (isset($title))
                    <h2 class="title">
                        {!! $title !!}
                    </h2>
                @endif
                @if (isset($content))
                    {!! $content !!}
                @endif
            </div>
        </div>
    </div> <!-- container-fluid -->
    
</section>
<style>
    .session-media-header {
        background: #0e3554;        
    }
    .session-media-header.margin-topless-15 {
        margin-top: -15px !important;
    }
    .session-media-header .block-media {
        margin-bottom: 0;
    }
    .session-media-header .block-media img{
        width: 100%;
    }
    .session-media-header .block-content {
        padding: 30px 15px;
        text-align: left;
        color: #fff;
    }
    .session-media-header .block-content * {
        color: #fff;
    }
</style>