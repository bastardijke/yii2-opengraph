# Open Graph for Yii 2.x
Open Graph implementation for Yii 2 which adds valid meta tags to your HTML output.

## Configuration
```
'components' => [
    'opengraph' => [
        'class' => 'dragonjet\opengraph\OpenGraph',
        'title' => 'My_Article',
        'description' => 'My_Article_Description',
        'image' => [ 'url' => '@web/images/image-for-my-article.png', ],
        //....
    ],
    //....
],
```

## Usage
The following codes must be used on controller actions before rendering the view.

### Usage via Object
```
Yii::$app->opengraph->title = 'My_Article';
Yii::$app->opengraph->description = 'My_Article_Description';
Yii::$app->opengraph->image = [ 'url' => '@web/images/image-for-my-article.png', ];
return $this->render('My_View_Name');
```

### Usage via Array
```
Yii::$app->opengraph->set([
    'title' => 'My_Article',
    'description' => 'My_Article_Description',
    'image' => [ 'url' => '@web/images/image-for-my-article.png', ],
]);
return $this->render('My_View_Name');
```

### Twitter Cards
```
Yii::$app->opengraph->title = 'My_Article';
Yii::$app->opengraph->description = 'My_Article_Description';
Yii::$app->opengraph->image = [ 'url' => '@web/images/image-for-my-article.png', ];
Yii::$app->opengraph->twitter->card = 'summary';
Yii::$app->opengraph->twitter->site = 'My_Site_Twitter_Username';
Yii::$app->opengraph->twitter->creator = 'Author_Username';
return $this->render('My_View_Name');
```
or
```
Yii::$app->opengraph->set([
    'title' => 'My_Article',
    'description' => 'My_Article_Description',
    'image' => [ 'url' => '@web/images/image-for-my-article.png', ],
    'twitter' => [
        'card' => 'summary',
        'site' => 'My_Site_Twitter_Username',
        'creator' => 'Author_Username',
    ],
]);
return $this->render('My_View_Name');
```

## Available Properties
#### Title
`Yii::$app->opengraph->title`

This is the title that shows up on social sharing. In contrast to the view title, this should be simpler and should not contain your branding for best practice, as mentioned on the *Facebook Sharing Guidelines*:

* "*The title of your article, excluding any branding.*"
* "*The title should not have branding or extraneous information.*"

e.g. "*MySite.com - Blog - Hello world!*" should just be "*Hello World!*"


#### Determiner
`Yii::$app->opengraph->determiner`
	
The word that appears before the object in a story (such as "an Omelette"). This value should be a string that is a member of the Enum {a, an, the, "", auto}. When 'auto' is selected, Facebook will choose between 'a' or 'an'. Default is blank.

#### Site Name
`Yii::$app->opengraph->site_name`

[**Automatic**] Your website's name. You do not need to specify this on every controller action if you have an application `name` in your Yii config:

```
return [
    'id' => 'yiiappid',
    'name' => 'My Website',
    //....
]
```

#### URL
`Yii::$app->opengraph->url`

[**Automatic**] This is automatically prefilled with the current URL. You do not need to specify this on every controller action.

#### Description
`Yii::$app->opengraph->description`

Description of the current page. Optional but recommended for best results in social sharing.

#### Object Type
`Yii::$app->opengraph->type`

The type of object this page will appear on social media. Defaults to `article`.

#### Updated Time
`Yii::$app->opengraph->updated_time`

When the object was last updated. Optional.

#### See also
`Yii::$app->opengraph->see_also`

An array of URLs of related resources.

#### TTL
`Yii::$app->opengraph->ttl`

Seconds until this page should be re-scraped. Use this to rate limit the Facebook content crawlers. The minimum allowed value is 345600 seconds (4 days); if you set a lower value, the minimum will be used. If you do not include this tag, the ttl will be computed from the "Expires" header returned by your web server, otherwise it will default to 7 days.

#### Locale
`Yii::$app->opengraph->locale`

[**Automatic**] This is the locale (language) of the open graph object. This defaults to your Yii application language.

#### Image
`Yii::$app->opengraph->image`

```
array [
    'url' => 'http://example.com/image.png',
    'secure_url' => 'https://secure.example.com/image.png',
    'type' => 'image/png',
    'width' => '600',
    'height' => '315',   
]
```

Image for the graph object. This is highly recommended for best results when shared onto the social media. For best results in Facebook, make this at least `600x315px`

#### Audio
`Yii::$app->opengraph->audio`

```
array [
    'url' => 'http://example.com/audio.mp3',
    'secure_url' => 'https://secure.example.com/audio.mp3',
    'type' => 'audio/mp3',
]
```

#### Video
`Yii::$app->opengraph->video`

```
array [
    'url' => 'http://example.com/movie.swf',
    'secure_url' => 'https://secure.example.com/movie.swf',
    'type' => 'application/x-shockwave-flash',
    'width' => '400',
    'height' => '300',   
]
```

#### Restrictions
`Yii::$app->opengraph->restrictions`

```
array [
    'country:allowed' => 'US', // array of countries
    'country:disallowed' => 'CN', // *Note you can only have one :allowed or one :disallowed instance in the markup.
    'age' => '18+', // An age restriction for the object
    'content' => 'alcohol', // A content restriction for the object, such as 'alcohol' (the only currently supported value)
]
```

#### Facebook App ID
`Yii::$app->opengraph->fb_app_id`

In order to use [Facebook Domain Insights](https://developers.facebook.com/docs/platforminsights/domains) you must add the app ID to your page. Domain Insights lets you view analytics for traffic to your site from Facebook. Find the app ID in your [App Dashboard](https://developers.facebook.com/apps/redirect/dashboard).