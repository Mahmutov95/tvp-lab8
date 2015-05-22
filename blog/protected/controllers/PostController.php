<?php

Yii::import('application.vendors.*');
require_once('Facebook/SDK/autoload.php');
use Facebook\FacebookSession;	
use Facebook\FacebookRequest;

class PostController extends Controller
{
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$post=$this->loadModel();
		$comment=$this->newComment($post);

		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Post;
		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			$model->file = CUploadedFile::getInstance($model, 'file');
			if(isset($_POST['share']) && $_POST['share'] == 'facebook')
			{
				$token = 'CAAP8t3tJ5bUBADYZAg9ap97F7sI2ZAw0wvXjtf99wpODa7AL2J8NJffgZB9TDcfd5qWW9JHzYvgG0ZAatM5C2VBDricp9kank4iG47OGkpgZBcSdhaKAQrcvqdSaorkaIVaIvPuQktb9neaovjCUQHZA1WBiW6IrAra9lw0QbpLuxmZA85hytwpSBajtIo9l5ZBcYpWJRbhfSIhuyq341fH3';

				FacebookSession::setDefaultApplication('1122289907787189','f46ab637962fb1491b956ccc2154a7d5');
				$session = new FacebookSession($token);

				$getPages = (new FacebookRequest(
					$session,
					'GET',
					'/me/accounts'
				))->execute()->getGraphObject()->asArray();
				$pageId = $getPages['data'][0]->id;
				$pageAccessToken = $getPages['data'][0]->access_token;
				if (!empty($model->file))
				{
					$location = '';
					if(substr_count($model->file->getType(), 'video') > 0)
						$location = 'videos';
					elseif(substr_count($model->file->getType(), 'image') > 0)
						$location = 'photos';
					(new FacebookRequest(
						$session,
						'POST',
						'/'.$pageId.'/'.$location,
						array(
							'access_token'=>$pageAccessToken,
							'message'=>$model->content,
							'source'=>new CURLFile($model->file->tempName, $model->file->getType()),
						))
					)->execute()->getGraphObject();	
				}
				else
				{
					(new FacebookRequest(
						$session,
						'POST',
						'/'.$pageId.'/feed',
						array(
							'access_token'=>$pageAccessToken,
							'message'=>$model->content,
							'link'=>$model->link,
						))
					)->execute()->getGraphObject();	
				}
			}
			if($model->save())
			{
				if (!empty($model->file))
				{
					$translit = array(
		            'а'=>'a','б'=>'b','в'=>'v',
		            'г'=>'g','д'=>'d','е'=>'e',
		            'ё'=>'yo','ж'=>'zh','з'=>'z',
		            'и'=>'i','й'=>'j','к'=>'k',
		            'л'=>'l','м'=>'m','н'=>'n',
		            'о'=>'o','п'=>'p','р'=>'r',
		            'с'=>'s','т'=>'t','у'=>'u',
		            'ф'=>'f','х'=>'x','ц'=>'c',
		            'ч'=>'ch','ш'=>'sh','щ'=>'shh',
		            'ь'=>'\'','ы'=>'y','ъ'=>'\'\'',
		            'э'=>'e\'','ю'=>'yu','я'=>'ya',
		            'А'=>'A','Б'=>'B','В'=>'V',
		            'Г'=>'G','Д'=>'D','Е'=>'E',
		            'Ё'=>'YO','Ж'=>'Zh','З'=>'Z',
		            'И'=>'I','Й'=>'J','К'=>'K',
		            'Л'=>'L','М'=>'M','Н'=>'N',
		            'О'=>'O','П'=>'P','Р'=>'R',
		            'С'=>'S','Т'=>'T','У'=>'U',
		            'Ф'=>'F','Х'=>'X','Ц'=>'C',
		            'Ч'=>'CH','Ш'=>'SH','Щ'=>'SHH',
		            'Ь'=>'\'','Ы'=>'Y\'','Ъ'=>'\'\'',
		            'Э'=>'E\'','Ю'=>'YU','Я'=>'YA',
		        	);
					$path = 'upload/'.strtr($model->file->getName(), $translit);
					$model->file->saveAs($path);
					$model->file = $path;
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
			{	
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED,
			'order'=>'update_time DESC',
			'with'=>'commentCount',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);

		$dataProvider=new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				if(Yii::app()->user->isGuest)
					$condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';
				$this->_model=Post::model()->findByPk($_GET['id'], $condition);
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}
}
