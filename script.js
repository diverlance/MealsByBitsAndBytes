const CANVAS_W = 800;
const CANVAS_H = 400;
const IMAGE_W  = 292;
const IMAGE_H  = 122;
const RIGHT    = CANVAS_W - IMAGE_W;
const BOTTOM   = CANVAS_H - IMAGE_H;
var con;
var image;
var x  = 0;
var y  = 0;
var dx = 10;
var dy = 7;

function validate()
{
    var  first_name = document.getElementById("first_name").value;
    var  last_name = document.getElementById("last_name").value;
    var  email = document.getElementById("email").value;

    var error = "";
    var text = /^[0-9-]/;
    if(first_name =="")
    {
        error += "Missing first name.\n";
    }
    else if (text.test(first_name))
    {
        error += "First name can only contain alphanumeric characters and hypehns(-)\n";
    }

    if(last_name =="") {
        error += "Missing last name.\n";
    }
    else if (text.test(first_name))
    {
        error += "Last name can only contain alphanumeric characters and hypehns(-)\n";
    }

    var emailRegex = /^.+@.+\..{2,4}$/
    if(!email.match(emailRegex)) {
        error += "Invalid Email address.\n";
    }

    if(error !=""){
        alert(error);
    }
}

function init()
{
    con = document.getElementById("canvas").getContext("2d");
    con.strokeStyle = "black";
    con.fillStyle = "white";
    image = new Image();
    image.src = "http://www.classic-computers.org.nz/bits-and-bytes/logo.jpg";
    setInterval(draw, 50);

    $("#accordion").accordion();
    $("#datepicker").datepicker();
    $(".drag").draggable();
    $(".target").droppable();


}

function draw()
{
    con.fillRect(0, 0, CANVAS_W, CANVAS_H);
    con.strokeRect(0, 0, CANVAS_W, CANVAS_H);
    con.drawImage(image, x, y, IMAGE_W, IMAGE_H);
    x += dx;
    y += dy;
    if ((x < 0) || (x > RIGHT))  dx = -dx;
    if ((y < 0) || (y > BOTTOM)) dy = -dy;
}


