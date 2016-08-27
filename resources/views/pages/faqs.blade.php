@extends('layouts.main')

@section('heading')


@stop


@section('pagetitle')

    F.A.Q.

@stop


@section('content')

    @if($page)
        {!! $page->htmlcode !!}
    @endif

    <div class="container">

        <div class="panel-group panel-faqs" id="accordion">

            @foreach ($faqs as $faq)

                <div class="panel panel-default text-left">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $faq->positionnumber }}">{{ $faq->positionnumber }}. {{ $faq->question }}</a>
                        </h4>
                    </div>
                @if($faq->positionnumber == 1)
                    <div class="panel-collapse collapse in" id="collapse{{ $faq->positionnumber }}">
                @else
                    <div class="panel-collapse collapse" id="collapse{{ $faq->positionnumber }}">
                @endif
                        <div class="panel-body">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                    </div>
                        @endforeach

                </div>

        </div>

@stop


@section('footer')



@stop