# MP3S - Streaming MP3 Audio over HTTP

MP3S is a PHP class that allows you to stream MP3 audio files over HTTP using chunked transfer encoding. This is useful when you want to play an MP3 audio file on a web page without waiting for the entire file to download.

## How to use

To use MP3S, include the `Mp3S.php` file in your PHP script and create an instance of the `Mp3S` class with a `syncword` parameter:

```php
require_once('mp3s.php');
$mp3s = new Mp3S('SYNC');
```

The `syncword` parameter is a sequence of bytes that marks the beginning of the MP3 audio data. This is used to skip any ID3 metadata that may be present at the beginning of the file.

Once you have an instance of the `Mp3S` class, you can add MP3 audio files to the stream using the `addAudioFile` method:

```php
$mp3s->addAudioFile('path/to/file.mp3');
```

You can call the `addAudioFile` method multiple times to add more audio files to the stream. The audio files will be played one after the other.

## Example

Here's an example that demonstrates how to use the `Mp3S` class to stream multiple MP3 audio files:

```php
<?php
require_once('mp3s.php');

$mp3s = new Mp3S("\xFF\xF3\xE4");

for ($i=0;$i<10;$i++) {
    $mp3s->addAudioFile($i.'.mp3');
    sleep(1);
}

unset($mp3s);
```

## License
MP3S is released under the TTS QUEST PUBLIC LICENSE.
