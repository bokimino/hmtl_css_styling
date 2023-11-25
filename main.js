function showAddCategoryForm() {
    document.getElementById('addCategoryForm').style.display = 'table-row';
}
function showAddAuthorForm() {
    document.getElementById('addAuthorForm').style.display = 'table-row';
}
function showAddBookForm() {
    document.getElementById('addBookForm').style.display = 'block';
}
function confirmDelete(bookId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will delete the book and its associated comments.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('.delete-form input[name="book_id"]').value = bookId;
            document.querySelector('.delete-form').submit();
        }
    });
}
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('login') === 'success') {
$('#modalLoginForm').modal('hide');
}