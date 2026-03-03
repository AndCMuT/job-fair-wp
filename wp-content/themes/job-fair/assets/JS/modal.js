document.addEventListener('DOMContentLoaded', () => { // Ждём полной загрузки HTML
    const openButtons = document.querySelectorAll('.apply-btn'); //получаем все кнопки
    const modalOverlay = document.querySelector('.modal-overlay'); //оверлей
    const modalClose = document.querySelector('.modal-close'); //кнопка закрытия


    if (!modalOverlay) return; //если модального окна нет на странице код не выполнится

    function openModal() { //функция открытия окна
        modalOverlay.classList.add('is-open'); //добавляет класс
        modalOverlay.setAttribute('aria-hidden', 'false'); //добавляет атрибуты, для скрин ридера
        document.body.classList.add('modal-open');
    }

    function closeModal() { //функция закрытия окна
        modalOverlay.classList.remove('is-open'); // удаляет класс
        modalOverlay.setAttribute('aria-hidden', 'true'); //удаляет атрибут
        document.body.classList.remove('modal-open');
    }

    const form = document.getElementById('apply-form'); //получаем форму, если её нет код не выполнится
        if (!form) return;

    openButtons.forEach(button => { //для каждой кнопки, прослушиваем событие клика
        button.addEventListener('click', () => {
        const vacancyId = button.dataset.vacancyId; //считываем ID вакансии
        document.querySelector('#vacancy_id').value = vacancyId; //передаём ID в скрытое input поле
        openModal(); //открываем окно
        });
    });

    modalClose.addEventListener('click', closeModal); //закрытие окна при клике на крестик

    modalOverlay.addEventListener('click', (event) => { //закрытие окна при клике на оверлей
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => { //закрытие окна при нажатий кнопки esc
        if (event.key === 'Escape' && modalOverlay.classList.contains('is-open')) {
            closeModal();
        }
    });

    form.addEventListener('submit', function (e) { //отправка формы
        e.preventDefault(); //отменяем стандартную отправку
        const formData = new FormData(this); //получаем данные формы
        formData.append('action', 'jobfair_submit_application'); //говорим WP какую функцию надо выполнить
        fetch('/wp-admin/admin-ajax.php', { //отправляем данные на сервер
            method: 'POST',
            body: formData
        })
        .then(res => res.json()) //ждём ответ и преобразуем из json в js-объект
        .then(data => {
            document.getElementById('apply-result').innerText = data.message; //отправляем сообщение
            if (data.success) {
                this.reset(); //очищаем поля формы
            }
        });
    });
});
