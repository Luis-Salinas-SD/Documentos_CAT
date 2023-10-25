<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONTROL DE DOCUMENTOS</title>
</head>

<link rel="stylesheet" href="assets/styles/styles.css">
<link rel="stylesheet" href="assets/styles/bootstrap.css">

<style>
  * {
    margin: 0;
    padding: 0;
  }

  #particles-js {
    background: white;
    padding: 0 !important;
    margin: 0 !important;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    z-index: -1;
  }

  .login-box {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<body>

  <div class="login-box">

    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

    <form action="login.php" method="POST" autocomplete="off" class="form">

      <div class="panel-title">
        <div class="text-center">
          <img src="img/LogoD.png" width="200" />
        </div>

        <div class="mb-3">
          <input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Usuario" required>
        </div>

        <div class="mb-3">
          <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
        </div>


        <div class="form-group">
          <div class="col-sm-12 controls" align="center">
            <button id="btn-login" type="submit" class="btn btn-gold">Ingresar</a>
          </div>
        </div>
      </div>

    </form>






  </div>

  <div id="particles-js"></div>

  <script src="assets/js/bootstrap.min.js"></script>
  <script src="js/particles.min.js"></script>
  <script>
    particlesJS({
      "particles": {
        "number": {
          "value": 6,
          "density": {
            "enable": true,
            "value_area": 800
          }
        },
        "color": {
          "value": "#b88e55"
        },
        "shape": {
          "type": "polygon",
          "stroke": {
            "width": 0,
            "color": "#000"
          },
          "polygon": {
            "nb_sides": 6
          },
          "image": {
            "src": "img/github.svg",
            "width": 100,
            "height": 100
          }
        },
        "opacity": {
          "value": 0.3,
          "random": true,
          "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 160,
          "random": false,
          "anim": {
            "enable": true,
            "speed": 10,
            "size_min": 40,
            "sync": false
          }
        },
        "line_linked": {
          "enable": false,
          "distance": 200,
          "color": "#ffffff",
          "opacity": 1,
          "width": 2
        },
        "move": {
          "enable": true,
          "speed": 8,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false,
          "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": false,
            "mode": "grab"
          },
          "onclick": {
            "enable": false,
            "mode": "push"
          },
          "resize": true
        },
        "modes": {
          "grab": {
            "distance": 400,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 200,
            "duration": 0.4
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true
    });
  </script>
</body>

</html>









<!-- <!DOCTYPE html>
<html>

<head>


  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/estilos_index.css">
  <script src="js/bootstrap.min.js"></script>

</head>




</html> -->