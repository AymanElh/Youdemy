<?php

function getYoutubeEmbedUrl($url)
{
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
    $youtube_id = '';

    // Check for long YouTube URL
    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    // Check for short YouTube URL
    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    // If a video ID is found, return the embed URL
    if ($youtube_id) {
        return 'https://www.youtube.com/embed/' . $youtube_id;
    }

    // Return an empty string or error message if no valid video ID is found
    return '';
}
