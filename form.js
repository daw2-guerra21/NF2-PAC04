$(document).ready(function () {
    actualizarDatos();
    $("#insertar").click(insertarDatos);
    /*
    $("form").submit(function (event) {
        var formData = {
            buscador: $("#buscador").val(),
        };

        relleno = "";
        relleno+= '<table class="table table-bordered table-hover">'; 
        relleno+= '<thead class="thead-dark"> <tr> <th>ID</th> <th>Paraula</th> <th>Total</th> <th>Last Visit</th> </tr> </thead>';
  
        $.ajax({
            type: "POST",
            url: "process.php",
            dataType: 'JSON',
            data: formData,
        }).done(function (data) {
            console.log(data);
            // $("#test").html("data");
            
            for(var i=0; i<data.length; i++){
                var id = data[i].id;
                var paraula = data[i].paraula;
                var total = data[i].total;
                var lastvisit = data[i].lastvisit;

                relleno+= '<tr>';
        
                relleno+= `<td>${id}</td>`;
                relleno+= `<td>${paraula}</td>`;
                relleno+= `<td>${total}</td>`;
                relleno+= `<td>${lastvisit}</td>`;
                
                relleno+= '</tr>';
            }

            relleno+= '</table>'; 

            $("#test").html(relleno);

            // if (!data.success) {
            //     if (data.errors.buscador) {
            //         $("#buscador").addClass("bordeRojo");

            //         $("#buscador-group").append(
            //             '<div class="letraRoja">' + data.errors.buscador + "</div>"
            //         );
            //     }
            // } else {
            //     $("form").html(
            //         '<div class="alert alert-success">' + data.message + "</div>"
            //     );
            // }

        })
        .fail(function (data) {
            // $("form").html(
            //   '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            // );
            console.log(data);
        });
        
        event.preventDefault();
        // $("#buscador").removeClass("bordeRojo");
        // $(".letraRoja").remove();
    });
    */
});

// setInterval(function(){
//     $("#buscador").keyup(function(){

//     })
// })

function insertarDatos(event){
    var formData = {
        buscador: $("#buscador").val(),
    };

    relleno = "";
    relleno+= '<table class="table table-bordered table-hover">'; 
    relleno+= '<thead class="thead-dark"> <tr> <th>ID</th> <th>Paraula</th> <th>Total</th> <th>Last Visit</th> </tr> </thead>';

    $.ajax({
        type: "POST",
        url: "processInsert.php",
        dataType: 'JSON',
        data: formData,
    }).done(function (data) {
        console.log(data);
        // $("#test").html("data");
        
        for(var i=0; i<data.length; i++){
            var id = data[i].id;
            var paraula = data[i].paraula;
            var total = data[i].total;
            var lastvisit = data[i].lastvisit;

            relleno+= '<tr>';
    
            relleno+= `<td>${id}</td>`;
            relleno+= `<td>${paraula}</td>`;
            relleno+= `<td>${total}</td>`;
            relleno+= `<td>${lastvisit}</td>`;
            
            relleno+= '</tr>';
        }

        relleno+= '</table>'; 

        $("#test").html(relleno);
    })
    .fail(function (data) {
        console.log(data);
        $("#test").html("");
    });
    
    event.preventDefault();
}


function actualizarDatos(){

    $("#buscador").keyup(function(){
        llamarDB();
    })
}

function llamarDB(){

        var formData = {
            buscador: $("#buscador").val(),
        };

        relleno = "";
        relleno+= '<table class="table table-bordered table-hover">'; 
        relleno+= '<thead class="thead-dark"> <tr> <th>ID</th> <th>Paraula</th> <th>Total</th> <th>Last Visit</th> </tr> </thead>';
  
        $.ajax({
            type: "POST",
            url: "process.php",
            dataType: 'JSON',
            data: formData,
        }).done(function (data) {
            console.log(data);
            // $("#test").html("data");
            
            for(var i=0; i<data.length; i++){
                var id = data[i].id;
                var paraula = data[i].paraula;
                var total = data[i].total;
                var lastvisit = data[i].lastvisit;

                relleno+= '<tr>';
        
                relleno+= `<td>${id}</td>`;
                relleno+= `<td>${paraula}</td>`;
                relleno+= `<td>${total}</td>`;
                relleno+= `<td>${lastvisit}</td>`;
                
                relleno+= '</tr>';
            }

            relleno+= '</table>'; 

            $("#test").html(relleno);
        })
        .fail(function (data) {
            console.log(data);
            $("#test").html("");
        });
        
        // event.preventDefault();
}