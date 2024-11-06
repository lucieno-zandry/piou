@extends('layouts.app')

@section('title', 'RSS Feeds')

@section('content')
<div class="container mt-4">
    <h1>Latest RSS Feeds</h1>

    @foreach ($feeds as $feed)
        <div class="card mb-3">
            <div class="card-header">
                <h4>Feeds from: <a href="{{ $feed['source'] }}" target="_blank">{{ $feed['source'] }}</a></h4>
            </div>
            <div class="card-body">
                @if (count($feed['items']) > 0)
                    <ul class="list-group">
                        @foreach ($feed['items'] as $item)
                            <li class="list-group-item">
                                <a href="{{ $item['link'] }}" target="_blank">
                                    <h5>{{ $item['title'] }}</h5>
                                </a>
                                <p>{{ $item['description'] }}</p>
                                <small>Published on: {{ \Carbon\Carbon::parse($item['pubDate'])->toFormattedDateString() }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No items found in this feed.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection