<?php 

//function de alertas by abisoft https://github.com/amnersaucedososa
    function profile(){
        $success=sha1(md5("datos actualizados"));
        if (isset($_GET['success']) && $_GET['success']==$success) {
            echo "<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                </button><strong>Aviso!</strong> Datos Actualizados Correctamente
                </div>";
        }
        $success_pass=sha1(md5("contrasena actualizada"));
        if (isset($_GET['success_pass']) && $_GET['success_pass']==$success_pass) {
            echo "<div class='alert alert-success alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                </button> Datos y contraseña actualizados correctamente.
                </div>";
        }
        $invalid=sha1(md5("la contrasena no coincide la contraseña con la anterior"));
        if (isset($_GET['invalid']) && $_GET['invalid']==$invalid) {
            echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                </button><strong>Aviso!</strong> La contraseña no coincide con la anterior.
                </div>";
        }
        $error=sha1(md5("las nuevas  contraseñas no coinciden"));
        if (isset($_GET['error']) && $_GET['error']==$error) {
            echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                </button><strong>Aviso!</strong> Las nuevas contraseñas no coinciden
                </div>";
        }
    }
?>