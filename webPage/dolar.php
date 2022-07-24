<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Calculadora Dólar Turista</title>


  <!-- <meta name="viewport" content="width=device-width, height=device-height,  initial-scale=1.0, user-scalable=no;user-scalable=0;"/> -->
  <link href="/dolar-turista/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
  <script src="/dolar-turista/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <style>
      body{
          background: url(/dolar-turista/img/2corrientes.jpg) no-repeat center center fixed;
          background-size: cover;
          height: 100%;
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
  <div class="container">
    <div class="row justify-content-center">
      <h1 class="text-center display-3" >Calculadora de Dólar turista</h1>
    </div>  
  </div>  
  <div id="demo" class="container pb-5">
        <div class="row">
          <div class="d-flex flex-column p-5 justify-content-center align-items-center">
              <div class="w-80 p-3 container d-flex align-items-center justify-content-center align-self-center" style="outline-style: solid" >
                <select class="form-select w-30" v-model="selected">
                  <option disabled value="">Seleccione un banco, por favor...</option>
                  <option v-for="option in options" :value="option" :>{{option.banco}}</option>
                </select>

                <input class="ms-3" type="number" min="0" v-model="dinero" @input="this.refrescar" placeholder="Ingrese el monto en U$S a calcular" >
              </div>
          </div>
        </div>

        <div class="row">
          <div class="resultado col-md4">

          <span class="col-md4 w-50 p-3 bg-secondary container d-flex align-items-center justify-content-center align-self-center my-3 resultado" v-if="selected" >El precio de venta del Dólar en el Banco {{ selected.banco }} es {{selected.sell}}:
            y con el 75% de impuestos {{parseFloat(selected.sell)  * 1.75}}</span>
          </div>
          <div class="w-100"></div>  
          <div class="col-md4 w-50 container d-flex align-items-center justify-content-center align-self-center bg-secondary resultado">
            <span class="p-3" v-if="dinero">Con el Dólar a {{selected.sell}}: y con el 75% de impuestos, el importe
            total por {{ dinero }} dólares consumidos es de {{parseFloat(selected.sell)  * 1.75 * dinero}} pesos</span>
          </div>
        
        </div>
      </div>
<br>

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
