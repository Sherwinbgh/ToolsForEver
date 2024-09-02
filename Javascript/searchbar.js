let input = document.getElementById('searchbar');
let prodechtContineer = document.getElementById('prodechtContineer');

let debounceTimer;
input.addEventListener('input', function() {
    fetch('../PHP/searc.php', {
        method: 'POST',
        body: JSON.stringify({ search: input.value }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => { 
        let prodechten = data;
        prodechtContineer.innerHTML = '';
        prodechten.forEach(prodecht => {
        fetch('../PHP/prodecht.php' , {
            method: 'POST',
            body: JSON.stringify({ prodecht: prodecht }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.text();
        })
        .then(data => {
            prodechtContineer.innerHTML += data;
        })
        })
    })
    .catch(error => {
        console.error('Error:', error);
    });
});