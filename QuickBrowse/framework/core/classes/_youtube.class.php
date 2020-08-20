<?php

class YoutubeAPI{
	
	public $ERROR = '';
	public $INFO = '';
	
	private $API_KEY = '';
	private $DATA = Array();
	
	//@TODO CHANGLE FILEOPEN TO CURL
	//@TODO ADD PROPERTIES AND FORMAT REQUESTED DATA TO A MORE SIMPLE MANNER

	function __construct($API_KEY){
		
		if(isset($API_KEY)){
			$this->INFO = 'Saved $YOUTUBE->API_KEY for later reference.';
			$this->API_KEY 	= $API_KEY;
		}else{
			$this->ERROR = 'No API_KEY was given as first argument, constructing Object failed.';
			return false;
		}
		
		return true;
	}
	
	function get_key(){
		if(isset($this->API_KEY) && !empty($this->API_KEY)){
			return $this->API_KEY;
		}
		return false;
	}
	
	function return_like_rating($LIKES, $DISLIKES){
		
		$x = $LIKES;
		$y = $LIKES + $DISLIKES;
		$percent = $x/$y;
		
		$rating = number_format( $percent * 100, 2 ) . '%';
		return $rating;
	}

	function return_data($TYPE, $CONTENT_ID, $LIMIT = 5){
		switch($TYPE){
			case 'youtube':
				$this->DATA[$TYPE] = $this->get_youtube_data($CONTENT_ID);
			break;
			
			case 'video':
				$this->DATA[$TYPE] = $this->get_video_data($CONTENT_ID);
			break;
			
			case 'channel':
				$this->DATA[$TYPE] = $this->get_channel_data($CONTENT_ID, $LIMIT);
			break;
			
			case 'playlist':
				$this->DATA[$TYPE] = $this->get_playlist_data($CONTENT_ID);
			break;
			
			case 'uploads':
				$this->DATA[$TYPE] = $this->get_uploads_from_playlist_data($CONTENT_ID, $LIMIT);
			break;
			
			default:
				$this->ERROR = 'No such TYPE found with name: ' . $TYPE . ', Please use youtube, video, channel, playlist or uploads';
				return false;
			break;
		}
		return $this->DATA[$TYPE];
	}

	private function get_youtube_data($CONTENT_ID){
		//$JSON = file_get_contents();
		$JSON = $this->return_curl_request("https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" . $CONTENT_ID . "&key=" . $this->get_key());
		return json_decode($JSON, true);
	}

	private function get_channel_data($CONTENT_ID, $LIMIT){
		$DATA1 = Array();
		$DATA2 = Array();
		$DATA3 = Array();
		
		//$JSON = file_get_contents();
		$JSON = $this->return_curl_request("https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id=" . $CONTENT_ID . "&maxResults=" . $LIMIT . "&key=" . $this->get_key());
		$DATA1 = json_decode($JSON, true);
		
		//$JSON = file_get_contents();
		$JSON = $this->return_curl_request("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=" . $CONTENT_ID . "&key=" . $this->get_key());
		$DATA2 = json_decode($JSON, true);
		
		//$JSON = file_get_contents();
		$JSON = $this->return_curl_request("https://www.googleapis.com/youtube/v3/channels?part=snippet&id=" . $CONTENT_ID . "&key=" . $this->get_key());
		$DATA3 = json_decode($JSON, true);
		
		$DATA = Array(
			'channel' => Array(
				'id' => $DATA2['items'][0]['id'],
				'title' => $DATA3['items'][0]['snippet']['title'],
				'description' => $DATA3['items'][0]['snippet']['description'],
				'thumbnail' => $DATA3['items'][0]['snippet']['thumbnails']['high']
			),
			'stats' => $DATA2['items'][0]['statistics'],
			'content' => $DATA1['items'][0]['contentDetails']
		);
		
		return $DATA;
	}

	private function get_playlist_data($CONTENT_ID){
		//$JSON = file_get_contents();
		$JSON = $this->return_curl_request("https://www.googleapis.com/youtube/v3/playlists?part=snippet&id=" . $CONTENT_ID . "&key=" . $this->get_key());
		return json_decode($JSON, true);
	}

	private function get_uploads_from_playlist_data($CONTENT_ID, $LIMIT){
		//$JSON = file_get_contents();
		$JSON = $this->return_curl_request("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" . $CONTENT_ID . "&maxResults=" . $LIMIT . "&key=" . $this->get_key());
		return json_decode($JSON, true)['items'];
	}

	private function get_video_data($CONTENT_ID){
		$JSON =  $this->return_curl_request("http://www.youtube.com/oembed?url=https://www.youtube.com/watch?v=". $CONTENT_ID ."&format=json");
		return json_decode($JSON, true);
	}
	
	private function return_curl_request($json_api_link){
		$curl = curl_init($json_api_link);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		$JSON = curl_exec($curl);
		curl_close($curl);

		return $JSON;
	}

}
?>
