function showAddCategoryForm() {
    document.getElementById('addCategoryForm').style.display = 'table-row';
    document.getElementById('addCategoryButton').style.display = 'none';
}
function hideAddCategoryForm() {
    document.getElementById('addCategoryForm').style.display = 'none';
    document.getElementById('addCategoryButton').style.display = 'block';
}
function showAddAuthorForm() {
    document.getElementById('addAuthorForm').style.display = 'table-row';
		document.getElementById('addAuthorButton').style.display = 'none';
}
function hideAddAuthorForm(){
    document.getElementById('addAuthorForm').style.display = 'none';
    document.getElementById('addAuthorButton').style.display = 'block';

}
function showAddBookForm() {
    document.getElementById('addBookForm').style.display = 'block';
    document.getElementById('addBookButton').style.display = 'none';
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