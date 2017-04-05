<?php
namespace dragonjet\opengraph;
use Yii;
use yii\web\View;

class OpenGraph {
	public $title;
	public $site_name;
	public $url;
	public $description;
	public $type;
	public $locale;
	public $image;
	public $video;
	public $audio;	
	public $fb_app_id;
	public $determiner;
	public $updated_time;
	public $restrictions;
	
	public function __construct(){
		// Load default values
		$this->title = Yii::$app->name;
		$this->site_name = Yii::$app->name;
		$this->url = Yii::$app->request->absoluteUrl;
		$this->description = null;
		$this->type = 'article';
		$this->determiner = '';
		$this->updated_time = null;
		$this->locale = str_replace('-','_',Yii::$app->language);
		$this->image = [];
		$this->audio = [];
		$this->video = [];
		$this->restrictions = [];
		$this->fb_app_id = null;		
		
		// Twitter Card
		$this->twitter = new TwitterCard;
		
		// Listed to Begin Page View event to start adding meta
		Yii::$app->view->on(View::EVENT_BEGIN_PAGE, function(){
			// Register required and easily determined open graph data
			Yii::$app->controller->view->registerMetaTag(['property'=>'og:title', 'content'=>$this->title], 'og:title');
			Yii::$app->controller->view->registerMetaTag(['property'=>'og:determiner', 'content'=>$this->determiner], 'og:determiner');
			Yii::$app->controller->view->registerMetaTag(['property'=>'og:site_name', 'content'=>$this->site_name], 'og:site_name');
			Yii::$app->controller->view->registerMetaTag(['property'=>'og:url', 'content'=>$this->url], 'og:url');
			Yii::$app->controller->view->registerMetaTag(['property'=>'og:type', 'content'=>$this->type], 'og:type');
			
			// Locale issafe to be specifued since it has default value on Yii applications
			Yii::$app->controller->view->registerMetaTag(['property'=>'og:locale', 'content'=>$this->locale], 'og:locale');
			
			// Only add a description meta if specified
			if($this->description!==null){
				Yii::$app->controller->view->registerMetaTag(['property'=>'og:description', 'content'=>$this->description], 'og:description');
			}

			// Only add a updated_time meta if specified
			if($this->updated_time!==null){
				Yii::$app->controller->view->registerMetaTag(['property'=>'og:updated_time', 'content'=>$this->updated_time], 'og:updated_time');
			}

			// Only add a fb:app_id meta if specified
			if($this->description!==null){
				Yii::$app->controller->view->registerMetaTag(['property'=>'fb:app_id', 'content'=>$this->fb_app_id], 'fb:app_id');
			}
			
			// Only add an image meta if specified
			if( !empty( $this->image ) && is_array( $this->image ) ) {
				foreach ( $this->image as $key => $value) {
					Yii::$app->controller->view->registerMetaTag(['property'=>'og:image:'.$key, 'content'=>$value], 'og:image:'.$key);
				}
			}

			// Only add a audio meta if specified
			if( !empty( $this->audio ) && is_array( $this->audio ) ) {
				foreach ( $this->audio as $key => $value) {
					Yii::$app->controller->view->registerMetaTag(['property'=>'og:audio:'.$key, 'content'=>$value], 'og:audio:'.$key);
				}
			}
			
			// Only add a video meta if specified
			if( !empty( $this->video ) && is_array( $this->video ) ) {
				foreach ( $this->video as $key => $value) {
					Yii::$app->controller->view->registerMetaTag(['property'=>'og:video:'.$key, 'content'=>$value], 'og:video:'.$key);
				}
			}

			// Only add a restrictions meta if specified
			if( !empty( $this->restrictions ) && is_array( $this->restrictions ) ) {
				foreach ( $this->restrictions as $key => $value) {
					Yii::$app->controller->view->registerMetaTag(['property'=>'og:restrictions:'.$key, 'content'=>$value], 'og:restrictions:'.$key);
				}
			}

			$this->twitter->registerTags();
		});
	}
	
	
	public function set($metas=[]){
		// Massive assignment by array
		foreach($metas as $property=>$content){
			if($property=='twitter'){
				$this->twitter->set($content);
			}else if(property_exists($this, $property)){
				$this->$property = $content;
			}
		}
	}
	
}