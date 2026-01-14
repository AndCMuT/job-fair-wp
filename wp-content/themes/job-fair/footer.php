        <footer>
            <div class="container-footer">
                <div class="logo"><?php the_custom_logo() ?></div>
                <p>Разработано студентом ЭДиС 233-2 Сметаниным Андреем Витальевичем </p>
            </div>
        </footer>
    </main>
    <?php wp_footer(  ); ?>
    <div class="modal-overlay" id="apply-modal" aria-hidden="true">
        <div class="modal-window" role="dialog" aria-modal="true" aria-labelledby="apply-modal-title">
            <!-- Хедер окна -->
            <div class="modal-header"> 
                <h2 id="apply-modal-title">Отклик на вакансию</h2>
                <button type="button" class="modal-close" aria-label="Закрыть окно">x</button>
            </div>
            <!-- Тело -->
            <div class="modal-body">
                <form class="apply-form" method="post">
                    <!-- Скрытое поле под ID вакансии -->
                    <input type="hidden" name="vacancy_id" value="">
                    <p class="form-field">
                        <label for="applicant_name">Имя</label>
                        <input type="text" id="applicant_name" name="applicant_name" required>
                    </p>
                    <p class="form-field">
                        <label for="applicant_email">Email</label>
                        <input type="email" id="applicant_email" name="applicant_email" required>
                    </p>
                    <p class="form-field">
                        <label for="applicant_phone">Телефон</label>
                        <input type="text" id="applicant_phone" name="applicant_phone">
                    </p>
                    <p class="form-field">
                        <label for="resume_link">Ссылка на резюме</label>
                        <input type="url" id="resume_link" name="resume_link">
                    </p>
                    <p class="form-field">
                        <label for="about_applicant">О себе</label>
                        <textarea id="about_applicant" name="about_applicant" rows="4"></textarea>
                    </p>
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            Отправить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
