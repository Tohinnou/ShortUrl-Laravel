const btnShortenUrl = document.querySelector('#btnShortenUrl')
const urlInput = document.querySelector('#url')
const form = document.querySelector('form')
const shortenCard = document.querySelector('#shortenCard')

const URL_SHORTEN = form.getAttribute("action")

const errorMessage = {
    'INVALID_ARG_URL': 'Impossible de raccourci ce lien.Url invalide !',
    'MISSING_ARG_URL': 'Veuillez ajouter un lien'
}
form.onsubmit = async (e) => {
    e.preventDefault();

    try {
        let request = await fetch(URL_SHORTEN, {
            method: 'POST',
            body: new FormData(form),
           
        });
        console.log(request);
        if(!request.ok)
        {
            throw new Error('Requête non valide.');
        }

        const contentType = request.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const response = await request.json();
            handleData(response)
         
        } else {
            const responseText = await request.text();
           
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }

}

const handleData = function(data){
    
    if(data.statusCode >= 400){
        return handleError(data)
    }
    
    urlInput.value = data.shortUrl
    btnShortenUrl.innerText = 'Copy'

    btnShortenUrl.addEventListener('click',(e) => {
        e.preventDefault()
        urlInput.select();
        document.execCommand('copy');
        this.innerText = 'Shorten Url';
    },{once: true})
}

const handleError = function(data){
    const div = document.createElement('div');
    div.classList.add('alert','alert-danger','mt-2')
    div.innerText = errorMessage[data.msg];

    shortenCard.after(div);
}