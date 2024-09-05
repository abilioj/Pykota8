<?php

function echoln($s)
{
    echo $s . "<br>";
}

function echoTag($s, $stn)
{
    echo "<{$s}>" . $stn . "</{$s}>";
}

function echolnText($s): string
{
    return $s . "<br>";
}

function echoTagText($s, $stn): string
{
    return "<{$s}>" . $stn . "</{$s}>";
}
