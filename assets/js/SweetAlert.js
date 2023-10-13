var gagalAbsen = '<?php echo $this->session->flashdata("gagal_absen"); ?>';
var berhasilAbsen = '<?php echo $this->session->flashdata("berhasil_absen"); ?>';
var gagalIzin = '<?php echo $this->session->flashdata("gagal_izin"); ?>';
var berhasilIzin = '<?php echo $this->session->flashdata("berhasil_izin"); ?>';

// alert_script.js
if (gagalAbsen) {
    Swal.fire({
        title: "Error!",
        text: gagalAbsen,
        icon: "error",
        showConfirmButton: false,
        timer: 1500
    });
}

if (berhasilAbsen) {
    Swal.fire({
        title: "Berhasil",
        text: berhasilAbsen,
        icon: "success",
        showConfirmButton: false,
        timer: 1500
    });
}

if (gagalIzin) {
    Swal.fire({
        title: "Error!",
        text: gagalIzin,
        icon: "error",
        showConfirmButton: false,
        timer: 1500
    });
}

if (berhasilIzin) {
    Swal.fire({
        title: "Berhasil",
        text: berhasilIzin,
        icon: "success",
        showConfirmButton: false,
        timer: 1500
    });
}
