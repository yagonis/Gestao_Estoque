const button = document.getElementById('MovementButton');
const form = document.getElementById('MovementForm');

if(button && form) {
    button.addEventListener('click', ()=> {
        form.classList.toggle('hidden');

        form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
}
