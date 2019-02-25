function loadDoctors(value) {
    $.ajax({
        url: 'get-doctors.php',
        type: 'GET',
        data: {
            especialidade: value
        },
        async: true,
        dataType: 'json',
        success: function (response) {
            if (response) {
                var campoSelect2 = document.getElementById("doctors");
                campoSelect2.options.length = 0;
                response.forEach(doc => {
                    var campoSelect = document.getElementById("doctors");
                    var option = document.createElement("option");
                    option.text = doc.name;
                    option.value = doc.id;
                    campoSelect.add(option);
                });
            } else {
                var campoSelect = document.getElementById("doctors");
                campoSelect.options.length = 0;
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr, status, error);
        }
    });
}

function checkSchedule(data) {
    $.ajax({
        url: 'get-hours.php',
        type: 'GET',
        data: {
            data: data,
            doutor: document.getElementById("doctors").value
        },
        async: true,
        dataType: 'json',
        success: function (response) {
            if (response) {
                var campoSelect = document.getElementById("hours");                 
                campoSelect.options.length = 0;
                for (let i = 8; i < 18; i++) {
                    if (!response.includes(i)) {
                        var option = document.createElement("option");
                        option.text = `${i}:00h`;
                        option.value = i;
                        campoSelect.add(option);
                    }
                }

            } else {
                var campoSelect = document.getElementById("hours");
                campoSelect.options.length = 0;
                for (let i = 8; i < 18; i++) {
                    var option = document.createElement("option");
                    option.text = `${i}:00h`;
                    option.value = i;
                    campoSelect.add(option);
                }
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr, status, error);
        }
    });
    }



