{
    const formdataToJson = $from => {
        const data = new FormData($from);
        const obj = {}; 
        data.forEach((value, key) => {
            // console.log(key + ' : ' + value);
            obj[key] = value;
        });
        return obj;
    }

    // GALLERY - FILTER 
    const handleClickSort = e => {
        // e.preventDefault();
        const sort = e.currentTarget.value; 
        console.log(sort); 
        const path = window.location.href.split(`&`)[0]; 
        console.log(path); 
        const qs = `&sort=${sort}`; 
        console.log(qs);
        sortGallery(`${path}${qs}`);
    }
    const sortGallery = async url => {
        const response = await fetch(url, {
            headers: new Headers({
                Accept: 'application/json'
            })
        });
        const images = await response.json();
        window.history.pushState({}, ``, url); 
        showImages(images); 
    }

    const showImages = images => {
        const $images = document.querySelector(`.gallery__grid`); 
        $images.innerHTML = ``; 
        images.forEach(image => {
            $images.innerHTML += `<li><a href="index.php?page=detail&id=${image.id}">
                    <img class="grid__image" src="${image.path}" alt="hollylook" width="300" height="400"></a></li>`
        });
    }

    // DETAIL - RATING 
    const handleSubmitRating = e => {
        const $ratingForm = e.currentTarget; 
        e.preventDefault(); 
        postRating($ratingForm.getAttribute('action'),formdataToJson($ratingForm));
    }
    const postRating = async (url, data) => {
        // console.log(url);
        // console.log(data); 
        const response = await fetch(url, {
            method: "POST",
            headers: new Headers({
                'Content-Type': 'application/json'
            }),
            body: JSON.stringify(data)
        });
        const returned = await response.json(); 
       // console.log(returned);
        if (returned.error) {
            // console.log(response.error);
        } else {
            showRating(returned);
        }
    }
    const showRating = rating => {
        const $item = document.querySelector(`.rating__amount`);
        $item.innerHTML = ``
        const $itemText = document.createElement('p');
        $itemText.classList.add(`paragraph`);
        $itemText.innerHTML = `Rating - <span>${rating.rating}</span>`;
        $item.appendChild($itemText);
    };

    // DETAIL - COMMENTS 
    const handleSubmitComments = e => {
        const $commentForm = e.currentTarget; 
        e.preventDefault(); 
        // gegevens v/d form ophalen en deze omzetten naar een json bestand 
        postComment($commentForm.getAttribute('action'), formdataToJson($commentForm));
    }
    // functie dat het formulier zal afhandelen 
    const postComment = async (url, data) => {
        // console.log(url);
        // console.log(data);
        // versturen naar de server met de juiste route, header geeft aan dat de respons iets zal zijn in json formaat 
        // body bevat de data an het form 
        const response = await fetch(url, {
            method: "POST",
            headers: new Headers({
                'Content-Type': 'application/json'
            }),
            body: JSON.stringify(data)
        });
        // vorig onderdeel zal doorgestuurd worden naar PHP (request naar de server) en JS handelt de rest af 
        const returned = await response.json();
        // console.log(returned);
        if (returned.error) {
            console.log(response.error);
        } else {
            showComments(returned);
        }
    }
    // comments opbouwen om deze te tonen 
    const showComments = comments => {
        const $list = document.querySelector(`.comments__list`);
        $list.innerHTML = ``;
        comments.forEach(comment => {
            const $listItem = document.createElement('li');
            $listItem.classList.add(`comments__item`);
            $listItem.innerHTML = `${comment.comment}`;
            $list.appendChild($listItem);
        });
    };

    const init = () => {
        document.documentElement.classList.add('has-js'); 

        // GALLERY - FILTER 
        const $sortList = document.querySelectorAll(`.filter-sort`); 
        if ($sortList) {
            $sortList.forEach(form => {
                form.addEventListener('change', handleClickSort);
            });
        }

        // DETAIL - RATING 
        const $ratingForm = document.querySelector(`.rating__form`);
        if ($ratingForm) {
            $ratingForm.addEventListener(`submit`, handleSubmitRating);
        }
        // DETAIL - COMMENTS 
        const $commentForm = document.querySelector(`.form__comments`);
        // checken of dit form aanwezig is op de pagina 
        if ($commentForm) {
            $commentForm.addEventListener(`submit`, handleSubmitComments);
        }
       
    }
    init();
}