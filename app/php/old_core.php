<?php

###########################
## TABLE `posts`         ##
## MYSQL "CATEGORY" CODE ##
## --------------------- ##
## 0 - Photo             ##
## 1 - Both              ##
## 2 - Video             ##
###########################
## TABLE `photographers` ##
## MYSQL "STANDING" CODE ##
## --------------------- ##
## 0 - LEFT / QUIT       ##
## 1 - REGULAR MEMBER    ##
## 2 - OFFICIAL MEMBER   ##
###########################
## TABLE `photographers` ##
## MYSQL "POSITION" CODE ##
## --------------------- ##
## 0 - PHOTGRAPHER       ##
## 1 - BOTH              ##
## 2 - VIDEOGRAPHER      ##
###########################

###########################
## MYSQL SETTINGS        ##
###########################

$host = "127.0.0.1";
$user = "lowdistrict_root";
$pass = "Admin123!";
$data = "lowdistrict";
$port = 3306;
$con = mysqli_connect($host, $user, $pass, $data, $port);

$BADGES = array();
Badge::setup();

function getRelativeDateFormat($time) {
	$now = time();
	$minutes = floor(($now - $time) / 60);
	$hours = floor(($now - $time) / 3600);
	$days = floor(($now - $time) / 86400);
	$months = intval(date('m', $now)) - intval(date('m', $time));
	$years = intval(date('Y', $now)) - intval(date('Y', $time));
	// Month Correction
	if (intval(date('j', $time)) > intval(date('j', $now))) {
		$months--;
	}
	if ($years > 0) {
		$months += 12;
	}
	// Years Correction
	if (intval(date('m', $time)) > intval(date('m', $now))) {
		$years--;
	}
	if ($years > 0) {
		switch ($years) {
			case 1:
				return "1 year ago";
			default:
				return $years." years ago";
		}
	}
	if ($months > 0) {
		switch ($months) {
			case 1:
				return "1 month ago";
			default:
				return $months." months ago";
		}
	}
	if ($days > 0) {
		switch ($days) {
			case 1:
				return "1 day ago";
			default:
				return $days." days ago";
		}
	}
	if ($hours > 0) {
		switch ($hours) {
			case 1:
				return "1 hour ago";
			default:
				return $hours." hours ago";
		}
	}
	if ($minutes > 0) {
		switch ($minutes) {
			case 1:
				return "1 minute ago";
			default:
				return $minutes." minutes ago";
		}
	}
	return "just now";
}
function parseDate($date) {
	if ($date == "0000-00-00") {
		return "?";
	}
	else {
		return date("F", strtotime($date))." ".date("Y", strtotime($date));
	}
}
function getWhiteNavigation() {
	include "snippets/white_nav.php";
}
function getBlackNavigation() {
	include "snippets/black_nav.php";
}
function getFooter() {
	include "snippets/footer.php";
}
function hidden($x) {
	if ($x) {
		echo "style=\"display: none;\"";
	}
}

class Post {

    public $id;
    public $title;
    public $date;
    public $category;
    public $video_id;
    public $shot_by;
    public $car_year;
    public $car_make;
    public $car_model;
    public $loc_city;
    public $loc_state;
    public $loc_country;
    public $owner_name;
    public $views;
    public $exterior_details;
    public $interior_details;
    public $performance_details;
    public $description;
	public $adfly;

    public $instagram;
    public $facebook;
    public $googleplus;
	public $tumblr;
    public $snapchat;
    public $flickr;
    public $twitter;
    public $youtube;

    public $photographer;

    private $mini = "";
    private $square = "";
    private $class = "blog-photo";
    private $descriptionDisplay = false;
    private $dateDisplay = false;

    public function __construct($post) {
        $this->id = $post['id'];
        $this->title = $post['title'];
        $this->date = $post['date'];
        $this->category = $post['category'];
        $this->video_id = $post['video_id'];
        $this->shot_by = $post['shot_by'];
        $this->car_year = $post['car_year'];
        $this->car_make = $post['car_make'];
        $this->car_model = $post['car_model'];
        $this->loc_city = $post['loc_city'];
        $this->loc_state = $post['loc_state'];
        $this->loc_country = $post['loc_country'];
        $this->owner_name = $post['owner_name'];
        $this->views = $post['views'];
        $this->exterior_details = $post['exterior_details'];
        $this->interior_details = $post['interior_details'];
        $this->performance_details = $post['performance_details'];
        $this->description = str_replace("\n", "<br>", $post['description']);
		$this->adfly = $post['adfly'];
        $this->instagram = $post['instagram'];
        $this->facebook = $post['facebook'];
        $this->googleplus = $post['googleplus'];
        $this->tumblr = $post['tumblr'];
        $this->snapchat = $post['snapchat'];
        $this->flickr = $post['flickr'];
        $this->twitter = $post['twitter'];
        $this->youtube = $post['youtube'];
        $this->init($post);
    }
    private function init() {
        if ($this->category == 1) {
            $this->class = "blog-both";
        }
        if ($this->category == 2) {
            $this->class = "blog-video";
        }
        $this->photographer = new Photographer($this->shot_by);
    }
    public function displayBlock() {
		echo '
        <div class="blog-block '.$this->class.'">
            <div class="blog-title '.$this->mini.'">
                <a class="no-trans" href="post.php?id='.$this->id.'">'.$this->title.'</a>
            </div>';
        if ($this->dateDisplay) {
			$href = 'href="profile.php?id='.$this->photographer->id.'"';
			if ($this->photographer->standing == 1) {
				$href = '';
			}
			echo '
				<div class="blog-meta">
					<span>by <a '.$href.'>'.$this->photographer->first_name." ".$this->photographer->last_name.'</a></span>
					<span class="float-right">'.getRelativeDateFormat(strtotime($this->date)).'<img class="blog-clock" src="images/sprites/timer.png"></span>
				</div>';
        }
        echo '
			<div class="blog-cover '.$this->square.'">
                <a href="post.php?id='.$this->id.'"><div class="blog-cover-img" style="background-image: url(images/posts/'.$this->id.((empty($this->square))?'/cover_sd':'/thumb_blog').'.jpg);"></div></a>
            </div>
            <div class="blog-meta">
                <span>'.$this->loc_city.', '.$this->loc_state.'</span>
                <span><img class="flag" src="images/flags/'.strtolower($this->loc_country).'.png"></span>
            </div>';
        if ($this->descriptionDisplay) {
			$limited = trim(substr($this->description, 0, 370));
			$words = explode(' ', $limited);
			$words[count($words) - 1] = "";
			$output = "";
			foreach ($words as $word) {
				$output = $output." ".$word;
			}
			echo '<p>'.trim($output).'...</p>';
        }
		else {
			echo '<br>';
		}
		if ($this->mini == "mini") {
			echo '
				<a class="blog-read_more" href="post.php?id='.$this->id.'">See More</a>
			</div>';
		}
		else {
			echo '
				<div class="container-align-right">
					<a class="button" href="post.php?id='.$this->id.'">Read More</a>
				</div>
			</div>';
		}
    }
    public function setMini() {
        $this->mini = "mini";
    }
    public function setSquare() {
        $this->square = "square";
    }
    public function showDescription() {
        $this->descriptionDisplay = true;
    }
    public function showDate() {
        $this->dateDisplay = true;
    }
}
class Photographer {

	public $id;
	public $first_name;
	public $last_name;
	public $age;
	public $gender;
	public $phone;
	public $email;
	public $alt_email;
	public $loc_country;
	public $loc_state;
	public $loc_city;
	public $loc_zip;
	public $xp_photo;
	public $xp_video;
	public $rating_p;
	public $rating_v;
	public $position;
	public $summary;
	public $date_joined;
	public $standing;

	public $languages;
	public $badges = array();
	public $profilePicSrc;

	public $languageList = array();
	public $photoshop_cert;
	public $lightroom_cert;
	public $full_frame;

	public $instagram;
	public $facebook;
	public $googleplus;
	public $snapchat;
	public $flickr;
	public $twitter;
	public $youtube;

    function __construct($id) {
        global $con;
        $photo = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `photographers` WHERE (`id` = $id) LIMIT 0,1"));
		$this->id = $photo['id'];
		$this->first_name = $photo['first_name'];
		$this->last_name = $photo['last_name'];
		$this->age = $photo['age'];
		$this->gender = $photo['gender'];
		$this->phone = $photo['phone'];
		$this->email = $photo['email'];
		$this->alt_email = $photo['alt_email'];
		$this->loc_country = $photo['loc_country'];
		$this->loc_state = $photo['loc_state'];
		$this->loc_city = $photo['loc_city'];
		$this->loc_zip = $photo['loc_zip'];
		$this->xp_photo = $photo['xp_photo'];
		$this->xp_video = $photo['xp_video'];
		$this->rating_p = $photo['rating_p'];
		$this->rating_v = $photo['rating_v'];
		$this->position = $photo['position'];
		$this->summary = $photo['summary'];
		$this->date_joined = $photo['date_joined'];
		$this->standing = $photo['standing'];
		$this->photoshop_cert = $photo['photoshop_cert'];
		$this->lightroom_cert = $photo['lightroom_cert'];
		$this->full_frame = $photo['full_frame'];
		$this->instagram = $photo['instagram'];
		$this->facebook = $photo['facebook'];
		$this->googleplus = $photo['googleplus'];
		$this->snapchat = $photo['snapchat'];
		$this->flickr = $photo['flickr'];
		$this->twitter = $photo['twitter'];
		$this->youtube = $photo['youtube'];
		if (file_exists("./images/profile/".$photo['id'].".jpg")) {
			$this->profilePicSrc = "/images/profile/".$photo['id'].".jpg";
		}
		else {
			$this->profilePicSrc = "/images/profile/no-profile-pic.png";
		}
		$this->gender();
		$this->age();
		$this->setupLanguages();
		$this->setupBadges();
    }
	private function gender() {
		if ($this->gender == 0) {
			$this->gender = "Male";
		}
		else if ($this->gender == 1) {
			$this->gender = "Female";
		}
		else {
			$this->gender = "?";
		}
	}
	private function age() {
		$vars = explode('-', $this->age);
		if ($vars[0] != "0000") {
			$this->age = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$this->age = "?";
		}
	}
	private function setupLanguages() {
		global $con;
		$query = mysqli_query($con, "SELECT * FROM `photographers_languages` WHERE `photographer_id` = ".$this->id);
		while ($row = mysqli_fetch_array($query)) {
			$lang = new Language($row['language_id']);
			$lang->setFluency($row['fluency']);
			$this->languageList[] = $lang;
		}
		for ($i = 0; $i < count($this->languageList); $i++) {
			$language = $this->languageList[$i];
			$this->languages .= $language->name . " (" . $language->fluency . ")";
			if ($i < count($this->languageList) - 1) {
				$this->languages .= ", ";
			}
		}
	}
	private function setupBadges() {
		global $BADGES;
		for ($i = 0; $i < count($BADGES); $i++) {
			$badge = $BADGES[$i];
			if ($badge->checkPhotographer($this)) {
				$this->badges[] = $badge;
			}
		}
	}
	public function displayMini() {
		if ($this->position == 0) {
			$icons = '<img class="team-icon" src="images/sprites/team/photo.png" />';
		}
		if ($this->position == 1) {
			$icons = '<img class="team-icon" src="images/sprites/team/photo.png" />
				<img class="team-icon" src="images/sprites/team/video.png" />';
			}
		if ($this->position == 2) {
			$icons = '<img class="team-icon" src="images/sprites/team/video.png" />';
		}
		echo '<div class="team-block">
			<a href="/profile.php?id='.$this->id.'">
				<img class="team-picture" src="'.$this->profilePicSrc.'" />
			</a>
			<h1>
				<a href="/profile.php?id='.$this->id.'">'.$this->first_name." ".substr($this->last_name, 0, 1).".".'</a>
			</h1>
			<span>
				<img class="team-flag" src="images/flags/'.strtolower($this->loc_country).'.png" />'.$this->loc_city.", ".parse($this->loc_country, $this->loc_state).'
			</span>
			'.$icons.'
		</div>';
	}

}
class Language {

	public $name;
	public $fluency;

	function __construct($id) {
		global $con;
		$language = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `languages` WHERE `id` = $id"));
		$this->name = $language['name'];
	}
	public function setFluency($fluency) {
		if ($fluency == 0) {
			$this->fluency = "Basic";
		}
		else if ($fluency == 1) {
			$this->fluency = "Fluent";
		}
		else {
			$this->fluency = "?";
		}
	}

}
class FindArea {

	private function getLocations($q) {
		$items = array();
		$loc = array();
		while ($item = mysqli_fetch_array($q)) {
			array_push($items, $item);
		}
		foreach ($items as $photo) {
			$co = $photo['loc_country'];
			$st = $photo['loc_state'];
			$ci = $photo['loc_city'];
			if (!isset($loc[$co])) {
				$loc[$co] = array();
			}
			if (!isset($loc[$co][$st])) {
				$loc[$co][$st] = array();
			}
			if (!isset($loc[$co][$st][$ci])) {
				$loc[$co][$st][$ci] = 0;
			}
			$loc[$co][$st][$ci] += 1;
		}
		$oldOrder = array();
		foreach ($loc as $co=>$val) {
			$countStr = (string) FindArea::countCountry($loc, $co);
			$len = strlen($countStr);
			for ($j = $len; $j < 5; $j++) {
				$countStr = "0".$countStr;
			}
			$oldOrder[] = $countStr."-".$co;
		}
		rsort($oldOrder);
		$newOrder = array();
		foreach ($oldOrder as $key=>$value) {
			$co = explode("-", $value)[1];
			$newOrder[$co] = $loc[$co];
		}
		return $newOrder;
	}
	static function getPhotographers() {
		global $con;
		$q = mysqli_query($con, "SELECT * FROM `photographers` WHERE (standing = 2) ORDER BY loc_country, loc_state, loc_city");
		return FindArea::getLocations($q);
	}
	static function getFeatures() {
		global $con;
		$q = mysqli_query($con, "SELECT * FROM `posts` ORDER BY loc_country, loc_state, loc_city");
		return FindArea::getLocations($q);
	}
	static function countCountry($loc, $country) {
		$output = 0;
		foreach ($loc[$country] as $st=>$val) {
			$output += FindArea::countState($loc, $country, $st);
		}
		return $output;
	}
	static function countState($loc, $country, $state) {
		$output = 0;
		foreach ($loc[$country][$state] as $value) {
			$output += $value;
		}
		return $output;
	}

}
abstract class Badge {

	public $name;
	public $path;

	function __construct() {
		global $BADGES;
		$BADGES[] = $this;
	}
	static function setup() {
		new OfficialMember();
		new PhotographerCertified();
		new VideographerCertified();
		new PhotographerAndVideographer();
		new EditingCertified();
		new LightroomCertified();
		new PhotoshopCertified();
		new FullFrame();
		new FiveStarsPhoto();
		new FiveStarsVideo();
		new ThreeLanguages();
		new FiveYearPhoto();
		new FourYearPhoto();
		new ThreeYearPhoto();
		new TwoYearPhoto();
		new FiveYearVideo();
		new FourYearVideo();
		new ThreeYearVideo();
		new TwoYearVideo();
	}
	public abstract function checkPhotographer($photo);

}

// BADGES //

class OfficialMember extends Badge {

	public $name = "Certified LD Member";
	public $path = "/images/badges/ld_member.png";

	public function checkPhotographer($photo) {
		return true;
	}

}
class EditingCertified extends Badge {

	public $name = "Editing Certified";
	public $path = "/images/badges/editing_certified.png";

	public function checkPhotographer($photo) {
		if ($photo->rating_v >= 4.3) {
			return true;
		}
		return false;
	}

}
class LightroomCertified extends Badge {

	public $name = "Lightroom Certified";
	public $path = "/images/badges/lightroom_certified.png";

	public function checkPhotographer($photo) {
		if ($photo->lightroom_cert == 1) {
			return true;
		}
		return false;
	}

}
class PhotographerCertified extends Badge {

	public $name = "Certified Photographer";
	public $path = "/images/badges/photo_certified.png";

	public function checkPhotographer($photo) {
		if ($photo->rating_p >= 4.0) {
			return true;
		}
		return false;
	}

}
class PhotoshopCertified extends Badge {

	public $name = "Photoshop Certified";
	public $path = "/images/badges/photoshop_certified.png";

	public function checkPhotographer($photo) {
		if ($photo->photoshop_cert == 1) {
			return true;
		}
		return false;
	}

}
class VideographerCertified extends Badge {

	public $name = "Certified Videogapher";
	public $path = "/images/badges/video_certified.png";

	public function checkPhotographer($photo) {
		if ($photo->rating_v >= 4.0) {
			return true;
		}
		return false;
	}

}
class FiveYearPhoto extends Badge {

	public $name = "5 Year Photographer";
	public $path = "/images/badges/five_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_photo);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years >= 5) {
			return true;
		}
		return false;
	}

}
class FourYearPhoto extends Badge {

	public $name = "4 Year Photographer";
	public $path = "/images/badges/four_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_photo);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years == 4) {
			return true;
		}
		return false;
	}

}
class ThreeYearPhoto extends Badge {

	public $name = "3 Year Photographer";
	public $path = "/images/badges/three_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_photo);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years == 3) {
			return true;
		}
		return false;
	}

}
class TwoYearPhoto extends Badge {

	public $name = "2 Year Photographer";
	public $path = "/images/badges/two_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_photo);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years == 2) {
			return true;
		}
		return false;
	}

}
class FiveYearVideo extends Badge {

	public $name = "5 Year Videographer";
	public $path = "/images/badges/five_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_video);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years >= 5) {
			return true;
		}
		return false;
	}

}
class FourYearVideo extends Badge {

	public $name = "4 Year Videographer";
	public $path = "/images/badges/four_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_video);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years == 4) {
			return true;
		}
		return false;
	}

}
class ThreeYearVideo extends Badge {

	public $name = "3 Year Videographer";
	public $path = "/images/badges/three_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_video);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years == 3) {
			return true;
		}
		return false;
	}

}
class TwoYearVideo extends Badge {

	public $name = "2 Year Videographer";
	public $path = "/images/badges/two_years.png";

	public function checkPhotographer($photo) {
		$years;
		$vars = explode('-', $photo->xp_video);
		if ($vars[0] != "0000") {
			$years = (date("md", date("U", mktime(0, 0, 0, $vars[1], $vars[2], $vars[0]))) > date("md") ? ((date("Y") - $vars[0]) - 1) : (date("Y") - $vars[0]));
		}
		else {
			$years = 0;
		}
		if ($years == 2) {
			return true;
		}
		return false;
	}

}
class ThreeLanguages extends Badge {

	public $name = "3+ Languages";
	public $path = "/images/badges/three_languages.png";

	public function checkPhotographer($photo) {
		if (count($photo->languageList) >= 3) {
			return true;
		}
		return false;
	}

}
class FullFrame extends Badge {

	public $name = "Full Frame";
	public $path = "/images/badges/full_frame.png";

	public function checkPhotographer($photo) {
		if ($photo->full_frame == 1) {
			return true;
		}
		return false;
	}

}
class FiveStarsPhoto extends Badge {

	public $name = "Five Star Photographer";
	public $path = "/images/badges/five_stars.png";

	public function checkPhotographer($photo) {
		if ($photo->rating_p == 5) {
			return true;
		}
		return false;
	}

}
class FiveStarsVideo extends Badge {

	public $name = "Five Star Videographer";
	public $path = "/images/badges/five_stars.png";

	public function checkPhotographer($photo) {
		if ($photo->rating_v == 5) {
			return true;
		}
		return false;
	}

}
class PhotographerAndVideographer extends Badge {

	public $name = "Photo & Film Friendly";
	public $path = "/images/badges/photo_and_video.png";

	public function checkPhotographer($photo) {
		if ($photo->position == 1) {
			return true;
		}
		return false;
	}

}

?>
