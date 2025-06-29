document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-excluir');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            if (confirm('Tem certeza que deseja excluir?')) {
                window.location.href = this.href;
            }
        });
    });
});