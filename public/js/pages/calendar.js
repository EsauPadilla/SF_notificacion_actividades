let calendarEl = document.getElementById('calendar');
let frm = document.getElementById('formulario');
let eliminar = document.getElementById('btnEliminar');
let reporte = document.getElementById('btnReport');
let myModal = new bootstrap.Modal(document.getElementById('myModal'));

document.addEventListener('DOMContentLoaded', function () {
    bombos();
    calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        themeSystem: 'bootstrap5',
        initialView: 'timeGridWeek',
        locale: 'es',
        headerToolbar: {
            left: 'prev next today',
            center: 'title',
            right: 'dayGridMonth timeGridWeek timeGridDay'
        },
        events: base_url + "calendar/listar",
        eventColor: '#f89838',
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: false
        },
        aspectRatio: 1.4,
        editable: true,
        dateClick: function (info) {
            frm.reset();
            eliminar.classList.add('d-none');
            if (info.allDay) {
                document.getElementById('id').value = '';
                document.getElementById('datestart').value = info.dateStr;
            } else {
                document.getElementById('id').value = '';
                let fechaHora = info.dateStr.split("T");
                document.getElementById('datestart').value = fechaHora[0];
                var timeendValue = fechaHora[1].substring(0, 5);
                var timeendDate = new Date('2000-01-01 ' + timeendValue);
                // Añadir 30 minutos a timeend
                timeendDate.setMinutes(timeendDate.getMinutes() + 30);
                // Obtener el nuevo valor de timeend en formato de cadena de texto
                var newTimeendValue = timeendDate.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit' });
                document.getElementById('timeend').value = newTimeendValue;
                document.getElementById('timestart').value = fechaHora[1].substring(0, 5);
                document.getElementById('datestart').value = fechaHora[0];

            }
            document.getElementById('btnAccion').textContent = 'Registrar';
            document.getElementById('titulo').textContent = 'Registrar Evento';
            myModal.show();
        },
        eventClick: function (info) {
            document.getElementById('id').value = info.event.id;
            console.log(document.getElementById('id').value)
            document.getElementById('title').value = info.event.title;
            document.getElementById('datestart').value = moment(info.event.start).format("YYYY-MM-DD");
            document.getElementById('timestart').value = moment(info.event.start).format("HH:mm");
            document.getElementById('dateend').value = moment(info.event.end).format("YYYY-MM-DD");
            document.getElementById('timeend').value = moment(info.event.end).format("HH:mm");
            document.getElementById('ticket').value = info.event.extendedProps.ticket;
            document.getElementById('cliente').value = info.event.extendedProps.id_client;
            document.getElementById('sitio').value = info.event.extendedProps.id_site;
            document.getElementById('actividad').value = info.event.extendedProps.id_activity;
            document.getElementById('description').value = info.event.extendedProps.description;
            document.getElementById('btnAccion').textContent = 'Modificar';
            document.getElementById('titulo').textContent = 'Actualizar Evento';
            eliminar.classList.remove('d-none');
            myModal.show();
        },
        eventResize: function (info) {
            drag(info);
        },
        eventDrop: function (info) {
            drag(info);
        }

    });
    calendar.render();
    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log(document.getElementById('id').value);
        const title = document.getElementById('title').value;
        const start = document.getElementById('datestart').value;
        const activity = document.getElementById('actividad').value;
        const tiket = document.getElementById('ticket').value;
        const client = document.getElementById('cliente').value;
        const site = document.getElementById('sitio').value;

        if (title == '' || start == '' || activity == '' || client == '' || tiket == ''|| site == '') {
            Swal.fire(
                'Aviso',
                '¡Los campos son obligatorios!',
                'warning'
            );
        } else {
            const url = base_url + "calendar/registrar";
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            resp(http);
            myModal.hide();
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
                resp(http);
            }
        })
    });
    reporte.addEventListener('click', function () {
        const url = base_url + "report/generar_reporte";
        const http = new XMLHttpRequest();
        http.open('GET', url, true);
        http.responseType = 'blob';
        http.onload = function () {
            if (this.readyState == 4 && this.status == 200) {
                var url = window.URL.createObjectURL(http.response);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'reporte.xlsx';
                document.body.appendChild(a);
                a.click();

                // Liberar el objeto URL
                window.URL.revokeObjectURL(url);

                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Reporte generado',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'No se pudo generar el reporte',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        }
        http.send();
    });
    function bombos() {
        var url = base_url + "calendar/listar_catalogos/cliente";
        getbombos(url);
        url = base_url + "calendar/listar_catalogos/sitio";
        getbombos(url);
        url = base_url + "calendar/listar_catalogos/actividad";
        getbombos(url);
    }
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
                    calendar.refetchEvents();
                    document.getElementById('id').value = '';
                }
            }
        }
    }
    function drag(info) {
        const datestart = moment(info.event.start).format("YYYY-MM-DD");
        const timestart = moment(info.event.start).format("HH:mm");
        const dateend = moment(info.event.end).format("YYYY-MM-DD");
        const timeend = moment(info.event.end).format("HH:mm");
        const id = info.event.id;
        const url = base_url + "calendar/drag";
        const http = new XMLHttpRequest();
        const formDta = new FormData();
        formDta.append('datestart', datestart);
        formDta.append('timestart', timestart);
        formDta.append('dateend', dateend);
        formDta.append('timeend', timeend);
        formDta.append('id', id);
        http.open("POST", url, true);
        http.send(formDta);
        resp(http);
    }
    function getbombos(url) {
        var tabla = url.substring(url.lastIndexOf("/") + 1);
        let sel = document.getElementById(tabla);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
        })
            .done(function (resp) {
                if (resp.length > 0) {
                    for (var i = 0; i < resp.length; i++) {
                        var option = document.createElement("option");
                        option.value = resp[i].id;
                        option.text = resp[i].name;
                        sel.add(option);
                    }
                } else {
                    var option = document.createElement("option");
                    option.value = "";
                    option.text = "no hay elementos";
                    sel.add(option);
                }
            })
            .fail(function () {
                console.log("error");
            });
    }
});
