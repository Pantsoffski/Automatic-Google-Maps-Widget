<?php

function pp_get_latitude_and_longitude() {
	$address = "India+Panchkula";
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	echo $lat = $response_a->results[0]->geometry->location->lat;
	echo "<br />";
	echo $long = $response_a->results[0]->geometry->location->lng;
}

function pp_show_google_map(){
	?>
	
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(44.5403, -78.5463),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div id="map-canvas"></div>
    
	<?php
}

/*class wikiLeechMedal {
	private $data2;
	private $start;
	private $end;
	
	public function __construct($url) {
		$data = file_get_contents($url);
		$data = strip_tags($data, '<ul>, <li>'); //wywala ca³y html
		$this->data2 = trim(preg_replace('/\s+/', ' ', $data)); //usuwa wszystkie, niepotrzebne przerwy, entery itp.
	}
	
	public function showWikiMedal($start, $end) {
		$data = $this->data2;
		$matches = array();
    	$pattern = "/$start(.*?)$end/";
    	if (preg_match($pattern, $data, $matches)) {
			echo "<div class=\"wikimedal\">" . $matches[1] . "</div>";
		}
	}
}*/