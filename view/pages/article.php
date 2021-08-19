<main class="container">
    <div class="top__links top__article">
        <div class="blog__back">
            <a class="button__link button__white" href="index.php?page=blog&filter=">Back to overview</a>
        </div>
    </div>

    <section class="article">
        <?php if (empty($article)) : ?>
            <p class="error">This article doens't exist</p>
        <?php else : ?>
            <div class="article__information">
                <h3 class="subtitle article__subtitle"> <?php echo $article['title']; ?></h3>
                <p class="movie__year article__user">By <?php echo $article['username']; ?></p>
            </div>

            <div class="article__overview">
                <div class="image__overview">
                    <div class="detail__socials">
                        <img class="socials" src="assets/img/png/socials.png" alt="social-media-icons" width="60" height="20">
                    </div>
                    <img class="image__detail" src="<?php echo $article['path']; ?>" alt=" blog-image" width="400" height="500">
                    <a class="button__link link--red" href="index.php?page=gallery&sort=">See the result</a>
                </div>
                <div class="overview__extra article__steps">
                    <div class="overview__left">
                        <h4 class="steps">Step 01</h4>
                        <p class="paragraph steps__content"><?php echo $article['stepone']; ?></p>
                        <h4 class="steps">Step 02</h4>
                        <p class="paragraph steps__content"><?php echo $article['steptwo']; ?></p>
                        <h4 class="steps">Step 03</h4>
                        <p class="paragraph steps__content"><?php echo $article['stepthree']; ?></p>
                    </div>

                </div>
            </div>
    </section>

    <section class="related">
        <div class="related__articles">
            <h4 class="subtitle">Related Articles</h4>
            <ul class="articles__list">
                <?php foreach ($blogs as $blog) : ?>
                    <li class="blog__item">
                        <img class="blog__image" src="assets/img/looks/tag0<?php echo $blog['tag_id']; ?>.png" alt="blog-image" width="170" height="130">
                        <div class="blog__information">
                            <h4 class="blog__title"><?php echo $blog['title']; ?></h4>
                            <p class="blog__user"><?php echo $blog['username']; ?></p>
                            <p class="blog__intro"><?php echo $blog['introduction']; ?></p>
                        </div>
                        <a class="button__yellow button__link" href="index.php?page=article&id=<?php echo $blog['id']; ?>">Learn More</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="related__looks">
            <h4 class="subtitle subtitle__looks">HOLLYLOOKS Inspired by</h4>
            <ul class="looks__list">
                <?php foreach ($looks as $look) : ?>
                    <li class="look__item">
                        <a href="index.php?page=gallery&sort=">
                            <img class="look__image" src="<?php echo $look['path']; ?>" alt="blog-image" width="200" height="300"></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
<?php endif; ?>
</main>