<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Calculadora Dólar Turista</title>

  <meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=yes; user-scalable=0;"/>
  <link href="/dolar-turista/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
  <script src="/dolar-turista/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <style>
      body , html{
	  background: rgb(34,193,195);
	  background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%);
      }

      #demo{
         background-image: linear-gradient(to bottom left, #a1a1bb, #e6e611 );
         border-radius: 25px;
      }

      .resultado{
        border-radius: 25px;
      }
 
 </style>


</head>

<body>
  <br>
  <br>
  <br>
<div class="container-fluid" >
    <nav class="main-nav js-stick" style="height: 10%">
                <div class="full-wrapper relative clearfix">
                    <!-- Logo ( * your text or image into link tag *) -->
                    <div class="nav-logo-wrap local-scroll">
                        <a href="/" class="logo">
                            <img class="mx-auto d-block w-50 h-50 pb-5" src="../images/logo.png" alt="logo"  style="height:100px ; width:100px" >
                        </a>
                    </div>
		</div>
    </nav>
</div>


  <div class="container">
    <div class="row justify-content-center">
      <h1 class="text-center display-3" ><strong>Calculadora de Dólar turista</strong></h1>
    </div>  

  <div id="demo" class="container pb-5">
        <div class="row">
          <div class="d-flex flex-column p-5 justify-content-center align-items-center">
              <div class="col-lg-6 p-3 container d-flex align-items-center justify-content-center align-self-center" >
                <select class="form-select w-30" v-model="selected">
                  <option disabled value="">Seleccione un banco, por favor...</option>
                  <option v-for="option in options" :value="option" >{{option.banco}}</option>
                </select>
		</div>
		<div>
                <input class="ms-3" type="number" min="0" v-model="dinero" @input="this.refrescar" placeholder="Ingrese el monto en U$S a calcular" >
              </div>
          </div>
        </div>

        <div class="row">
          <div class="resultado col-md4">

          <span class="fs-5 col-lg-6 p-3 bg-secondary container d-flex align-items-center justify-content-center align-self-center my-3 resultado" v-if="selected" >El precio de venta del Dólar en el Banco {{ selected.banco }} es {{selected.sell}} :
            y con el 75% de impuestos {{ (parseFloat(selected.sell)  * 1.75 ).toFixed(2)}}</span>
          </div>
          <div class="w-100"></div>  
	    <div>	  
		<div class="fs-5 col-lg-6 container d-flex align-items-center justify-content-center align-self-center bg-secondary resultado">
		    <span class="p-3" v-if="dinero">Con el Dólar a {{selected.sell}}: y con el 75% de impuestos, el importe
		    total por {{ dinero }} dólares consumidos es de {{ (parseFloat(selected.sell)  * 1.75 * dinero ).toFixed(2)}} pesos</span>
		  </div>
            </div>
        </div>
      </div>
        <br>
  </div>  
<script src="/dolar-turista/js/vue.global.prod.js"></script>
<script>


Vue.createApp({
  data() {
    return {
      selected: '',
<?php
/** 
 *  NEXT :
 *  encontrar CSS m[]as presentable
 *  hacer generación dinámica del HTML actualizando lso precios.
 *  hacer Select de moneda EURO | DÓLAR 
 * 
 * 
 */

    $files = scandir('/home/run_tasks/projects/dolar-turista/datos/dolar/', SCANDIR_SORT_DESCENDING);
    $newest_file = "/home/run_tasks/projects/dolar-turista/datos/dolar/" . $files[0];
    $archivo = file_get_contents($newest_file);

?>
    
       options: <?= $archivo ?> ,

     };
  },
    methods: {
      refrescar(){
        this.$forceUpdate();
      },
    onChange() {
      // console.log( this.dinero = e.target.value);
      this.$emit('change', this.selected);
    },
    hear(e){ 
      console.log(this.$refs)
    },
  },
}).mount('#demo');

  </script>
</body>

</html>
