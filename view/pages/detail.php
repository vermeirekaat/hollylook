<main class="container">
    <section class="detail">
        <h3 class="hidden">Image - Detail</h3>
        <div class="top__links">
            <div class="detail__back">
                <a class="button__link button__white" href="index.php?page=gallery&sort=">Back to gallery</a>
            </div>
            <div class="button__detail">
                <a class="button__link link--red" href="index.php?page=blog&filter=<?php echo $tag['id']; ?>">I created this look with <?php echo $tag['subject']; ?></a>
            </div>
        </div>


        <article class="detail__image">
            <?php if (empty($image)) : ?>
                <p class="error">This HOLLYLOOK doesn't exist</p>
            <?php else : ?>

                <div class="image__overview">
                    <div class="detail__socials">
                        <img class="socials" src="assets/img/png/socials.png" alt="social-media-icons" width="60" height="20">
                    </div>
                    <img class="image__detail" src="<?php echo $image['path']; ?>" alt="hollylook" width="400" height="500">
                    <div class="image__user">
                        <p class="paragraph">HOLLYLOOK by <?php echo $image['username']; ?></p>
                        <?php if ($averageRating['average'] == 5) : ?>
                            <a href="index.php?page=fame"><img class="fame-star" src="assets/img/svg/star.svg" alt="star-glitter" width="50"></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="image__text">
                    <div class="text__container">
                        <h3 class="movie__title"><?php echo $image['movie']; ?> - <?php echo $image['year']; ?></h3>
                        <h4 class="movie__character"><?php echo $image['character']; ?></h4>
                        <p class="movie__story"><?php echo $image['description'] ?></p>
                    </div>
                    <div class="image__rating">
                        <div class="rating__amount">
                            <p class="paragraph rating">Rating - <span><?php echo $averageRating['average']; ?></span></p>
                        </div>

                        <div class="rating__stars">
                            <img class="rating__img" src="assets/img/svg/star.svg" alt="stars-rate" width="100">
                            <img class="rating__img" src="assets/img/svg/star.svg" alt="stars-rate" width="100">
                            <img class="rating__img" src="assets/img/svg/star.svg" alt="stars-rate" width="100">
                            <img class="rating__img" src="assets/img/svg/star.svg" alt="stars-rate" width="100">
                            <img class="rating__img" src="assets/img/svg/star.svg" alt="stars-rate" width="100">
                        </div>

                        <form class="rating__form" method="post" action="index.php?page=detail&id=<?php echo $image['id']; ?>">
                            <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                            <input type="hidden" name="action" value="insertRating">

                            <div class="form__field">
                                <input class="form__rate" type="range" name="rating" min="0" max="5" step="1">
                            </div>
                            <div>
                                <input class="button__submit button__link link--red form-button" type="submit" name="button" value="Rate">
                            </div>
                        </form>

                    </div>

                </div>
        </article>

    </section>

    <section class="comments">
        <h3 class="hidden">Image - Comments</h3>
        <article class="comments__overview">
            <h4 class="subtitle">Comments</h4>
            <ul class="comments__list">
                <?php foreach ($comments as $comment) : ?>
                    <li class="comments__item">
                        <p class="comments__comment"><?php echo $comment['comment']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </article>

        <div class="opinion">
            <p class="subtitle">What do you think of this HOLLYLOOK?</p>
            <form class="form__comments" method="post" action="index.php?page=detail&id=<?php echo $image['id']; ?>">
                <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                <input type="hidden" name="username" value="<?php echo $image['username'] ?>">
                <input type="hidden" name="movie" value="<?php echo $image['movie'] ?>">
                <input type="hidden" name="year" value="<?php echo $image['year'] ?>">
                <input type="hidden" name="character" value="<?php echo $image['character'] ?>">
                <input type="hidden" name="description" value="<?php echo $image['description'] ?>">
                <input type="hidden" name="path" value="<?php echo $image['path'] ?>">
                <input type="hidden" name="action" value="insertComment">
                <div class="form__field">
                    <span class="error"><?php if (!empty($errors['comment'])) {
                                            echo $errors['comment'];
                                        } ?></span>
                    <textarea name="comment" cols="30" rows="10" placeholder="Comment"></textarea>
                </div>
                <div class="form__field">
                    <input class="button__submit button__link link--red" type="submit" name="button" value="Add Comment">
                </div>
            </form>
        </div>

    </section>

<?php endif; ?>
</main>