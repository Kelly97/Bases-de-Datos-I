<?php
/*Conexion: PARA QUE ESTA CONEXION FUNCIONE, SE DEBE CREAR UN USUARIO
LLAMADO DB_FLIPBOARD(mayúsculas) Y SU CONTRASEÑA DEBE SER oracle(en minúsculas).*/
/*include_once("class/class-conexion.php");
$conexion = new Conexion();
$codigoUsuario = ;
$sql = "CONSULTA AQUI";
$resultado = $conexion->ejecutarInstruccion($sql);
while($row = $conexion->obtenerFila($resultadoUsuario)){
  echo $row['NOMBRE'];
}
$conexion->liberarResultado($resultado);
*/ 
?>
<!-- Sin notificaciones -->
<div class="card border-secondary mb-3" style="max-width: 20rem; text-align: center;">
  <div class="card-body text-secondary">
    <h4 class="card-title"><i class="fa fa-heart-o fa-2x" aria-hidden="true"></i></h4>
    <p class="card-text">No tienes ninguna notificación en este momento. Cuando alguien te siga, comente, añada o le gusten tus historias, lo verás aquí.</p>
  </div>
</div>
<!-- Notificacion seguimiento -->
<div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
  <div class="card-body text-info container">
    <div class="row">
      <div class="col-lg-3" style="padding-right: 0px;">
        <img src="images/noticias/img_prueba_3.jpg" style="width: 100%;border-radius: 30px;">
      </div>
      <div class="col-lg-9">
        <p class="card-text">      
        Andrea Aguilar ha comenzado a seguirte
        </p>       
      </div> 
      <div class="col-lg-12">
        <h6 style="color: gray;font-size: 14px;">12 minutos</h6>   
      </div>
    </div>    
  </div>
</div>
<!-- Notificacion comentario -->
<div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
  <div class="card-body text-info container">
    <div class="row">
      <div class="col-lg-3" style="padding-right: 0px;">
        <img src="images/noticias/img_prueba_3.jpg" style="width: 100%;border-radius: 30px;">
      </div>
      <div class="col-lg-9">
        <p class="card-text">      
        Andrea Aguilar ha comentado en <strong>Arte Circense</strong>
        </p>       
      </div> 
      <div class="col-lg-12">
        <h6 style="color: gray;font-size: 14px;">12 minutos</h6>   
      </div>
    </div>    
  </div>
</div>
<!-- Notificacion reaccion a historia -->
<div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
  <div class="card-body text-info container">
    <div class="row">
      <div class="col-lg-3" style="padding-right: 0px;">
        <img src="images/noticias/img_prueba_3.jpg" style="width: 100%;border-radius: 30px;">
      </div>
      <div class="col-lg-9">
        <p class="card-text">      
        A Andrea Aguilar le gustó tu historia añadida a <strong>Arte Circense</strong>
        </p>       
      </div> 
      <div class="col-lg-12">
        <h6 style="color: gray;font-size: 14px;">12 minutos</h6>   
      </div>
    </div>    
  </div>
</div>

<!-- Notificacion historia añadida-->
<div class="card border-info mb-3" style="max-width: 20rem;text-align: left;cursor: pointer;">  
  <div class="card-body text-info container">
    <div class="row">
      <div class="col-lg-3" style="padding-right: 0px;">
        <img src="images/noticias/img_prueba_3.jpg" style="width: 100%;border-radius: 30px;">
      </div>
      <div class="col-lg-9">
        <p class="card-text">      
        Andrea Aguilar añadio tu historia a <strong>Arte Circense 2</strong>
        </p>       
      </div> 
      <div class="col-lg-12">
        <h6 style="color: gray;font-size: 14px;">12 minutos</h6>   
      </div>
    </div>    
  </div>
</div>
