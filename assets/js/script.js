const nome = document.querySelector('input[name="nome"]');
const email = document.querySelector('input[name="email"]');
const tel = document.querySelector('input[name="telefone"]');

tel.addEventListener('input', maskTel);

function maskTel(){
    if(tel.value.length === 2) tel.value = `(${tel.value}) `;
    if(tel.value.length === 9) tel.value += '-';
    if(tel.value.length === 15){
        tel.value = tel.value.substring(0, 9)+''+tel.value.substring(10,11)+'-'+tel.value.substring(11);
    }
}