<main class="container">
    <section class="navigation">
        <h3 class="hidden">Blog</h3>

        <div class="top__links top__article">
            <div class="<?php if (!$_GET['filter']) echo 'hidden'; ?> blog__back">
                <a class="button__link button__white" href="index.php?page=blog&filter=">Back to overview</a>
            </div>
        </div>
        
        <div class="navigation__subjects">
            <?php foreach ($tags as $tag) : ?>
                <div class="subject">
                    <button class="subject__button" name="filter" value="<?php echo $tag['subject']; ?>">
                        <a class="filter__link" href="index.php?page=blog&filter=<?php echo $tag['id']; ?>">
                            <p class="subject--title"><?php echo $tag['subject']; ?></p>
                            <img class="subject--image" src="assets/img/png/square<?php echo $tag['id'] ?>.png" alt="square-glitter" width="220">
                        </a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="blog__overview">
        <ul class="blog__list">
            <?php foreach ($articles as $article) : ?>
                <li class="blog__item">
                    <img class="blog__image" src="<?php echo $article['path']; ?>" alt="blog-image" width="170" height="130">
                    <div class="blog__information">
                        <h4 class="blog__title"><?php echo $article['title']; ?></h4>
                        <p class="blog__user"><?php echo $article['username']; ?></p>
                        <p class="blog__intro"><?php echo $article['introduction']; ?></p>
                    </div>
                    <a class="button__yellow button__link" href="index.php?page=article&id=<?php echo $article['id']; ?>">Learn More</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>