@extends('layouts.layout_pages')
@section('title','Catalog')
@section('content')
<div class="pages-subtitles mt-3">
    <p>Adventure <span>List</span></p>
</div>
<div class="row">
    <div class="col-md-8">
        @foreach($wahana as $item)
        <div class="row row-items border my-2">
            <div class="col-md-12 align-self-start">
                <div class="row">
                    <div class="col-md-4 px-0">
                        @if ($item->getGambar->count() > 0)
                            @foreach($item->getGambar as $item_g)
                                @if ($loop->first)
                                <img class="d-block w-100" src="{!! asset('uploads/wahana/'.$item_g->wahanagambar_filename) !!}" alt="Third slide">
                                @endif
                            @endforeach
                        @else
                            <img class="d-block w-100" src="{!! asset('img/no-cover.jpg') !!}" alt="Third slide">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p class="lead"><a href="{!! route('front.wahana.detail',$item->urlslug) !!}">{!! $item->nama_wahana !!}</a></p>
                        <p>{{ strip_tags(str_limit($item->deskripsi_wahana, 350)) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 align-self-end">
                <div class="row">
                    <div class="col-md-4 px-0">
                        <div class="money-box">
                            @money($item->biaya_wahana, 'IDR')
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{!! route('front.wahana.detail',$item->urlslug) !!}" class="btn btn-primary btn-block">Show Detail</a> 
                            </div>
                            <div class="col-md-6">
                                <a href="tel:{!! $pengaturan[1]['value'] !!}" class="btn btn-primary btn-block">Ask Availability</a>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        @endforeach
    </div>
    <div class="col-md-4">
        <section class="block-product">
            <div class="pages-subtitles">
                <p>Latest <span>Questions</span></p>
            </div>
            <script type="text/javascript" src="https://ambrizalproject.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=1&avatar_size=40&excerpt_length=200"></script>       
        </section>
    </div>
</div>
@endsection