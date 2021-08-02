<?php

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return bool
 */
function contains($haystack, $needle)
{
    return strpos($haystack,  $needle) !== false;
}
