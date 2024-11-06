<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class FeedController extends Controller
{
    // Show the form to add a new feed
    public function create()
    {
        return view('feeds.create');
    }

    // Store the new feed in the database
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $feed = Feed::create([
            'user_id' => Auth::id(),
            'url' => $request->url
        ]);

        // Fetch and parse the feed
        $this->parseAndStoreFeedItems($feed);

        return redirect()->route('home');  // Redirect to the home/dashboard
    }

    // Parse and store the feed items
    private function parseAndStoreFeedItems(Feed $feed)
    {
        // Fetch the content of the feed
        $response = Http::get($feed->url);

        // Parse the feed content using SimpleXML
        $xml = simplexml_load_string($response->body());

        // Iterate through the feed items and save them
        foreach ($xml->channel->item as $item) {
            FeedItem::create([
                'feed_id' => $feed->id,
                'title' => (string) $item->title,
                'description' => (string) $item->description,
                'link' => (string) $item->link
            ]);
        }
    }

    // Show all the feed items for a user
    public function index()
    {
        // List of test RSS feed URLs
        $feedUrls = [
            'https://blog.laravel.com/feed',  // Laravel Blog Feed
            'https://korben.info/feed',       // Korben Info Feed
            'https://linuxfr.org/news.atom',  // LinuxFR News Feed (Atom format)
            'https://feeds.feedburner.com/d0od' // Feedburner Feed
        ];

        // Array to hold feed data
        $feeds = [];

        // Loop through each feed URL and fetch its data using the RSS2JSON API
        foreach ($feedUrls as $feedUrl) {
            // Construct the API URL for RSS2JSON
            $apiUrl = 'https://api.rss2json.com/v1/api.json?rss_url=' . urlencode($feedUrl);

            try {
                $response = Http::get($apiUrl);

                // Decode the JSON response
                $data = $response->json();

                // Add the feed data to the feeds array, along with the source URL
                $feeds[] = [
                    'source' => $feedUrl,
                    'items' => $data['items'] ?? [] // Add items to the array, or an empty array if no items
                ];
            } catch (\Exception $e) {
                
            }

            // Fetch the JSON response from the RSS2JSON API

        }

        // Pass the feeds data to the view
        return view('feeds.index', compact('feeds'));
    }
}
