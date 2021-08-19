<main class="container">
    <section class="gallery">
        <h3 class="hidden">Gallery</h3>

        <form class="gallery__filter" action="index.php?page=gallery&sort=" method="get">
            <label class="button__white">
                <input class="filter-sort" type="radio" name="sort" value="recent">Most Recent
            </label>

            <label class="button__white">
                <input class="filter-sort" type="radio" name="sort" value="popular">Most Popular
            </label>

        </form>

        <div class="gallery__overview">
            <ul class="gallery__grid">
                <?php foreach ($images as $image) : ?>
                    <li class="list__item">
                        <a href="index.php?page=detail&id=<?php echo $image['id']; ?>">
                            <img class="grid__image" src="<?php echo $image['path']; ?>" alt="hollylook" width="300" height="400">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <form class="gallery__filter <?php if ($_GET['sort'] == 'total' || 'sort' || 'popular') echo 'hidden';?>" method="get" action="index.php?page=gallery">
            <label class="button__white">
                <input class="filter-sort" type="radio" name="sort" value="total">Load More
            </label>
        </form>

        <div class="buttons">
            <a class="button__link link--white" href="index.php?page=fame">Meet the hollylook stars</a>
            <a class="button__link link--red" href="index.php?page=create">Create your own</a>
        </div>
    </section>

    <section class="introduction__blog">
        <div class="content__left">
            <h3 class="subtitle">How do you create?</h3>
            <div class="link__blog">
                <p class="paragraph">Recreating a fabulous look from the seventies is not an easy task. Read all about the <span>tips and tricks</span> from Photoshop to mak-up and learn new techniques.</p>
                <div class="button__blog">
                    <a class="button__link link--red" href="index.php?page=blog&filter=">Get to know more</a>
                </div>

            </div>
        </div>
        <div class="content__right--intro">
            <img class="blog--image" src="assets/img/png/blog.png" alt="three-woman-in-glitter" width="502" height="689">
        </div>
        <img class="pattern--blog" src="assets/img/png/pattern.png" alt="pattern-circles" width="1015" height="760">
    </section>
</main>