<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title><![CDATA[{{ $meta['title'] }}]]></title>
        <link><![CDATA[{{ url($meta['link']) }}]]></link>
        <atom:link href="{{ env('APP_URL') }}/feed" rel="self" type="application/rss+xml" />
        <description><![CDATA[{{ $meta['description'] }}]]></description>
        <language>{{ $meta['language'] }}</language>
        <pubDate>{{ \Carbon\Carbon::parse($meta['updated'])->toRfc2822String() }}</pubDate>

        @foreach($items as $item)
            <item>
                <title><![CDATA[{!! $item->title !!}]]></title>
                <link>{{ url($item->link) }}</link>
                <description><![CDATA[{{ $item->summary }}]]></description>
                <author><![CDATA[{!! $item->author !!}]]></author>
                <guid>{{ url($item->id) }}</guid>
                <pubDate>{{ $item->updated->toRfc2822String() }}</pubDate>
                @foreach($item->category as $category)
                    <category>{{ $category }}</category>
                @endforeach
            </item>
        @endforeach
    </channel>
</rss>
