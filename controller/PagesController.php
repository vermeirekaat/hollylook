<?php 

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/ArticlesDAO.php';  
require_once __DIR__ . '/../dao/CommentsDAO.php'; 
require_once __DIR__ . '/../dao/ImagesDAO.php';
require_once __DIR__ . '/../dao/RatingsDAO.php';
require_once __DIR__ . '/../dao/TagsDAO.php'; 


class PagesController extends Controller {
    private $articlesDAO; 
    private $commentsDAO; 
    private $imagesDAO; 
    private $tagsDAO; 
    private $ratingsDAO;

    function __construct() {
        $this->articlesDAO = new ArticlesDAO(); 
        $this->commentsDAO = new CommentsDAO(); 
        $this->imagesDAO = new ImagesDAO(); 
        $this->ratingsDAO = new RatingsDAO();
        $this->tagsDAO = new TagsDAO(); 
    }

    public function index() {
        $threeImages = $this->imagesDAO->selectRecentImagesByThree(); 
        $this->set('threeImages', $threeImages);

        $this->set('title', 'Home'); 
    }

    public function gallery() {

        $images = $this->imagesDAO->selectImagesWithLimit();
    
        if (!empty($_GET['sort'])) {
            if ($_GET['sort'] === 'recent') {
                $images = $this->imagesDAO->selectRecentImages();
                // this->set('images', $images);
            }
            if ($_GET['sort'] === 'popular') {
                $images = $this->imagesDAO->selectPopularImages();
                // $this->set('images', $images);
            }
            if($_GET['sort'] == 'total') {
                $images = $this->imagesDAO->selectImages();
            }
        }

        if($_SERVER['HTTP_ACCEPT'] == 'application/json') {
            echo json_encode($images); 
            exit(); 
        }

        $this->set('images', $images); 
        $this->set('title', 'Gallery');
    }

    public function detail() {
        // nagaan welk id er opgevraagd wordt via de link 
        if (!empty($_GET['id'])) {
            $image = $this->imagesDAO->selectImageById($_GET['id']);
            $this->set('image', $image); 
        }

        // juiste comments ophalen v/d imge o.b.v. de image_id
        $comments = $this->commentsDAO->selectCommentsByImageId($image['id']); 
        // gemiddelde rating ophalen
        $averageRating = $this->ratingsDAO->selectAverageRatingByImageId($image['id']);
        // tag ophalen van de afbeelding
        $tag = $this->imagesDAO->selectTagById($image['id']);
        

        // rating & comment afhandelen via JavaScript 
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType == "application/json") {
            $content = trim(file_get_contents("php://input"));
            $data = json_decode($content, true);
            if ($data['action'] == "insertRating") {
                $updatedRating = $this->ratingsDAO->insertRating($data);
                if (!$updatedRating) {
                    $errors = $this->ratingsDAO->validate($data);
                    $errors['error'] = "Something isn't working well";
                    echo json_encode($errors);
                } else {
                    $rating = $this->ratingsDAO->selectById($data['image_id']);
                    echo json_encode($rating);
                }
                exit();
            }
            if ($data['action'] == "insertComment") {
                $insertedComment = $this->commentsDAO->insertComment($data);
                if (!$insertedComment) {
                    $errors = $this->commentsDAO->validate($data);
                    $errors['error'] = "Something isn't working well";
                    echo json_encode($errors);
                } else {
                    $comments = $this->commentsDAO->selectCommentsByImageId($data['image_id']);
                    echo json_encode($comments);
                }
                exit();
            }
        }
        //rating afhandelen via PHP
        if(!empty($_POST['action'])) {
            if($_POST['action'] == 'insertRating') {
                $data = array(
                    'image_id' => $image['id'], 
                    'rating' => $_POST['rating']
                ); 
                $insertedRating = $this->ratingsDAO->insertRating($data);
                if(empty($insertedRating)) {
                    $errors = $this->ratingsDAO->validate($data); 
                    $this->set('errors', $errors); 
                } else {
                    header('Location: index.php?page=detail&id='.$image['id']);
                    exit(); 
                }
            }
            if ($_POST['action'] == 'insertComment') {
                $data = array(
                    'image_id' => $image['id'],
                    'comment' => $_POST['comment']
                );
                $insertedComment = $this->commentsDAO->insertComment($data); 
                if(!$insertedComment) {
                    $errors = $this->commentsDAO->validate($data); 
                    $this->set('errors', $errors); 
                } else {
                    header('Location: index.php?page=detail&id='.$_GET['id']);
                    exit(); 
                }
            }
        }

        $this->set('averageRating', $averageRating);
        $this->set('tag', $tag);
        $this->set('comments', $comments);
        $this->set('title', 'Detail'); 

    }

    public function blog() {
        // artikels selecteren 
        $articles = $this->articlesDAO->selectArticles();
        // alle tags ophalen om dan te checken op het value 
        $tags = $this->tagsDAO->selectTags(); 
       

        foreach($tags as $tag) {
            if (!empty($_GET['filter'])) {
                if ($_GET['filter'] == $tag['id']) {
                    $articles = $this->articlesDAO->selectFilteredArticles($tag['id']);
                    $this->set('articles', $articles);
                }
            }
        }

        $this->set('articles', $articles);
        $this->set('tags', $tags);
        $this->set('title', 'Blog'); 
    }

    public function article() {
        // specifiek artikel ophalen 
        if (!empty($_GET['id'])) {
            $article = $this->articlesDAO->selectArticleById($_GET['id']);
            $this->set('article', $article);
        }

        // related artikels en images selecteren
        $blogs = $this->articlesDAO->selectArticlesLimit($article['tag_id']);
        $looks = $this->imagesDAO->selectImagesByTag($article['tag_id']);
       

        $this->set('blogs', $blogs);
        $this->set('looks', $looks);
        $this->set('title', $article['title']);
    }

    public function create() {
        $error = ''; 

        if (!empty($_POST['action'])) {
            if ($_POST['action'] == 'uploadArticle') {
                $data = array(
                    'username' => $_POST['username'],
                    'tag_id' => $_POST['tag_id'],
                    'title' => $_POST['title'],
                    'introduction' => $_POST['introduction'],
                    'stepone' => $_POST['stepone'],
                    'steptwo' => $_POST['steptwo'],
                    'stepthree' => $_POST['stepthree']
                    );
                $uploadedArticle = $this->articlesDAO->insertArticle($data);
                if (!$uploadedArticle) {
                    $errors = $this->articlesDAO->validate($data);
                    $this->set('errors', $errors);
                } else {
                    $_SESSION['info'] = 'Your Tips & Tricks have been added to our blog.';
                    header('Location: index.php?page=blog&filter=');
                        exit();
                }
            }
            if($_POST['action'] == 'uploadImage') {
                if(empty($_FILES['image']) || !empty($_FILES['image']['error'])) {
                    $error = 'Please select a file'; 
                }

                if(empty($error)) {
                    $whitelist_type = array('image/jpeg', 'image/png', 'image/gif');
                    if (!in_array($_FILES['image']['type'], $whitelist_type)) {
                        $error = 'Please select the right file'; 
                    }
                }

                if(empty($error)) {
                    $size = getimagesize($_FILES['image']['tmp_name']); 
                    if($size[0] < 300 || $size[1] < 400) {
                        $error = 'The image should have the following dimensions 300 x 400';
                    }
                }
                if(empty($error)) {
                    $projectFolder = realpath(__DIR__); 
                    $targetFolder = $projectFolder . '/../assets/uploads';
                    $targetFolder = tempnam($targetFolder, ''); 
                    unlink($targetFolder); 
                    mkdir($targetFolder, 0777, true); 
                    $targetFileName = $targetFolder . '/' . $_FILES['image']['name']; 
                    $this->_resizeAndCrop($_FILES['image']['tmp_name'], $targetFileName, 270, 480); 
                    $relativeFileName = substr($targetFileName, strlen($projectFolder) - strlen('controller')); 
                    
                    $data = array(
                        'path' => $relativeFileName, 
                        'username' => $_POST['username'], 
                        'movie' => $_POST['movie'], 
                        'year' => $_POST['year'], 
                        'character' => $_POST['character'], 
                        'description' => $_POST['description'], 
                        'tag_id' => $_POST['tag_id']
                    );
                    $uploadedImage = $this->imagesDAO->uploadImage($data); 
                    if(!$uploadedImage) {
                        $errors = $this->imagesDAO->validate($data); 
                        $this->set('errors', $errors); 
                    } else {
                        $_SESSION['info'] = 'Your HOLLYLOOK has been added to our gallery.';
                        header('Location: index.php?page=gallery&sort=recent'); 
                        exit(); 
                    }
                }
             }
        }

        $this->set('title', 'Create'); 
    }

    public function fame() {

        // gebruikers selecteren met een gemiddelde rating van 5 sterren
        $famousUsers = $this->imagesDAO->selectImageByAverage(); 

        $this->set('famousUsers', $famousUsers);
        $this->set('title', 'Scroll of Fame');
    }

    private function _resizeAndCrop($src, $dst, $thumb_width, $thumb_height)
    {
        $type = exif_imagetype($src);
        $allowedTypes = array(
            1,  // [] gif
            2,  // [] jpg
            3  // [] png
        );

        if (!in_array($type, $allowedTypes)) {
            return false;
        }

        switch ($type) {
            case 1:
                $image = imagecreatefromgif($src);
                break;
            case 2:
                $image = imagecreatefromjpeg($src);
                break;
            case 3:
                $image = imagecreatefrompng($src);
                break;
            case 6:
                $image = imagecreatefrombmp($src);
                break;
        }

        $filename = $dst;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ($original_aspect >= $thumb_aspect) {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        } else {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled(
            $thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
            0 - ($new_height - $thumb_height) / 2, // Center the image vertically
            0,
            0,
            $new_width,
            $new_height,
            $width,
            $height
        );
        imagejpeg($thumb, $filename, 80);
        return true;
    }

}