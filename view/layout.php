<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>HOLLYLOOK - <?php echo $title; ?></title>
</head>

<body>

  <header class="header">
    <h1 class="hidden">HOLLYLOOK</h1>
    <nav class="nav">
      <h2 class="hidden">Navigation</h2>
      <ul class="nav__list">
        <li class="nav__item homepage"><a class="homepage__link" href="index.php">Hollylook</a></li>
        <li class="nav__item <?php if($title == 'History') echo 'nav__item--active';?>"><a class="nav__link" href="index.php?page=history">History</a></li>
        <li class="nav__item <?php if($title == 'Gallery') echo 'nav__item--active';?>"><a class="nav__link" href="index.php?page=gallery&sort=">Gallery</a></li>
        <li class="nav__item <?php if($title == 'Blog') echo 'nav__item--active';?>"><a class="nav__link" href="index.php?page=blog&filter=">Blog</a></li>
        <li class="nav__item <?php if($title == 'Create') echo 'nav__item--active';?>"><a class="nav__link" href="index.php?page=create">Create</a></li>
        <li class="nav__item extrapage <?php if($title == 'Scroll of Fame') echo 'extrapage__active';?>"><a class=" nav__link extrapage__link" href="index.php?page=fame">Scroll of Fame</a></li>
      </ul>
    </nav>
  </header>

  <div><?php if(!empty($_SESSION['info'])):?><p class="info"><?php echo $_SESSION['info'];?></p><?php endif;?></div>


  <?php echo $content; ?>

  <footer class="footer">
    <div class="tagline">
      <p class="tagline-footer">Become the star</p>
      <p class="tagline-footer">from the 70s</p>
    </div>

    <div class="socials">
      <p class="socials__text">#hollylookchallenge</p>
      <img class="socials__img" src="assets/img/png/socials.png" alt="social-media-logo" width="60" height="20">
    </div>
  </footer>

  <script src="js/script.js"></script>
  <script src="js/validate.js"></script>
</body>

</html>