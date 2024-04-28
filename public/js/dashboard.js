window.onload = function() {

    showContent('sushirolls');



    // Voeg event listeners toe aan de producten
    var products = document.querySelectorAll('.product');
    products.forEach(function(product) {
        product.addEventListener('click', function(event) {
            var productName = event.target.getAttribute('data-product-name');
            var productPrice = event.target.getAttribute('data-product-price');
            handleClick(productName, productPrice);
        });
    });

    // Voeg event listeners toe aan de verwijderknoppen
    var removeButtons = document.querySelectorAll(".remove-button");
    removeButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.stopPropagation(); // Voorkom dat het klikken op "Verwijderen" bubbelt naar de white-block
            var productName = event.target.getAttribute("data-product");
            removeProduct(productName);
        });
    });

};

// ShowContent alle categorieen laten zien mits erop word geklikt

function showContent(category) {

    // Verberg alle andere secties
    var allContent = document.querySelectorAll('[id$="Content"]');
    allContent.forEach(function(content) {
        content.style.display = 'none';
    });

    // Toon de juiste sectie op basis van de categorie
    var contentId = category + 'Content';
    var currentContent = document.getElementById(contentId);
    currentContent.style.display = 'block';
    console.log(currentContent.style.display);
    showSavedProducts();
}


// Laat alle producten zien functie.
function displayAllProducts(products) {
    var sushirollsContent = document.getElementById('sushirollsContent');
    sushirollsContent.style.display = 'block'; // Zorg ervoor dat de div zichtbaar is



    // Dit zorgt ervoor dat de producten worden getoond op het scherm met een <ul> ervoor.
    var productHtml = '<ul>';
    products.forEach(function(product) {
        productHtml += '<li>' + product.name + ' - ' + product.price + '</li>';
    });
    productHtml += '</ul>';

    sushirollsContent.innerHTML = productHtml; // Voeg de HTML van de producten toe aan de sushirollsContent-div
}



// Vanaf hier naar beneden word de kassa systeem opgemaakt en gebouwd.
// Voeg event listeners toe aan de verwijderknoppen

var removeButtons = document.querySelectorAll(".remove-button");
removeButtons.forEach(function(button) {
    button.addEventListener("click", function(event) {
        event.stopPropagation(); // Voorkom dat het klikken op "Verwijderen" bubbelt naar de white-block
        var productName = event.target.getAttribute("data-product");
        removeProduct(productName, false); // Geef aan dat de weergave niet moet worden bijgewerkt na het verwijderen
    });
});


// Functie removeProduct om producten te verwijderen
function removeProduct(productName, updateDisplay = true) {
    // Hier krijgen we de opgeslagen producten die zitten in de sessionstorage
    var savedProducts = JSON.parse(sessionStorage.getItem('clickedProducts')) || [];

    // Zoek de naam van het product die in de index functie staat
    var index = savedProducts.findIndex(function(product) {
        return product.name === productName;
    });

    // Als het product is gevonden, verwijder het uit savedProducts
    if (index !== -1) {
        savedProducts.splice(index, 1);
    }

    // Update de 'clickedproducts' in de sessionstorage
    sessionStorage.setItem('clickedProducts', JSON.stringify(savedProducts));

    // Laat de geüpdatete lijst zien met alle producten alleen als updateDisplay true is
    if (updateDisplay) {
        showSavedProducts();
    }
}



function showSavedProducts(productPrice) {
    // Haal de opgeslagen producten op uit de session storage
    var savedProducts = JSON.parse(sessionStorage.getItem('clickedProducts')) || [];

    // Maak de opmaak met html, met de opgeslagen producten en hun aantallen
    var productHtml = "<ul>";
    var product;
    var total = 0; // Variabele voor het berekenen van het totaalbedrag
    for (var index in savedProducts) {
        product = savedProducts[index];
       console.log(product);

            var subtotal = product.Aantal * parseFloat(product.price); // Zorg ervoor dat de prijs een numerieke waarde is
            total += subtotal; // Voeg het subtotaal van dit product toe aan het totaalbedrag
            productHtml += "<li>" + product.name + " (x" + product.Aantal + ") - €" + parseFloat(product.price).toFixed(2) + " per stuk";
            productHtml += "<button class='note-button' data-product='" + product.name + "' >Add Note</button> ";
            productHtml += "<button class='remove-button' data-product='" + product.name + "'>Verwijder</button></li>";

            if (product.note) {
                productHtml += " - Notitie: " + product.note;
            }
            productHtml += " - Subtotaal: €" + subtotal.toFixed(2) + "</li>";



    }
    productHtml += "</ul>";

    // Voeg het totaalbedrag toe aan de HTML
    productHtml += "<p><strong>Totaal: €" + total.toFixed(2) + "</strong></p>";
    productHtml += "<button id='saveButton' data-product='" + "'>Opslaan</button></li>";

    // Voeg de HTML toe aan de white-block div
    var whiteBlock = document.getElementById("white-block");
    if (whiteBlock) {
        whiteBlock.innerHTML = productHtml;

}
    // Voeg event listeners toe aan de notitieknoppen
    var noteButtons = document.querySelectorAll(".note-button");
    noteButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            var productName = event.target.getAttribute("data-product");
            addNote(productName);
        });
    });

    // Voeg event listeners toe aan de verwijderknoppen
    var removeButtons = document.querySelectorAll(".remove-button");
    removeButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            var productName = event.target.getAttribute("data-product");
            removeProduct(productName);
        });
    });
}
function saveOrderToDatabase() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Haal de opgeslagen producten op uit de session storage
    var savedProducts = JSON.parse(sessionStorage.getItem('clickedProducts')) || [];

    var orderRegelID = 1; // Stel de waarde van OrderregelID in
    var orderID = 1; // Stel de waarde van OrderID in

    // Maak een array om de producten voor te bereiden op verzending naar de server
    var productsToSend = [];
    savedProducts.forEach(function(product) {
        productsToSend.push({
            'OrderregelID': orderRegelID, // Standaardwaarde voor OrderregelID
            'OrderID': orderID, // Standaardwaarde voor OrderID
            'ProductNaam': product.name,
            'Prijs': product.price,
            'Aantal': product.Aantal,
            'Subtotaal': product.Aantal * product.price
        });
    });

    // Haal de CSRF-token op uit de meta-tag
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Voorbeeldverzoek met datobject
    var postData = {
        'products': productsToSend,
        'csrfToken': csrfToken
    };
    var postDataJson = JSON.stringify(postData);
    var afterPosted = function(data) {
        alert(data.message);
        console.log(data);
    }
    postAjax('/orderline', postDataJson, afterPosted);
}

function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
        function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }
    ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState > 3 && xhr.status == 200) {
            success(xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Voeg de CSRF-token toe als header
    xhr.send(params);
    return xhr;
}


// Functie handleClick als je klikt op een product
function handleClick(productName, productPrice) {

    console.log(productName);
    // Maak een object genaamd products met de naam en prijs die wordt meegegeven.
    var product = {
        name: productName,
        price: productPrice
    };

    // Haal de opgeslagen producten op uit de sessionstorage
    var savedProducts = JSON.parse(sessionStorage.getItem('clickedProducts')) || [];
console.log(savedProducts);
    var bExisted = false;
    for(let i = 0; i < savedProducts.length; i++){
        if(savedProducts[i]['name'] == productName)
        {
            console.log('update');
            bExisted = true;
            savedProducts[i]['Aantal'] = savedProducts[i]['Aantal'] + 1;
        }
    }

    if(!bExisted)
    {
        console.log('add');
        product['Aantal'] = 1;
        // Voeg het product toe aan de lijst met opgeslagen producten
        savedProducts.push(product);
    }
    // Update de 'clickedproducts' in de sessionstorage
    sessionStorage.setItem('clickedProducts', JSON.stringify(savedProducts));

    // Laat de opgeslagen producten zien na de klik.
    showSavedProducts(productPrice);
    saveOrderToDatabase();
    return false;
}



// Functie om notities toe te voegen aan een product
function addNote(productName) {
    var note = prompt('Voeg een notitie toe:');
    if (note !== null && note !== '') {
        console.log("1", productName, "Wilt :", note); // Log de toegevoegde notitie
        var savedProducts = JSON.parse(sessionStorage.getItem('clickedProducts')) || [];
        var existingProduct = savedProducts.find(function(p) {
            return p.name === productName;
        });
        if (existingProduct) {
            existingProduct.note = note;
            sessionStorage.setItem('clickedProducts', JSON.stringify(savedProducts));
            showSavedProducts();
        }
    }
}


// Roep showSavedProducts op als de pagina herlaad.
showSavedProducts();

