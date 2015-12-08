$(init);

function init()
{
    $("#foodtypemenu").selectmenu();
    $("#foodtypemenu").on("selectmenuchange", showFoods);
    $.get("types.php", null, loadMenu);
}

function loadMenu(data, status)
{
    $("#foodtypemenu").html(data);
}

function showFoods(event, ui)
{
    foodTypeID = $("#foodtypemenu").val();
    $.post("foods.php", {"id": foodTypeID}, loadTable);
}

function loadTable(data, status)
{
    $("#output").html(data);
}
