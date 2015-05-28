<?
	
	class Photos
	{
		public $id;			//������������� ����������. ������������� �����
		public $album_id;	//������������� �������, � ������� ��������� ����������. int (�������� ��������)
		public $owner_id;	//������������� ��������� ����������. int (�������� ��������)
		public $user_id;	//������������� ������������, ������������ ���� (���� ���������� ��������� � ����������). ��� ����������, ����������� �� ����� ����������, user_id=100. ������������� �����
		public $photo_75;	//url ����� ���������� � ������������ �������� 75x75px. ������
		public $photo_130;	//url ����� ���������� � ������������ �������� 130x130px. ������
		public $photo_604;	//url ����� ���������� � ������������ �������� 604x604px. ������
		public $photo_807;	//url ����� ���������� � ������������ �������� 807x807px. ������
		public $photo_1280;	//url ����� ���������� � ������������ �������� 1280x1024px. ������
		public $photo_2560;	//url ����� ���������� � ������������ �������� 2560x2048px. ������
		public $width;		//������ ��������� ���������� � ��������. ������������� �����
		public $height;		//������ ��������� ���������� � ��������. ������������� �����
		public $text;		//����� �������� ����������. ������
		public $date;		//���� ���������� � ������� unixtime. ������������� �����
		public $likes = array();
		public $comments = array();
		public $tags = array();
		
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
		
		public static function save($file)
		{
			//print_r($file);
			
			$data_json = App::api('photos.getWallUploadServer', array('group_id' => 55599957));
			
			if (!isset($data_json['upload_url'])) return false;
			$upload_url = $data_json['upload_url'];
			
			$files_ = array();
			$files_['file0'] = new CURLFile($file->tempName, $file->type, $file->name);
			
			$ch = curl_init($upload_url);
			$useragent='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3';
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $files_);
			
			$upload_data = json_decode(curl_exec($ch), true);
			//print_r($upload_data);
			
			//echo '<hr>';
			
			$result = App::api('photos.saveWallPhoto', array ( 'group_id' => 55599957, 'photo' => $upload_data['photo'], 'server' => $upload_data['server'], 'hash' => $upload_data['hash']));
			//print_r($result);
			return $result;
		}
	}	
		
?>