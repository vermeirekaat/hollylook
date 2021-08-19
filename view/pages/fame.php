<main class="container">
    <h2 class="fame">Scroll of Fame</h2>
    <section class="scroll">
    <h3 class="hidden">HOLLYLOOK stars</h3>
        <ul class="scroll__list">
            <?php foreach ($famousUsers as $famousUser) : ?>
                <?php if ($famousUser['average'] == 5) : ?>
                    <li class="scroll__item">
                        <a class="link" href="index.php?page=detail&id=<?php echo $famousUser['id']; ?>"><img class="scroll__image" src="assets/img/svg/star.svg" alt="star-glitter" width="400">
                            <p class="scroll__user"><?php echo $famousUser['username']; ?></p>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </section>

</main>