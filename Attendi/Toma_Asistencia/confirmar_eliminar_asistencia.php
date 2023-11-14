<?php
    $idAsistencia = $_GET['id'];
    $fecha = $_GET['fecha'];
?>

<script>
   var result = confirm("Confirme para eliminar la asistencia.");
    if (result == true) {
        window.location.replace("eliminar_asistencia.php?id=<?php echo $idAsistencia; ?>&fecha=<?php echo $fecha; ?>");
    }
</script>

<html>
   <form action="gestion_asistencias.php" method="post" id="form_fecha">
        <input type="hidden" name="fecha" value="<?php echo $fecha; ?>"/>
   </form>
   
   <script>
        document.getElementById("form_fecha").submit();
   </script>
</html>