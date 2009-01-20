<?php

require_once 'UnitTestCommon.php';

class Services_Facebook_BatchTest extends Services_Facebook_UnitTestCommon
{

    public function testRun()
    {
        $response = <<<XML
<?xml version="1.0" encoding="UTF-8"?> <batch_run_response xmlns="http://api.facebook.com/1.0/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd" list="true"> <batch_run_response_elt>&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt; &lt;friends_get_response xmlns=&quot;http://api.facebook.com/1.0/&quot; xmlns:xsi=&quot;http://www.w3.org/2001/XMLSchema-instance&quot; xsi:schemaLocation=&quot;http://api.facebook.com/1.0/ http://api.facebook.com/1.0/facebook.xsd&quot; list=&quot;true&quot;&gt; &lt;uid&gt;1160&lt;/uid&gt; &lt;/friends_get_response&gt; </batch_run_response_elt> </batch_run_response>
XML;

        $this->mockSendRequest($response);
    }

}

?>