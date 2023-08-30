import {Toast} from 'bootstrap';
// import Chart from 'chart.js/auto';

const copyToast  = new Toast('#copyToast',{
    autohide: true,
    delay: 2000
})

const listItems = document.querySelectorAll('.list-group-item');
const actions = document.querySelector('#actions');

const btnCopy = document.querySelector('#btnCopy');
const btnStatistic = document.querySelector('#btnStatistic');
const btnDelete = document.querySelector('#btnDelete');
let data;

const URL_DELETE = '/ajax/delete';
const URL_STATISTIC_AJAX = '/ajax/statistic';
const URL_STATISTIC = '/statistic';
const URL_HOME = '/';

let hash = null;
let selectedItem = null;


listItems.forEach(item => {
    item.addEventListener('click', function() {
       if(selectedItem === this)
       {
            selectedItem = null;
            hash = null;
            this.classList.remove('active');
            toggleButtonsInteraction(true);
            return;
       }

       listItems.forEach(item => 
            item.classList.remove('active')
       )
       
        selectedItem = this;
       
        selectedItem.classList.add('active');
        hash = selectedItem.dataset.hash;

        toggleButtonsInteraction();
    })
})

btnCopy.addEventListener('click', function(){
    const link = document.querySelector(`#anchor_${hash}`);

    navigator.clipboard.writeText(link.href).then(() => {
        copyToast.show()
    });
})

btnStatistic.addEventListener('click', async () => {

    const request = await fetch(`/ajax/statistic/${hash}`);

    if(!request.ok)
    {
        throw new Error('Impossible de contacter cette url')
    }

    let response  = await request.json()
   
    switch(response.msg){
        case 'ECHEC' :
            window.open(`${URL_STATISTIC_AJAX}`)
        break;
            
        case 'SUCCESS' :
            data = response.data
           
            window.open(`${URL_STATISTIC}/${hash}`);
        break;
    }
    
})

btnDelete.onclick = async (e) => {
    e.preventDefault()

    try {
        let request = await fetch(`${URL_DELETE}/${hash}`);
       
        if(!request.ok)
        {
            throw new Error('Invalid request.This url does not exist');
        }

        const contentType = request.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const response = await request.json();
            handleData(response)
         
        } 
    } catch (error) {
        console.error('An error occurred:', error);
    }
}

const toggleButtonsInteraction = function(isDisabled = false)
{
    Array.from(actions.children).forEach(button => {
        button.disabled = isDisabled;
    })
}

const handleData = function(data){

    switch(data.statusCode){

        case 'DELETE_SUCCESSFULLY':
         selectedItem.remove()
        break;
    }
}
       