<main class="container">
    <section class="headerimage">
        <div class="headerimage__grid">
            <div class="headerimage__image">
                <img class="headerimage--rainbowholly rainbow" src="assets/img/svg/circle.svg" alt="rainbow-glitter" height="250">
                <img class="headerimage--hollywood" src="assets/img/png/hollywood.png" alt="hollywood-sign" width="1260" height="1080">
                <img class="headerimage--grease" src="assets/img/png/grease.png" alt="grease" width="1260" height="1080">
            </div>

            <h2 class="hidden"> Become the star from the 70s</h2>

                <div class="headerimage__title title--home">
                    <p class="title--first">Become the star</p>
                    <p class="title--second">from the 70s</p>
                </div>

        </div>
    </section>

    <section class="content">
        <div class="content__left">
            <h3 class="subtitle">Back to 1970</h3>
            <p class="paragraph">The seventies were a time of colourfull fashion, rockmusic and upcoming blockbusters.</p>
            <p class="paragraph">The epicentre of all the glitter and glamour was Hollywood. The place were all your dreams come true, so they say...</p>
            <p class="paragraph">Travel back in time, to the wonderful world of <span>New Hollywood</span> and recreate the legends.</p>
            <p class="paragraph">Strive for the ultimate recognition and redeem a star on the digital Walk of Fame</p>
            <div class="buttons">
                <a class="button__link link--red" href="index.php?page=history">Learn more</a>
            </div>

        </div>

        <div class="content__right--intro">
            <img class="intro__image" src="assets/img/png/history.png" alt="two-people" width="840" height="870">
        </div>
        <img class="pattern--intro" src="assets/img/png/flower-square.png" alt="pattern-flowers-background">
    </section>

    <section class="overview">
        <div class="overview__right">
            <h3 class="subtitle">Get to work</h3>
            <div class="portrait">
                <img class="portrait__image" src="assets/img/png/work.png" alt="girl-with-sunglasses" width="465" height="540">
            </div>
        </div>

        <div class="overview__extra">
            <div class="overview__left">
                <h4 class="steps">Step 01</h4>
                <p class="paragraph steps__content">Determine your favorite <span>70s movie</span> and choose the most memorable character</p>
                <h4 class="steps">Step 02</h4>
                <p class="paragraph steps__content">Recreate the look by using your <span>creativity</span></p>
                <h4 class="steps">Step 03</h4>
                <p class="paragraph steps__content">Upload your result on <span>HOLLYLOOK</span></p>
            </div>
            <div class="buttons">
                <a class="button__link link--white" href="index.php?page=create">Get creative</a>
                <a class="button__link link--red" href="index.php?page=gallery&sort=">Browse some looks</a>
            </div>
        </div>
    </section>

    <section class="feature">
        <h4 class="subtitle--center">Featured looks</h4>
        <div class="looks">
            <?php foreach ($threeImages as $threeImage) : ?>
                <a class="hollylook" href="index.php?page=detail&id=<?php echo $threeImage['id'] ?>">
                    <img class="hollylook__image" src="<?php echo $threeImage['path']; ?>" alt="hollylook" width="300" height="400">
                </a>
            <?php endforeach; ?>
        </div>
        <div class="buttons">
            <a class="button__link link--white" href="index.php?page=create">Create your own hollylook</a>
            <a class="button__link link--red" href="index.php?page=gallery&sort=">Explore more</a>
        </div>

    </section>
</main>