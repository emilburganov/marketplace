const isAuthenticated = localStorage.getItem('isAuthenticated')
                        ?? JSON.parse(localStorage.getItem('isAuthenticated'));

if (isAuthenticated) {
    const userDropdown = document.querySelector('.header__dropdown');
    const userButton = document.querySelector('.header__user');
    const userDropdownButton = document.querySelectorAll('.header__dropdown > button');

    userButton?.addEventListener('click', () => {
        userDropdown.classList.toggle('active');
    });

    userDropdownButton?.forEach(button => {
        button.addEventListener('click', () => {
            userDropdown.classList.remove('active');
        });
    });
}
