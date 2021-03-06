<?php
	class Group{

		public $id;
		public $name;
		public $screen_name;
		public $is_closed;
		public $deactivated;
		public $is_admin;
		public $admin_level;
		public $is_member;
		public $type;
		public $photo_50;
		public $photo_100;
		public $photo_200;
		public $ban_info = array();
		public $city;
		public $country;
		public $place = array();
		public $description;
		public $wiki_page;
		public $members_count;
		public $counters;
		public $start_date;
		public $finish_date;
		public $can_post;
		public $can_see_all_posts;
		public $can_upload_doc;
		public $can_upload_video;
		public $can_create_topic;
		public $activity;
		public $status;
		public $contacts;
		public $links;
		public $fixed_post;
		public $verified;
		public $main_album_id;
		public $is_favorite;

		public function __construct($a)
		{
			if (!empty($a))
			{
				foreach ($this as $key => $property)
				{
					if (!empty($a[$key]))
					{
						$this->$key = $a[$key];
					}
				}
			}
		}

		public static function getGroup($group_id)
		{
			$data = App::api('groups.getById', array(
				'group_id'=> $group_id,
			));
			$group = new Group($data[0]);
			return $group;
		}

		public static function getPosts($domain, $count = 3, $offset = 0, $extended = 1, $filter = 'all')
		{
			$tdomain = intval($domain);
			if (is_integer($tdomain) && $tdomain != 0)
				$domain = '-'.$domain;
			$data = App::api('wall.get', array(
				'domain'=>$domain,
				'offset'=>$offset,
				'extended'=>$extended,
				'count'=>$count,
				'filter'=>$filter,
			));
			$posts = array();
			foreach ($data['items'] as $key => $post)
			{
				$posts[] = new Post($post);
			}
			return $posts;
		}

		public static function addPost($owner_id, $user_id, $message = '', $attachments = '', $link = '')
		{
			$group = self::getGroup($owner_id);
			$attach = array();
			if (strlen($attachments) > 0)
			{
				$arAttachments = App::upload_photo($group->id, array($attachments));
				foreach ($arAttachments as $key => $value)
				{
					$attach[] = 'photo'.$user_id.'_'.$value;
				}
			}
			if (strlen($link) > 0)
			{
				$attach[] = $link;
			}
			$data = App::api('wall.post', array(
				'owner_id'=> '-'.$group->id,
				'message'=>$message,
				'attachments'=>$attach
			));
			return $data['post_id'];
		}

		public static function getComments($domain, $post_id, $count = 3, $offset = 0)
		{
			$tdomain = intval($domain);
			if (is_integer($tdomain) && $tdomain != 0)
				$domain = '-'.$domain;
			$data = App::api('wall.getComments', array(
				'owner_id'=>$domain,
				'post_id'=>$post_id,
				'offset'=>$offset,
				'count'=>$count,
			));
			if (!isset($data['error']))
			{
				$comments = array();
				foreach ($data['items'] as $key => $comment)
				{
					$comments[] = new Comment($comment);
				}
				return $comments;
			}
		}

		public static function addComment($owner_id, $post_id, $text, $attachments)
		{
			$data = App::api('wall.addComment', array(
				'owner_id'=> '-'.$owner_id,
				'post_id'=>$post_id,
				'text'=>$text,
				'attachments'=>$attachments,
			));
			return $data['comment_id'];
		}

		public static function getMembers($domain, $sort = 'id_asc', $filter = '', $offset = 0, $count = 10)
		{
			$group_id = self::getGroup($domain)->id;
			$data = App::api('groups.getMembers', array(
				'group_id'=>$group_id,
				'sort'=>$sort,
				'offset'=>$offset,
				'filter'=>$filter,
				'count'=>$count
			));
			$users = array();
			foreach ($data['items'] as $key => $user_id)
			{
				$users[] = User::getUser(intval($user_id));
			}
			return $users;
		}
	}