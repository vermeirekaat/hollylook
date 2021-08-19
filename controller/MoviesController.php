<?php 

require_once __DIR__ . '/Controller.php'; 
require_once __DIR__ . '/../dao/MoviesDAO.php'; 

class MoviesController extends Controller {
    private $moviesDAO; 

    function __construct() {
        $this->moviesDAO = new MoviesDAO(); 
    }

    public function history() {
        $movies = $this->moviesDAO->selectAllMovies(); 
        $this->set('movies', $movies);

        if (!empty($_POST['action'])) {
            // is er op een button geklikt?
            if ($_POST['action'] == 'add') {
                // uitvoering staat in aparte functie
                $this->_handleAdd(); 
                header('Location: index.php?page=history#shop'); 
                exit(); 
            }
            if ($_POST['action'] == 'empty') {
                // cart session opnieuw instellen op een lege array 
                $_SESSION['cart'] = array(); 
            }
        }
        if (!empty($_POST['remove'])) {
            // een specifiek item wordt verwijderd uit de cart, aparte functie 
            $this->_handleRemove();
            // rederict naar dezelfde pagina
            header('Location: index.php?page=history#shop');
            exit(); 
        }
        // films selecteren die op de pagina afgebeeld staan 
        $this->set('title', 'History'); 
    }

    private function _handleAdd() {
        // indien de film nog neit aanwezig is in de winkelwagen: starten op 0
        if (empty($_SESSION['cart'][$_POST['movie_id']])) {
            $movie = $this->moviesDAO->selectMovieById($_POST['movie_id']); 
            if(empty($movie)) {
                // niet bestaande film, early return zodat verdere logica niet onnodig wordt uigevoerd 
                return;
            }
            $_SESSION['cart'][$_POST['movie_id']] = array(
                'movie' => $movie,
                'quantity' => 0
            );
        }
        // als de film al in de winkelmand zit, zal de waarde met 1 verhogen 
        $_SESSION['cart'][$_POST['movie_id']]['quantity']++;
    }

    private function _handleRemove() {
        // de waarde van $_POST['remove'] is een movie_id 
        // deze verwijdere uit de sessie variabele indien deze bestaat 
        if (isset($_SESSION['cart'][$_POST['remove']])) {
            unset($_SESSION['cart'][$_POST['remove']]);
        }
    }
}