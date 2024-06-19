// Function to handle Edit button click
function openEditModal(id) {
    var modal = document.getElementById("myModal");

    // Show the modal
    modal.style.display = "flex";

    // Load the edit form content into the modal body
    $("#modal-body").load("../pemantauan/edit_pemantauan.php?id=" + id);
}

// Attach event listener to dynamically created Edit buttons
$(document).on('click', '.edit-btn', function() {
    var id = $(this).data('id');
    openEditModal(id);
});

// Close modal when the user clicks on <span> (x)
$(document).on('click', '.close', function() {
    $("#myModal").css("display", "none");
});

// Close modal when the user clicks outside of the modal
$(window).on('click', function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});
