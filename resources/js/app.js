require('./bootstrap');

import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function(){
        if(document.querySelector('#imagen').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234; // la imagen debe tener un size y un name
            imagenPublicada.name = document.querySelector('#imagen').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});


dropzone.on('success', function(file, response){
    document.querySelector('#imagen').value = response.imagen;
});

dropzone.on('removedfile', function(){
    document.querySelector('#imagen').value = '';
});