const DIR_API1="http://localhost/Proyectos/Curso24_25/Teor_SW/API";
const DIR_API2="http://localhost/Proyectos/Curso24-25/PHP/Servicios_Web/Actividad1/servicios_rest";

$(function(){
    obtener_productos();
});



function obtener_productos()
{
    $.ajax({
        url:DIR_API2+"/productos",
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#tabla").html(data.error);
        }
        else
        {
            let html_tabla_productos="<table>";
            html_tabla_productos+="<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th><th>Agregar +</th></tr>";
            $.each(data.productos,function(key,tupla){
                html_tabla_productos+="<tr>";
                html_tabla_productos += "<td><button onclick='obtener_detalles(\"" + tupla['cod'] + "\")'>" + tupla['cod'] + "</button></td>";
                html_tabla_productos+="<td>"+tupla["nombre_corto"]+"</td>";
                html_tabla_productos+="<td>"+tupla["PVP"]+"</td>";
                html_tabla_productos+="<td><form action='index.php' method='post'><button type='submit' >Borrar</button> - <button type='submit' >Editar</button> </form></td>";
                html_tabla_productos+="</tr>";
            });
            html_tabla_productos+="</table>";
            $("#tabla").html(html_tabla_productos);
        }
    })
    .fail(function(a,b){
        $("#tabla").html(error_ajax_jquery(a,b)); 
    });
}

function obtener_detalles(cod)
{
    $.ajax({
        url:DIR_API2+"/producto/"+cod,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#respuesta").html(data.error);
        }
        else
        {
            let html_tabla_productos="<div>";
            html_tabla_productos+="<p> Nombre: "+data.producto["nombre"]+"</p>";
            html_tabla_productos+="<p> Nombre_corto: "+data.producto["nombre_corto"]+"</p>";
            html_tabla_productos+="<p> Descripcion: "+data.producto["descripcion"]+"</p>";
            html_tabla_productos+="<p> Precio: "+data.producto["PVP"]+"</p>";
            html_tabla_productos+="<button onClick='limpiar()' >Volver</button>";
            
            html_tabla_productos+="</div>";
            $("#respuesta").html(html_tabla_productos);
        }
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });
}

function limpiar()
{
    $("#respuesta").html(""); 
}




