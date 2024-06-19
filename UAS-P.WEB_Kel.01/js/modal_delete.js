// modal_delete.js
$(document).ready(function() {
    // Delete Modal
    var deleteModal = document.getElementById('deleteModal');
    var confirmDelete = document.getElementById('confirmDelete');
    var cancelDelete = document.getElementById('cancelDelete');

    // Open delete modal on click
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        deleteModal.style.display = 'flex';

        confirmDelete.onclick = function() {
            window.location.href = '../pemantauan/delete_pemantauan.php?id=' + id + '&confirm=yes';
        }

        cancelDelete.onclick = function() {
            deleteModal.style.display = 'none';
        }
    });

    // Close the modal if the user clicks outside of it
    window.onclick = function(event) {
        if (event.target == deleteModal) {
            deleteModal.style.display = 'none';
        }
    }
});
