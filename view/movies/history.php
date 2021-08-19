<main class="container">
    <section class="headerimage">
        <div class="headerimage__grid">
            <div class="headerimage__image">
                <img class="headerimage--rainbowbuilding rainbow" src="assets/img/svg/circle.svg" alt="rainbow-glitter" height="250">
                <img class="headerimage--building" src="assets/img/png/building.png" alt="hollywood-sign" width="686" height="636">
            </div>

            <h2 class="hidden">New Hollywood</h2>
                <div class="headerimage__title title--history">
                    <p class="title--first">New Hollywood,</p>
                    <p class="title--second">the start with a</p>
                    <p class="title--third">sparkle</p>
                </div>
        </div>
    </section>
    <section class="content">
        <div class="content__left">
            <h3 class="subtitle">How it started</h3>
            <p class="paragraph">Thanks to the movie <span>Bonnie & Clyde</span> (1967), we use the name New Hollywood to refer to the movie-industry during the seventies.</p>
            <p class="paragraph">Other topics were integrated within the storyline; such as <span>violence, sex and nudity</span>. This was a huge change in regard to the previous period called the 'Golden Age'.</p>
            <p class="paragraph">Movies attracted a new public; youngsters that wanted an <span>escape from reality</span>. This hasn't changed much over time because you sometimes need to pause your daily live to come up for some fresh air.</p>
            <p class="paragraph"><span>HOLLYLOOK</span> gives you the opportunity to go back and relive the 70s livestyle you see in the New Hollywood movies.</p>
            <p class="paragraph">Grab this opportunity and you may end up with the stars on the <span>Scroll of Fame</span>.</p>
            <div class="buttons">
                <a class="button__link link--white" href="index.php?page=create">Start creating</a>
                <a class="button__link link--red" href="index.php?page=fame">Discover the stars</a>
            </div>
        </div>

        <div class="content__right--history">
            <img class="history__image" src="assets/img/png/bonnie.png" alt="bonnie-and-clyde" width="683" height="1000">
        </div>
        <img class="pattern--history" src="assets/img/png/flower-rect.png" alt="pattern-flowers-background" width="892" height="1140">
    </section>

    <section class="shop" id="shop">
        <h3 class="subtitle--center">The ultimate New Hollywood experience</h3>
        <div class="shop__introduction">
            <img class="theatre--image" src="assets/img/png/theatre.png" alt="theatre-neon-light" width="609" height="769">
            <div class="introduction__text">
                <p class="paragraph paragraph--right">Discover the legendary movies that were made in <span>New Hollywood</span>. Get your favourite 70s movie and go back in time with these <span>tape cassettes</span>. Grab this opportunity to escape from reality.</p>
                <p class="paragraph paragraph--right">Maybe, you will get some <span>inspiration</span> for your next HOLLYLOOK while watching...</p>
            </div>
        </div>


        <form class="checkout shop__cart--overview" method="post" action="index.php?page=history#shop">
            <p class="shop__cart">Shopping Cart (<span><?php echo $numPurchase; ?></span>)</p>
            <?php foreach ($_SESSION['cart'] as $item) : ?>
                <p class="shop__item"><?php echo $item['movie']['title'] ?> - <?php echo $item['quantity'] ?>
                    <button class="button--remove" type="submit" name="remove" value="<?php echo $item['movie']['id'] ?>">&#10005;</button>
                </p>
            <?php endforeach; ?>
            <p class="shop__item shop__price">
                <?php if (!empty($_SESSION['cart'])) : ?>
                    <span>&#10095;</span> Total Price - € <?php echo $item['movie']['price'] * count($_SESSION['cart']); ?>

            </p>
            <div class="checkout__button">
                <button class="button__yellow" type="submit" name="action" value="empty">Empty shopping cart</button>
            </div>
        <?php endif; ?>
        </form>

        <ul class="shop__overview">
            <?php foreach ($movies as $movie) : ?>
                <li class="movie__item">
                    <img class="movie__poster" src="<?php echo $movie['path'] ?>" alt="movie-poster" width="250" height="300">
                    <div class="movie__information">
                        <h4 class="movie__title"><?php echo $movie['title'] ?></h4>
                        <p class="movie__year"><?php echo $movie['year'] ?></p>
                        <p class="movie__price">€ <?php echo $movie['price'] ?></p>
                    </div>
                    <form class="movie__purchase" method="post" action="index.php?page=history">
                        <input type="hidden" name="movie_id" value="<?php echo $movie['id'] ?>">
                        <button class="movie__buy" type="submit" name="action" value="add">Buy</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="button__shop">
            <a class="button__link link--red" href="index.php?page=fame">Meet the Hollylook stars</a>
        </div>

    </section>

</main>