let tablaUsuarios = document.getElementById('tablaUsuarios');
let signup = document.getElementById('btnSignup');
let cambiarpass = document.getElementById('btnChangePass');
let frm = document.getElementById('formulario');
let myModal = new bootstrap.Modal(document.getElementById('myModal'));
document.addEventListener('DOMContentLoaded', function () {
    
    signup.addEventListener('click', function () {
        document.getElementById('id').value = '';
        document.getElementById('titulo').textContent = 'Registro de Usuario';
        cambiarpass.classList.add('d-none');
        if ($("#changePass").hasClass("d-none")) {
            $("#changePass").toggleClass("d-none");
        }
        frm.reset();
        myModal.show();
    });
    TablaUsuarios();
    frm.addEventListener('submit', function (e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado de envío del formulario
        console.log(document.getElementById('id').value);
        const id = document.getElementById('id').value;
        const name = document.getElementById('name').value;
        const user = document.getElementById('user').value;

        if ($("#changePass").hasClass("d-none")) {
           
            if (name.trim() == '' || user.trim() == '') { //el método trim() para eliminar los espacios en blanco al principio y al final de los valores
                Swal.fire(
                    'Aviso',
                    'los campos son obligatorios',
                    'warning'
                );

            } else {
                const url = base_url + "users/startSignup";
                const http = new XMLHttpRequest();
                const formData = new FormData(frm);

                formData.append('id', id);
                formData.append('name', name);
                formData.append('user', user);
                http.open("POST", url, true);
                http.send(formData);
                resp(http);
                myModal.hide();
                frm.reset();
            }
        } else {
            const pass = document.getElementById('pass').value;
            const repass = document.getElementById('repass').value;
            console.log("id sel: " + id);
            if (name.trim() == '' || user.trim() == '' || pass.trim() == '') {
                Swal.fire(
                    'Aviso',
                    'los campos son obligatorios',
                    'warning'
                );
            }
            else if (repass.trim() != pass.trim()) {
                Swal.fire(
                    'Aviso',
                    'la contraseña no coincide',
                    'warning'
                );
            } else {
                const url = base_url + "users/startSignup";
                const http = new XMLHttpRequest();
                const formData = new FormData(frm);

                formData.append('id', id);
                formData.append('name', name);
                formData.append('user', user);
                formData.append('pass', pass);
                http.open("POST", url, true);
                http.send(formData);
                resp(http);
                myModal.hide();
                frm.reset();
            }
        }

    });
    // Mostrar/ocultar campos de contraseña al presionar el botón de cambiar contraseña
    cambiarpass.addEventListener('click', function () {
        $('#changePass').toggleClass('d-none');
    });

    $('#tablaUsuarios').on('click', '#btneditar', function () {
        frm.reset();
        // Obtener ID del usuario a editar
        var id = $(this).data('id')
        console.log(id)
        const fila = $(this).closest('tr');
        console.log(fila)
        const name = fila.find('td:eq(0)').text();
        const username = fila.find('td:eq(1)').text();
        // llenar los campos del formulario con los valores obtenidos
        $('#id').val(id);
        $('#name').val(name);
        $('#user').val(username);


        document.getElementById('titulo').textContent = 'Editar usuario';
        cambiarpass.classList.remove('d-none');
        if (!$("#changePass").hasClass("d-none")) {
            $("#changePass").toggleClass("d-none");
        }
        myModal.show();
    });

    $('#tablaUsuarios').on('click', '#btnborrar', function () {
        Swal.fire({
            title: '¡Advertencia!',
            text: "¿Esta seguro de eliminar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).data('id')
                console.log("registro a eliminar con id:" + id);
                const url = base_url + "users/borrar/" + id;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
                resp(http);
                frm.reset();
            }
        })
    });
    function resp(http) {
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                Swal.fire({
                    position: 'bottom-end',
                    icon: res.tipo,
                    title: res.msg,
                    showConfirmButton: false,
                    timer: 1000
                })
                if (res.estado) {
                    TablaUsuarios();
                    document.getElementById('id').value = '';
                }
            }
        }
    }
    // Función que se encarga de actualizar la tabla de usuarios
    function TablaUsuarios() {
        const url = base_url + "users/mostrarUsers";
        var tbody = tablaUsuarios.getElementsByTagName("tbody")[0];
        tbody.innerHTML = "";
        
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
        })
        .done(function (resp) {   
            if (resp.length > 0) {
                for (var i = 0; i < resp.length; i++) {
                    var tr = document.createElement("tr");
                    var td = document.createElement("td");
                    var tdText = document.createTextNode(resp[i].name);
                    td.appendChild(tdText);
                    tr.appendChild(td);
                    td = document.createElement("td");
                    tdText = document.createTextNode(resp[i].username);
                    td.appendChild(tdText);
                    tr.appendChild(td);
                    td = document.createElement("td");
                    tdText = document.createTextNode(resp[i].status);
                    td.appendChild(tdText);
                    tr.appendChild(td);
                    td = document.createElement("td");
                    var btnEdit = document.createElement("button");
                    btnEdit.innerHTML = "Editar";
                    btnEdit.setAttribute("type", "button");
                    btnEdit.setAttribute("class", "btn btn-warning");
                    btnEdit.setAttribute("id", "btneditar");
                    btnEdit.setAttribute("data-id", resp[i].id); // Agregar atributo "data-id" con el valor del ID
                    var btnBorr = document.createElement("button");
                    btnBorr.innerHTML = "Borrar";
                    btnBorr.setAttribute("type", "button");
                    btnBorr.setAttribute("class", "btn btn-danger");
                    btnBorr.setAttribute("data-id", resp[i].id); // Agregar atributo "data-id" con el valor del ID
                    btnBorr.setAttribute("id", "btnborrar");
                    td.appendChild(btnEdit);
                    td.appendChild(btnBorr);
                    tr.appendChild(td);
                    tbody.appendChild(tr); // Agregar la fila al tbody de la tabla
                }
            } else {
                var tr = document.createElement("tr");
                var td = document.createElement("td");
                var tdText = document.createTextNode("no hay usuarios");
                td.appendChild(tdText);
                tr.appendChild(td);
                tbody.appendChild(tr); // Agregar la fila al tbody de la tabla
            }
        })
        .fail(function () {
            console.log("error no se pudo comunicar con la base de datos");
        });
    }
});