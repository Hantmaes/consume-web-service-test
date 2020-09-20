{{ Request::header('Content-Type : application/xml') }}

<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" version="2.0">
{{-- <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"> --}}
<channel>

<title>{{ config('app.name') }}</title>
<description>RSS Feed</description>
<link>{{ url('/') }}</link>

@foreach ($posts as $post)

    @php
    $post->ares_ulice_fin = str_replace("&", "&amp;", $post->ares_ulice_fin);
    $post->description = str_replace("&rdquo;", "”", $post->description);
    // $post->description = str_replace("&ldquo;", "“", $post->description);

    $post->ares_ulice_fin = stripslashes($post->ares_ulice_fin);
    $post->description = stripslashes($post->description);
    $post->slug = stripslashes($post->slug);

    if ($post->image !='') {
        $img = "<img src='".url($post->image)."' alt='".$post->title."' width='600'>";
    } else {
        $img = null;
    }
    @endphp

    <item>
        <title>{{ $post->ares_ulice_fin }}</title>
        <description><![CDATA[{!! $img !!} {!! $post->description !!}]]></description>
        <pubDate>{{ date('Y/m/d', strtotime($post->updated_at)) }} GMT</pubDate>
        <link>{{ url($post->slug) }}</link>
        <guid>{{ url($post->slug) }}</guid>
        <atom:link href="{{ url($post->slug) }}" rel="self" type="application/rss+xml"/>
    </item>

@endforeach

</channel>
</rss>