<?php

if (!function_exists('FormatPossessive')) {
    function FormatPossessive($Word) {
        return substr($Word, -1) == 's' ? $Word."'" : $Word."'s";
    }
}

