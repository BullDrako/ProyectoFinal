$(document).ready(function()
{
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

    $(".autor").mouseover(function (){
        $(this).css("box-shadow","0px 1px 5px 5px rgba(0,0,0,0.75)");
        $(this).css("border-radius","5px");
        $(this).css("background-color","rgba(0,0,0,0.75)");

        $(this).css("color", "white")

    });

    $(".autor").mouseleave(function (){
        $(this).css("box-shadow","none");
        $(this).css("border-radius","none");
        $(this).css("background-color","transparent");
        $(this).css("color", "#FF0000")
       
    });
    
});
