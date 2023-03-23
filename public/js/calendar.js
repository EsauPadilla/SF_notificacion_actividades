let calendarEl = document.getElementById('calendar');
let frm = document.getElementById('formulario');
let eliminar = document.getElementById('btnEliminar');
let selClient = document.getElementById('client');
let selSite = document.getElementById('site');
let selTypeact = document.getElementById('typeact');
let myModal = new bootstrap.Modal(document.getElementById('myModal'));
document.addEventListener('DOMContentLoaded', function () {
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

        editable: true,
        dateClick: function (info) {
            frm.reset();
            eliminar.classList.add('d-none');
            if (info.allDay) {
                document.getElementById('id').value = '';
                document.getElementById('datestart').value = info.dateStr;
            } else {

                let fechaHora = info.dateStr.split("T");

                document.getElementById('datestart').value = fechaHora[0];
                document.getElementById('timestart').value = fechaHora[1].substring(0, 5);
                document.getElementById('timeend').value = fechaHora[1].substring(0, 5);

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
            document.getElementById('client').value = info.event.extendedProps.id_client;
            document.getElementById('site').value = info.event.extendedProps.id_site;
            document.getElementById('typeact').value = info.event.extendedProps.id_activity;
            document.getElementById('description').value = info.event.extendedProps.description;
            document.getElementById('btnAccion').textContent = 'Modificar';
            document.getElementById('titulo').textContent = 'Actualizar Evento';
            eliminar.classList.remove('d-none');
            myModal.show();
        },
        eventResize: function (info) {
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
                        calendar.refetchEvents();
                    }
                }
            }

        },
        eventDrop: function (info) {
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
                        calendar.refetchEvents();
                    }
                }
            }
        }

    });
    calendar.render();
    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        console.log(document.getElementById('id').value);
        const title = document.getElementById('title').value;
        const start = document.getElementById('datestart').value;
        const client = document.getElementById('client').value;

        if (title == '' || start == '' || client == '') {
            Swal.fire(
                'Aviso',
                'los campos son obligatorios',
                'warning'
            );
        } else {
            const url = base_url + "calendar/registrar";
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
                        calendar.refetchEvents();
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
                            document.getElementById('id').value ='';
                        }
                    }
                }
            }
        })
    });
    $('client', function (event) {
        const url = base_url + "calendar/listar_catalogos/cliente";
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
        })
            .done(function (resp) {
                if (resp.length > 0) {
                    for (var i = 0; i < resp.length; i++) {
                        // cadena += "<option value="+res[i][0]+" >"+res[i][1]+"</option>" ; 
                        var option = document.createElement("option");
                        option.value = resp[i].id;
                        option.text = resp[i].name;
                        selClient.add(option);
                    }
                } else {
                    var option = document.createElement("option");
                    option.value = "";
                    option.text = "no hay elementos";
                    selClient.add(option);
                }
            })
            .fail(function () {
                console.log("error");
            });
    });
    $('site', function (event) {
        const url = base_url + "calendar/listar_catalogos/sitio";
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
        })
            .done(function (resp) {
                if (resp.length > 0) {
                    for (var i = 0; i < resp.length; i++) {
                        // cadena += "<option value="+res[i][0]+" >"+res[i][1]+"</option>" ; 
                        var option = document.createElement("option");
                        option.value = resp[i].id;
                        option.text = resp[i].site;
                        selSite.add(option);
                    }
                } else {
                    var option = document.createElement("option");
                    option.value = "";
                    option.text = "no hay elementos";
                    selSite.add(option);
                }
            })
            .fail(function () {
                console.log("error");
            });
    });
    $('typeact', function (event) {
        const url = base_url + "calendar/listar_catalogos/actividad";
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
        })
            .done(function (resp) {
                if (resp.length > 0) {
                    for (var i = 0; i < resp.length; i++) {
                        // cadena += "<option value="+res[i][0]+" >"+res[i][1]+"</option>" ; 
                        var option = document.createElement("option");
                        option.value = resp[i].id;
                        option.text = resp[i].activity;
                        selTypeact.add(option);
                    }
                } else {
                    var option = document.createElement("option");
                    option.value = "";
                    option.text = "no hay elementos";
                    selTypeact.add(option);
                }
            })
            .fail(function () {
                console.log("error");
            });
    });

})



