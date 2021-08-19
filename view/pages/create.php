<main class="container">
    <section class="headerimage">
        <div class="headerimage__image">
            <img class="headerimage--rainbowcreate rainbow" src="assets/img/svg/circle.svg" alt="circle-glitter" width="200">
            <img class="headerimage--create" src="assets/img/png/form.png" alt="building" width="609" height="769">
        </div>

        <h2 class="hidden">Create your own</h2>
            <div class="title--create">
                <p class="headerimage__title">Share your story,</p>
                <p class="headerimage__title">inspire others</p>
            </div>
    </section>

    <section class="create__form">
        <h3 class="hidden">Create your own</h3>
        <article class="create__gallery">
            <h3 class="subtitle">Your HOLLYLOOK</h3>
            <p class="paragraph">You can share your <span>own HOLLYLOOK</span> with the world. Maybe, you'll earn a star on the Scroll of Fame, who knows...</p>

            <form class="form__create--image" method="post" action="index.php?page=create" enctype="multipart/form-data">
                <input type="hidden" name="action" value=uploadImage>

                <div class="form__field">
                    <label class=form__label>Select an image
                        <input class="input" type="file" name="image" accept="image/ png, image/jpeg, image/gif" required>
                        <span class="error"><?php if(!empty($errors['image'])) { echo $errors['image'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Username
                        <input class="input" type="text" name="username" required>
                        <span class="error"><?php if(!empty($erros['username'])) { echo $errors['username'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Movie
                        <input class="input" type="text" name="movie" required>
                        <span class="error"><?php if(!empty($errors['movie'])) { echo $errors['movie'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Year
                        <input class="input" type="text" name="year" required>
                        <span class="error"><?php if(!empty($errors['year'])) { echo $errors['year'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Character
                        <input class="input" type="text" name="character" required>
                        <span class="error"><?php if(!empty($errors['character'])) { echo $errors['character'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Select your subject
                        <select class="input select" name="tag_id">
                            <option value="1">Photoshop</option>
                            <option value="2">Make-Up</option>
                            <option value="3">DIY Fashion</option>
                            <option value="4">Setting</option>
                            <option value="5">Tips & Tricks</option>
                        </select>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Story behind this HOLLYLOOK
                        <textarea class="input textarea" cols="40" rows="10" name="description" required></textarea>
                        <span class="error"><?php if(!empty($errors['description'])) { echo $errors['description'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <input class="button__link link--red" type="submit" name="button" value="Upload">
                </div>
            </form>
        </article>

        <article class="create__blog">
            <h3 class="subtitle ">Your Tips&Tricks</h3>
            <p class="paragraph">Share your <span>process</span> in three steps and help others with creating their 70s look.</p>

            <form class="form__create--blog" method="post" action="index.php?page=create">
                <input type="hidden" name="action" value="uploadArticle">

                <div class="form__field">
                    <label class="form__label"> Username
                        <input class="input" type="text" name="username" required>
                        <span class="error"><?php if(!empty($errors['username'])) { echo $errors['username'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label"> Title
                        <input class="input" type="text" name="title" required>
                        <span class="error"><?php if(!empty($errors['title'])) { echo $errors['title'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Select your subject
                        <select class="input select" name="tag_id" required>
                            <option value="1">Photoshop</option>
                            <option value="2">Make-Up</option>
                            <option value="3">DIY Fashion</option>
                            <option value="4">Setting</option>
                            <option value="5">Tips & Tricks</option>
                        </select>
                    </label>
                </div> 

                <div class="form__field">
                    <label class="form__label">Introduction
                        <textarea class="input textarea" cols="30" rows="5" name="introduction" required></textarea>
                        <span class="error"><?php if(!empty($errors['introduction'])) { echo $errors['introduction'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <label class="form__label">Step 01
                        <textarea class="input textarea" cols="40" rows="10" name="stepone" required></textarea>
                        <span class="error"><?php if(!empty($errors['stepone'])) { echo $errors['stepone'];}?></span>
                    </label>
                </div>
                <div class="form__field">
                    <label class="form__label">Step 02
                        <textarea class="input textarea" cols="40" rows="10" name="steptwo" required></textarea>
                        <span class="error"><?php if(!empty($errors['steptwo'])) { echo $errors['steptwo'];}?></span>
                    </label>
                </div>
                <div class="form__field">
                    <label class="form__label">Step 03
                        <textarea class="input textarea" cols="40" rows="10" name="stepthree" required></textarea>
                        <span class="error"><?php if(!empty($errors['stepthree'])) { echo $errors['stepthree'];}?></span>
                    </label>
                </div>

                <div class="form__field">
                    <input class="button__link link--red" type="submit" name="button" value="Upload">
                </div>
            </form>

        </article>

    </section>
</main>