//recupero gli input
const emailInput = document.getElementById('email');
const passInput = document.getElementById('password');

//recupero il pulsante e il form
const subBtn = document.getElementById('invia');
const formDomEl = document.getElementById('formEl');

//messaggi di errore email
const emailErrors = [
    'Email richiesta senza caratteri maiuscoli',
    'La email non contiene la @',
    'La email non ha un dominio',
    'La email non rispetta il formato corretto'
];

//messaggi di errore password
const passErrors = [
    'La password deve essere almeno 8 caratteri'
];

//messaggio di errore
const errorEmail = document.createElement('span');
const errorPassword = document.createElement('span');

//messaggio di errore email con timeout
function showErrorAndHideAfterTimeoutEmail(errorSpan, errorArr, input, n) {
    errorSpan.innerHTML = errorArr[n];
    errorSpan.style.display = 'block';
    errorSpan.style.color = 'red';
    input.after(errorSpan);

    setTimeout(function() {
        errorSpan.style.display = 'none';
    }, 8000);
}

//funzioni di verifica
function emailError() {
    const domainRegex = /@([^.]+)\./i;
    const domain2Regex = /\.([^.]+)$/i;
    const uppercaseRegex = /^[^A-Z]*$/;
    const email = emailInput.value.trim();

    if(!uppercaseRegex.test(email)) {
        showErrorAndHideAfterTimeoutEmail(errorEmail, emailErrors, emailInput, 0);
        return false;
    } else if(!email.includes('@')) {
        showErrorAndHideAfterTimeoutEmail(errorEmail, emailErrors, emailInput, 1);
        return false;
    } else if (!domainRegex.test(email)) {
        showErrorAndHideAfterTimeoutEmail(errorEmail, emailErrors, emailInput, 2);
        return false;
    } else if (!domain2Regex.test(email)) {
        showErrorAndHideAfterTimeoutEmail(errorEmail, emailErrors, emailInput, 3);
        return false;
    }
    return true;
}

function passwordError() {
    const pass = passInput.value.trim();

    if(pass.length < 7) {
        showErrorAndHideAfterTimeoutEmail(errorPassword, passErrors, passInput, 0);
        return false;
    }
    return true;
}

//click sul pulsante sumbit
subBtn.addEventListener('click', function (e) {
    e.preventDefault();

    if(emailError() && passwordError()) {
        formDomEl.submit();
    }
})
