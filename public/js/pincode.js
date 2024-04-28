
$(function() {
	$( "#PINcode" ).draggable();
});
// Haal de knop op
const pinCodeButton = document.getElementById('pinCodeButton');


    // Maak de overlay aan
// Voeg een eventlistener toe aan de knop om de pop-up te openen
function showKeypad() {
        /*
        // Maak de overlay aan
        const overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        overlay.style.zIndex = '9999';
        document.body.appendChild(overlay);
        */

    $( "#PINcode" ).html(

            "<input id='PINbox' type='password' value='' name='pin_code' readonly />" +
            "<br/>" +
            "<input type='button' class='PINbutton' name='1' value='1' id='1' onClick=addNumber(this); />" +
            "<input type='button' class='PINbutton' name='2' value='2' id='2' onClick=addNumber(this); />" +
            "<input type='button' class='PINbutton' name='3' value='3' id='3' onClick=addNumber(this); />" +
            "<br>" +
            "<input type='button' class='PINbutton' name='4' value='4' id='4' onClick=addNumber(this); />" +
            "<input type='button' class='PINbutton' name='5' value='5' id='5' onClick=addNumber(this); />" +
            "<input type='button' class='PINbutton' name='6' value='6' id='6' onClick=addNumber(this); />" +
            "<br>" +
            "<input type='button' class='PINbutton' name='7' value='7' id='7' onClick=addNumber(this); />" +
            "<input type='button' class='PINbutton' name='8' value='8' id='8' onClick=addNumber(this); />" +
            "<input type='button' class='PINbutton' name='9' value='9' id='9' onClick=addNumber(this); />" +
            "<br>" +
            "<input type='button' class='PINbutton clear' name='-' value='clear' id='-' onClick=clearForm(this); />" +
            "<input type='button' class='PINbutton' name='0' value='0' id='0' onClick=addNumber(this); />" +
            "<input type='submit' class='PINbutton enter' name='+' value='enter' id='+' />" 
    );
}
showKeypad();


function addNumber(e){
	//document.getElementById('PINbox').value = document.getElementById('PINbox').value+element.value;
	var v = $( "#PINbox" ).val();
	$( "#PINbox" ).val( v + e.value );
}

function clearForm(e){
	//document.getElementById('PINbox').value = "";
	$( "#PINbox" ).val( "" );
}

document.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Voorkom standaard gedrag van de Enter toets
        submitForm(document.getElementById('PINbox'));
    }
});

/*
function submitForm(e) {
  
    if (e.value == "") {
        alert("Voer een PIN in");
    } else {
        var data = {
            pin: e.value,
            _token: window.csrfToken // Gebruik de CSRF-token
        };

        
        // Voer een AJAX POST-verzoek uit naar het Laravel loginWithPin API-eindpunt
        $.ajax({
            url: '/loginpin', // Controleer of deze URL overeenkomt met de juiste route in je Laravel backend
            type: 'POST',
            data: data,
            dataType: 'json', // Verwacht JSON-antwoord van de server
            success: function(response) {
                if (response.success) {
                    window.location.href = '/dashboard'; // Stuur de gebruiker naar het dashboard bij succesvol inloggen
                } else {
                    alert("Ongeldige pincode"); // Toon een foutmelding bij een ongeldige pincode
                }
				co
            },
            error: function(xhr, status, error) {
                // Behandel eventuele fouten bij de API-aanroep
            }
        });

        $( "#PINbox" ).val( "" ); // Leeg het PIN-veld
    
    }
}
*/

