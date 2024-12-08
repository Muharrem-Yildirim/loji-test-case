<?php

function minify($html)
{
    // Remove extra whitespace
    $minifiedHtml = preg_replace('/\s+/', ' ', $html);

    // Remove comments
    $minifiedHtml = preg_replace('/<!--.*?-->/', '', $minifiedHtml);

    // Remove unnecessary spaces around tags
    $minifiedHtml = preg_replace('/>\s+</', '><', $minifiedHtml);

    $minifiedHtml .= "\n";

    return $minifiedHtml;
}
