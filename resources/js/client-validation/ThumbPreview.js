// --------- Thumb Preview -------- //

console.log('prova')

// --------- Thumb Preview -------- //


    // Rimuovo la classe p-3
    let thumbWrapper = document.querySelector('.thumb-wrapper')
    thumbWrapper.classList.remove('p-3')
        
    function previewThumb(event) {
        // Ottiene l'elemento che ha scatenato l'evento (input file)
        let input = event.target;
        console.log(input);

        let preview = document.getElementById('thumb-preview');
        console.log(preview);
    
        // Verifica se sono stati selezionati dei file nell'input file
        if (input.files && input.files[0]) {
            // Se ci sono file selezionati, crea un nuovo oggetto FileReader
            let reader = new FileReader();
    
            // Definisce cosa fare quando il FileReader ha completato la lettura del file
            reader.onload = function (e) {
                // Imposta l'URL del file come sorgente dell'elemento anteprima
                preview.src = e.target.result;

                preview.style.display = 'block';
            }
    
            // Avvia la lettura del file come URL dati
            reader.readAsDataURL(input.files[0]);

            // Aggiungo la classe p-3 dopo l'aggiunta della thumb-preview
            thumbWrapper.classList.add('p-3')

        }
    }

       