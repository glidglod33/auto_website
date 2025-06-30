const accountImage = document.querySelector('.account img');
if (accountImage) {
    accountImage.addEventListener('click', function () {
        const account = this.closest('.account');
        account.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        const account = document.querySelector('.account');
        if (account && !account.contains(e.target)) {
            account.classList.remove('active');
        }
    });
}

const openLoginModalBtn = document.getElementById('openLoginModal');
if (openLoginModalBtn) {
    openLoginModalBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.remove('hidden');
    });
}

const modalClose = document.querySelector('.modal-close');
if (modalClose) {
    modalClose.addEventListener('click', function () {
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.add('hidden');
    });
}

const modal = document.getElementById('loginModal');
if (modal) {
    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
}

// hulp formulier 
const openHelpModalBtn = document.getElementById('openHelpModal');
if (openHelpModalBtn) {
    openHelpModalBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const helpModal = document.getElementById('helpModal');
        if (helpModal) helpModal.classList.remove('hidden');
    });
}

const helpModal = document.getElementById('helpModal');
if (helpModal) {
    const closeBtn = helpModal.querySelector('.modal-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            helpModal.classList.add('hidden');
        });
    }
    helpModal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
}
