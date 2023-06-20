const quote = document.getElementById("quote");
const author = document.getElementById("author");

fetch("https://api.quotable.io/random")
    .then((response) => {
        if (response.ok) {
            return response.json();
        } else {
            return Promise.reject({
                status: response.status
            });
        }
    })
    .then((json) => {
        quote.innerHTML = '" ' + json.content + ' "';
        author.innerHTML = '~~ ' + json.author + ' ~~'
    })
    .catch((error) => {
        if (error.status = 404) {
            quote.innerHTML = 'Quote Tidak Di Temukan';
            author.innerHTML = '~~ - ~~'
        }
    })