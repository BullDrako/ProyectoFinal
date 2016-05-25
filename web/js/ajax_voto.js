$(document).ready(function()
{
    /*$("body").click(function () {
        alert("hola");
    });*/
    
    $(".contenedor-publicacion .rounded-box").mouseover(function (){

        $(this).css("box-shadow","inset -2px -3px 8px #A29F7B, 2px 4px 8px red")

    });

    $(".contenedor-publicacion .rounded-box").mouseleave(function (){

        $(this).css("box-shadow","none")

    });

    $(".redondeado").mouseover(function (){
        $(this).css("box-shadow","0px 1px 5px 5px rgba(255,255,0,0.75)");
        $(this).css("border-radius","5px");
        $(this).css("background-color","rgba(255,255,0,0.75)");

        $(this).css("color", "black")

    });
    $(".redondeado").mouseleave(function (){
        $(this).css("box-shadow","none");
        $(this).css("border-radius","none");
        $(this).css("background-color","transparent");
        $(this).css("color", "#FF0000")
    });



    $(".votos .votar").click(function (e)
    {
        e.preventDefault();
        var voto_hecho = $(this).data('voto');
        var id = $(this).data("id");
        var li = $(this);

        if(voto_hecho && id)
        {


           /* $.ajax({
                async:true,
                type: "POST",
                dataType: "jsonp",
                contentType: "application/x-www-form-urlencoded",
                url:"votar.php",
                data:{'id':id, 'voto':voto_hecho},
                success: function procesar(datos){
                    if (data!="voto_duplicado")
                    {
                        li.addClass(voto_hecho+"_votado").find("span").text(data);
                        li.closest("ul").append("<span class='votado'>Gracias!</span>");
                    }
                    else li.closest("ul").append("<span class='votado'>Ya has votado!</span>");
                },
                beforeSent:function() {$('.votado').fadeOut('fast');}, timeout: 3000
            });*/



            $.post('/votos', {'id':id, 'voto':voto_hecho}, function(data)
            {
                if (data!="voto_duplicado")
                {
                    li.addClass(voto_hecho).find("span").text(data);
                    li.closest("ul").append("<span class='votado'>Gracias!</span>");
                }
                else li.closest("ul").append("<span class='votado'>Ya has votado!</span>");
            });
            setTimeout(function() {$('.votado').fadeOut('fast');}, 3000);


        }
    });



});
