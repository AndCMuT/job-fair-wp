document.addEventListener('DOMContentLoaded', () => {
    const openButtons = document.querySelectorAll('.apply-btn');
    const modalOverlay = document.querySelector('.modal-overlay');
    const modalClose = document.querySelector('.modal-close');


    if (!modalOverlay) return;

    function openModal() {
        modalOverlay.classList.add('is-open');
        modalOverlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    }

    function closeModal() {
        modalOverlay.classList.remove('is-open');
        modalOverlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    openButtons.forEach(button => {
        button.addEventListener('click', openModal);
    });

    modalClose.addEventListener('click', closeModal);

    modalOverlay.addEventListener('click', (event) => {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modalOverlay.classList.contains('is-open')) {
            closeModal();
        }
    });
});

document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('apply-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('action', 'jobfair_submit_application');

        fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('apply-result').innerText = data.message;
            if (data.success) {
                this.reset();
            }
        });
    });
})
