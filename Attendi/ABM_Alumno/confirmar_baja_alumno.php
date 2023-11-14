<?php
    $dniAlumno = $_GET['dni'];
?>

<script>
   var result = confirm("Confirme para dar de baja al alumno.");
    if (result == true) {
        window.location.replace("baja_alumno.php?dni=<?php echo $dniAlumno ?>");
    } else {
        window.location.replace("index.php");
    }
</script>

    