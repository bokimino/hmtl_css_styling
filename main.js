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
function displayNotes(notes) {
    var notesContainer = $('#notes-container');

    notesContainer.empty();

    if (notes.length > 0) {
        notes.forEach(function (note) {
            var noteText = note.note_text;

            var noteContainer = $('<div>').addClass('note-container bg-light border ');

            var noteElement = $('<div>').text(noteText).appendTo(noteContainer);

            var updateButton = $('<button>').text('Update').addClass('update-note-btn btn btn-secondary m-2').appendTo(noteContainer);

            var deleteButton = $('<button>').text('Delete').addClass('delete-note-btn btn btn-danger m-2').appendTo(noteContainer);

            var updateInput = $('<textarea>').addClass('update-note-input form-control m-auto w-50').hide().appendTo(noteContainer);

            var saveUpdateButton = $('<button>').text('Save').addClass('save-update-btn btn btn-success').hide().appendTo(noteContainer);

            updateButton.on('click', function () {
                updateInput.val(noteText).show();
                updateButton.hide();
                deleteButton.hide();
                saveUpdateButton.show();
            });

            deleteButton.on('click', function () {
                deleteNote(note.id);
            });

            saveUpdateButton.on('click', function () {
                var updatedText = updateInput.val();

                updateNote(note.id, updatedText);

                updateInput.hide();
                saveUpdateButton.hide();

                updateButton.show();
            });

            notesContainer.append(noteContainer);
        });
    } else {
        notesContainer.text('No notes available.');
    }
}


function addNote(bookId, noteText) {
    $.ajax({
        url: '../NOTE/add_note.php',
        method: 'POST',
        data: {
            book_id: bookId,
            note_text: noteText
        },
        success: function (response) {
            console.log('Note added successfully:', response);

            fetchAndDisplayNotes(bookId);
        },
        error: function (xhr, status, error) {
            console.error('Error adding note:', error);
        }
    });
}

$('#add-note-btn').on('click', function () {
    var noteText = $('#note-text').val();

    if (noteText.trim() !== '') {
        addNote(bookId, noteText);

        $('#note-text').val('');
    }
});