function showAddCategoryForm() {
    document.getElementById('addCategoryForm').style.display = 'inline-block';
    document.getElementById('addCategoryButton').style.display = 'none';
}
function hideAddCategoryForm() {
    document.getElementById('addCategoryForm').style.display = 'none';
    document.getElementById('addCategoryButton').style.display = 'inline-block';
}
function showAddAuthorForm() {
    document.getElementById('addAuthorForm').style.display = 'block';
    document.getElementById('addAuthorButton').style.display = 'none';
}
function hideAddAuthorForm() {
    document.getElementById('addAuthorForm').style.display = 'none';
    document.getElementById('addAuthorButton').style.display = 'inline-block';

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

$(document).ready(function () {
    function fetchRandomQuote() {
        $.ajax({
            url: 'http://api.quotable.io/random',
            method: 'GET',
            success: function (data) {
                $('#quote').text(data.content);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching quote:', error);
            }
        });
    }

    fetchRandomQuote();
});
function fetchAndDisplayNotes(bookId) {
    $.ajax({
        url: '../NOTE/get_notes.php',
        method: 'GET',
        data: {
            book_id: bookId
        },
        success: function (response) {
            // Handle success, e.g., update UI with the retrieved notes
            displayNotes(response);
        },
        error: function (xhr, status, error) {
            console.error('Error fetching notes:', error);
        }
    });
}
fetchAndDisplayNotes(bookId);