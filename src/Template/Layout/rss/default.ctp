<?php
//radeff added rss4

if (!isset($documentData)) {
    $documentData = [];
}
if (!isset($channelData)) {
    $channelData = [];
}
if (!isset($channelData['title'])) {
    $channelData['title'] = $this->fetch('title');
}
$channel = $this->Rss->channel([], $channelData, $this->fetch('content'));
echo $this->Rss->document($documentData, $channel);
/*
//old default
if (!isset($channel)):
    $channel = array();
endif;
if (!isset($channel['title'])):
    $channel['title'] = $this->fetch('title');
endif;

echo $this->Rss->document(
    $this->Rss->channel(
        array(), $channel, $this->fetch('content')
    )
);
*/

?>
