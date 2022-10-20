<?php

function echoln($s)
{
    echo $s . "<br>";
}

function echoTag(string $s, string $stn)
{
    echo "<{$s}>" . $stn . "</{$s}>";
}

function echolnText(string $s): string
{
    return $s . "<br>";
}

function echoTagText(string $s, string $stn): string
{
    return "<{$s}>" . $stn . "</{$s}>";
}
