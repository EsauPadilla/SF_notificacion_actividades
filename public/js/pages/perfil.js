let frm = document.getElementById('formulario');
let contenido = document.getElementById('layoutSidenav_content');
let profileImage = document.getElementById('profile-image');
let profileImageInput = document.getElementById('profile-image-input');


document.addEventListener('DOMContentLoaded', function () {
    frm.addEventListener('submit', function (e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado de envío del formulario

        const url = base_url + "perfil/configPerfil";
        const http = new XMLHttpRequest();
        const formData = new FormData(frm);
        formData.append('profile-image', profileImageInput.files[0]); // Agregar la imagen al FormData
        formData.append('name', document.getElementById('name').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('adress', document.getElementById('adress').value);
        formData.append('desc', document.getElementById('desc').value);
        http.open("POST", url, true); // Abrir y enviar la solicitud POST
        http.send(formData);
        resp(http);

    })
    profileImage.addEventListener('click', function () {
        profileImageInput.click();
    })
     // Agregar un evento 'change' al input de imagen
    profileImageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const imageUrl = e.target.result;
            document.getElementById('profile-image-preview').setAttribute('src', imageUrl);
        };
        reader.readAsDataURL(file);
    });
    
    // Definir la función 'resp' para manejar la respuesta de la solicitud
    function resp(http) {
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res.estado) {
                    setTimeout(function () {// Cargar la misma página después da 1 segundo
                        window.location.reload();
                    }, 1000);

                    // y Muestra el mensaje de datos actualizados
                    Swal.fire({
                        position: 'bottom-end',
                        icon: res.tipo,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        }
    }

});