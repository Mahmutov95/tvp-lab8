<?php
	class Wall
	{
		public static function post($owner_id, $message, $attachments)
		{
			$data = App::api('wall.post', array ( 'owner_id' => $owner_id, 'message' => $message, 'attachments' => $attachments ));
			return $data;
		}
	}
?>