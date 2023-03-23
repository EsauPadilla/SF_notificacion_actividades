let signup = document.getElementById('btnSignup');
let tablaUsuarios = document.getElementById('tablaUsuarios');
let frm = document.getElementById('formulario');
let eliminar = document.getElementById('btnEliminar');
let myModal = new bootstrap.Modal(document.getElementById('myModal'));
document.addEventListener('DOMContentLoaded', function () {

    signup.addEventListener('click', function () {
        eliminar.classList.remove('d-none');
        myModal.show();
    });


    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log(document.getElementById('id').value);
        const name = document.getElementById('name').value;
        const user = document.getElementById('user').value;
        const pass = document.getElementById('pass').value;
        const repass = document.getElementById('repass').value;

        if (name == '' || user == '' || pass == '') {
            Swal.fire(
                'Aviso',
                'los campos son obligatorios',
                'warning'
            );
        } if (repass == pass) {
            Swal.fire(
                'Aviso',
                'la contraseña no coincide',
                'warning'
            );

        } else {
            const url = base_url + "signup/startSignupr";
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
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
                        myModal.hide();
                    }
                }
            }
        }
    });

    eliminar.addEventListener('click', function () {
        myModal.hide();
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
                console.log("registro a eliminar con id:" + document.getElementById('id').value);
                const url = base_url + "calendar/eliminar/" + document.getElementById('id').value;
                const http = new XMLHttpRequest();
                http.open("GET", url, true);
                http.send();
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
                            calendar.refetchEvents();
                            document.getElementById('id').value = '';
                        }
                    }
                }
            }
        })
    });

    $('tablaUsuarios', function (event) {
        const url = base_url + "users/mostrarUsers";
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
        })
            .done(function (resp) {
                if (resp.length > 0) {
                    for (var i = 0; i < resp.length; i++) {
                        tr = document.createElement("tr");
                        var td = document.createElement("td");
                        tdText = document.createTextNode(resp[i].name);
                        td.appendChild(tdText);
                        tr.appendChild(td);
                        var td = document.createElement("td");
                        tdText = document.createTextNode(resp[i].username);
                        td.appendChild(tdText);
                        tr.appendChild(td);
                        var td = document.createElement("td");
                        tdText = document.createTextNode(resp[i].status);
                        td.appendChild(tdText);
                        tr.appendChild(td);

                        tablaUsuarios.appendChild(tr);

                    }
                } else {
                    tr = document.createElement("tr");
                    var td = document.createElement("td");
                    tdText = document.createTextNode("no hay usuarios");
                    td.appendChild(tdText);
                    tr.appendChild(td);
                }
            })
            .fail(function () {
                console.log("error no se pudo comunicar con la base de datos");
            });
    });
})