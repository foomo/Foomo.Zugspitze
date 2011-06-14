<?php
/* @var $report Zugspitze\Log\Vo\Report */
$report = $model;
?>
===============================================================================
REPORT: <?= date('d-m-Y H:i:s') . PHP_EOL ?>
===============================================================================
INFO
...............................................................................
Id           : <?= $report->id . PHP_EOL ?>
Level        : <?= (($report->levelName) ? $report->levelName : '-') . PHP_EOL ?>
Date         : <?= (($report->date) ? $report->date : '-') . PHP_EOL ?>
Time         : <?= (($report->time) ? $report->time : '-') . PHP_EOL ?>
Category     : <?= (($report->category) ? $report->category : '-') . PHP_EOL ?>
Location     : <?= (($report->location) ? $report->location : '-') . PHP_EOL ?>
Total Memory : <?= (($report->totalMemory) ? $report->totalMemory : '-') . PHP_EOL ?>
Screenshot   : <?= (($report->screenshot) ? $report->screenshot->file : '-') . PHP_EOL ?>


MESSAGE
...............................................................................
<?= $report->message . PHP_EOL ?>
...............................................................................
<? if ($report->capabilities): ?>


CAPABILITIES
...............................................................................
os                      : <?= $report->capabilities->os . PHP_EOL ?>
version                 : <?= $report->capabilities->version . PHP_EOL ?>
language                : <?= $report->capabilities->language . PHP_EOL ?>
playerType              : <?= $report->capabilities->playerType . PHP_EOL ?>
manufacturer            : <?= $report->capabilities->manufacturer . PHP_EOL ?>
screenDPI               : <?= $report->capabilities->screenDPI . PHP_EOL ?>
screenColor             : <?= $report->capabilities->screenColor . PHP_EOL ?>
pixelAspectRatio        : <?= $report->capabilities->pixelAspectRatio . PHP_EOL ?>
screenResolutionX       : <?= $report->capabilities->screenResolutionX . PHP_EOL ?>
screenResolutionY       : <?= $report->capabilities->screenResolutionY . PHP_EOL ?>
avHardwareDisable       : <?= (($report->capabilities->avHardwareDisable) ? 'true' : 'false') . PHP_EOL ?>
hasAccessibility        : <?= (($report->capabilities->hasAccessibility) ? 'true' : 'false') . PHP_EOL ?>
hasAudio                : <?= (($report->capabilities->hasAudio) ? 'true' : 'false') . PHP_EOL ?>
hasAudioEncoder         : <?= (($report->capabilities->hasAudioEncoder) ? 'true' : 'false') . PHP_EOL ?>
hasEmbeddedVideo        : <?= (($report->capabilities->hasEmbeddedVideo) ? 'true' : 'false') . PHP_EOL ?>
hasIME                  : <?= (($report->capabilities->hasIME) ? 'true' : 'false') . PHP_EOL ?>
hasMP3                  : <?= (($report->capabilities->hasMP3) ? 'true' : 'false') . PHP_EOL ?>
hasPrinting             : <?= (($report->capabilities->hasPrinting) ? 'true' : 'false') . PHP_EOL ?>
hasScreenBroadcast      : <?= (($report->capabilities->hasScreenBroadcast) ? 'true' : 'false') . PHP_EOL ?>
hasScreenPlayback       : <?= (($report->capabilities->hasScreenPlayback) ? 'true' : 'false') . PHP_EOL ?>
hasStreamingAudio       : <?= (($report->capabilities->hasStreamingAudio) ? 'true' : 'false') . PHP_EOL ?>
hasStreamingVideo       : <?= (($report->capabilities->hasStreamingVideo) ? 'true' : 'false') . PHP_EOL ?>
hasTLS                  : <?= (($report->capabilities->hasTLS) ? 'true' : 'false') . PHP_EOL ?>
hasVideoEncoder         : <?= (($report->capabilities->hasVideoEncoder) ? 'true' : 'false') . PHP_EOL ?>
isDebugger              : <?= (($report->capabilities->isDebugger) ? 'true' : 'false') . PHP_EOL ?>
localFileReadDisable    : <?= (($report->capabilities->localFileReadDisable) ? 'true' : 'false') . PHP_EOL ?>
maxLevelIDC             : <?= $report->capabilities->maxLevelIDC . PHP_EOL ?>
supports32BitProcesses  : <?= (($report->capabilities->supports32BitProcesses) ? 'true' : 'false') . PHP_EOL ?>
supports64BitProcesses  : <?= (($report->capabilities->supports64BitProcesses) ? 'true' : 'false') . PHP_EOL ?>
...............................................................................
<? endif; ?>
