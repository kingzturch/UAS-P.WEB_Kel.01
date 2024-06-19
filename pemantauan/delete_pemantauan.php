<?php
session_start();
require_once "../koneksi.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $param_id = trim($_GET["id"]);

    if (isset($_GET["confirm"]) && $_GET["confirm"] == "yes") {
        $sql = "DELETE FROM pemantauan WHERE id = ?";

        if ($stmt = mysqli_prepare($koneksi, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            if (mysqli_stmt_execute($stmt)) {
                header("location: hasil_pemantauan.php");
                exit();
            } else {
                echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                var deleteModal = document.getElementById('deleteModal');
                var confirmDelete = document.getElementById('confirmDelete');
                var cancelDelete = document.getElementById('cancelDelete');

                deleteModal.style.display = 'block';

                confirmDelete.onclick = function() {
                    window.location.href = 'delete_pemantauan.php?id=" . $param_id . "&confirm=yes';
                }

                cancelDelete.onclick = function() {
                    deleteModal.style.display = 'none';
                    window.location.href = 'hasil_pemantauan.php';
                }

                window.onclick = function(event) {
                    if (event.target == deleteModal) {
                        deleteModal.style.display = 'none';
                        window.location.href = 'hasil_pemantauan.php';
                    }
                }
              </script>";
    }
} else {
    header("location: error.php");
    exit();
}
?>
