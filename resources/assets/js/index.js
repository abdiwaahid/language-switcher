const trigger = document.querySelector('.language-switcher-dropdown-trigger');
const content = document.querySelector('.language-switcher-dropdown-content');

trigger.addEventListener('click', () => {
    content.classList.toggle('hidden');
});

content.addEventListener('click', (event) => {
    event.stopPropagation();
});

document.addEventListener('click', (event) => {
    if (!trigger.contains(event.target) && !content.contains(event.target)) {
        content.classList.add('hidden');
    }
});