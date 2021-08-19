<?php

class Controller {

  public $route;
  protected $viewVars = array();

  public function filter() {
    // maak een nieuwe, lege session variabele aan als deze nog niet zou bestaan 
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }

    call_user_func(array($this, $this->route['action']));
  }

  public function render() {
    // deze logica wordt uitgevoerd op alle pagina's, vlak voor het renderen van de view 
    $numPurchase = 0; 
    foreach($_SESSION['cart'] as $items) {
      $numPurchase += $items['quantity'];
    }
    $this->set('numPurchase', $numPurchase);
    // einde logica

    $this->createViewVarWithContent();
    $this->renderInLayout();
  }

  public function set($variableName, $value) {
    $this->viewVars[$variableName] = $value;
  }

  private function createViewVarWithContent() {
    extract($this->viewVars, EXTR_OVERWRITE);
    ob_start();
    require __DIR__ . '/../view/' . strtolower($this->route['controller']) . '/' . $this->route['action'] . '.php';
    $content = ob_get_clean();
    $this->set('content', $content);
  }

  private function renderInLayout() {
    extract($this->viewVars, EXTR_OVERWRITE);
    include __DIR__ . '/../view/layout.php';

    if (!empty($_SESSION['info'])) {
      unset($_SESSION['info']);
    }
    if (!empty($_SESSION['error'])) {
      unset($_SESSION['error']);
    }
  }

}
