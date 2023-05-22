<?php
class Mp3S {
  private $audioCnt, $syncword;
  public function __construct($syncword) {
    $this->audioCnt = 0;
    $this->syncword = $syncword;
    header("Transfer-encoding: chunked");
    header("Content-Type: audio/mpeg");
    flush();
  }
  public function __destruct() {
    echo "0\r\n\r\n";
    flush();
  }
  public function addAudioFile($path) {
    $audio = file_get_contents($path);
    $audio = $this->skipId3($audio);
    echo sprintf("%x\r\n", strlen($audio));
    echo $audio . "\r\n";
    flush();
  }
  private function skipId3($audio) {
    $zeroCnt = 0;
    $syncOffset = 0;
    for ($i=0;$i<(strlen($audio)-strlen($this->syncword));$i++) {
      $c = $audio[$i];
      if ($zeroCnt>32 && $audio[$i]==$this->syncword[0]) {
        $word = $audio[$i];
        for ($j=1;$j<strlen($this->syncword);$j++) {
          $word .= $audio[$i+$j];
        }
        if ($word==$this->syncword) {
          $syncOffset = $i;
          break;
        }
      }
      if ($audio[$i]=="\x00") $zeroCnt++;
      else $zeroCnt = 0;
    }
    return substr($audio, $syncOffset);
  }
}

