--TEST--
Services_Facebook_Profile::setFBML()
--FILE--
<?php

require_once 'tests-config.php';

$fbml = <<< EOT
<fb:wide>
The PEAR module Services_Facebook is coming along nicely.
</fb:wide>
EOT;

try {
    $api = new Services_Facebook();
    $api->sessionKey = $sessionKey;
    if ($api->profile->setFBML($fbml)) {
        echo 'FBML was set successfully.';
    }
} catch (Services_Facebook_Exception $e) {
    echo $e->getLastCall() . "\n";
    echo $e->getMessage();
}

?>
--EXPECT--
FBML was set successfully.
