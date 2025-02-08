<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.9/dist/sweetalert2.min.js"></script>
  
<script>
    function bildirimGoster(text, state = true) {

        if (state != true) {
            bildirimiconu = "error";
        }else{
            bildirimiconu="success";
        }
        Swal.fire({
            position: "center",
            icon: bildirimiconu,
            title: text,
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>
<?php

if (isset($_GET['success']) && isset($_GET['mesaj'])) {
    echo "<script>";
    echo " bildirimGoster(" . json_encode($_GET['mesaj']) . ", true); ";
    echo "</script>";
} elseif (isset($_GET['error']) && isset($_GET['mesaj'])) {
    echo "<script>";
    echo " bildirimGoster(" . json_encode($_GET['mesaj']) . ", false); ";
    echo "</script>";
}


?>