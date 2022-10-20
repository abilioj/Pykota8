
var text = "";
const url = "http://localhost/WSMenu/";
//const url = "http://localhost:8080/whosp2.0/webresource/menu";
//const url = "http://localhost:8080/whosp2.0/webresource/entity.tgmenu";

function isEmpty(obj) {
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop))
            return false;
    }
    return true;
}

var initMenu = function () {
    text = "";
    text = "<li class='treeview'>";
    text += "<a href='#'>";
    text += "<i class='fa fa-share'></i>";
    text += "<span>Inicio</span>";
    text += "</a>";
    text += "</li>";
};

var getMenu = function (data) {
    $.each(data, function (key, value) {
//        console.log(value);
        text += " <li class='treeview'>";

        text += "<a href='#'>";//"+value.rotas.href+"
        text += "<i class='" + value.class + "'></i>";
        text += "<span>" + value.title + "</span>";
        text += "<i class='fa fa-angle-left pull-right'></i>";
        text += "</a>";

        if (!isEmpty(value.child)) {
            console.log(value.child);
            text += "<ul class='treeview-menu'>";
            $.each(value.child, function (key, value) {
                if (isEmpty(value.child)) {
                    text += "<li>"
                    text += "<a href='#'>";//"+value.rotas.href+"
                    text += "<i class='" + value.class + "'></i>";
                    text += "<span>" + value.title + "</span>";
                    text += "<i class='fa fa-angle-left pull-right'></i>";
                    text += "</a>";
                    text += "</li>";
                } else {
                    text += "<li class='treeview'>"
                    text += "<a href='#'>";//"+value.rotas.href+"
                    text += "<i class='" + value.class + "'></i>";
                    text += "<span>" + value.title + "</span>";
                    text += "<i class='fa fa-angle-left pull-right'></i>";
                    text += "</a>";
                    text += "<ul class='treeview-menu'>";
                    $.each(value.child, function (key, value) {
                        text += "<li>"
                        text += "<a href='#'>";//"+value.rotas.href+"
                        text += "<i class='" + value.class + "'></i>";
                        text += "<span>" + value.title + "</span>";
                        text += "<i class='fa fa-angle-left pull-right'></i>";
                        text += "</a>";
                        text += "</li>";
                    });
                    text += "</ul>";
                    text += "</li>";
                }
            });
            text += "</ul>"
        }
        text += "</li>";
//        getSubmenu(value.child);
    });
    return text;
};

var getSubmenu = function (value) {
//    $.each(data, function (key, value) {
        text += " <li class='treeview'>";
        text += "<a href='#'>";//"+value.rotas.href+";
        text += "<i class='" + value.class + "'></i>";
        text += "<span>" + value.title + "</span>";
        text += "<i class='fa fa-angle-left pull-right'></i>";
        text += "</a>";
        text += "<ul class='treeview-menu'>";
        $.each(value.child, function (key, value) {
                text += "<li class='treeview'>"
                text += "<a href='#'>";//"+value.rotas.href+";
                text += "<i class='" + value.class + "'></i>";
                text += "<span>" + value.title + "</span>";
                text += "<i class='fa fa-angle-left pull-right'></i>";
                text += "</a>";
                text += "<ul class='treeview-menu'>";
                $.each(value.child, function (key, value) {
                    text += "<li>"
                    text += "<a href='#'>";//"+value.rotas.href+";
                    text += "<i class='" + value.class + "'></i>";
                    text += "<span>" + value.title + "</span>";
                    text += "<i class='fa fa-angle-left pull-right'></i>";
                    text += "</a>";
                    text += "</li>";
                });
                text += "</ul>";
                text += "</li>";
            });
        text += "</li>";
//    });
    return text;
};


var getMenuTest = function (data) {
    $.each(data, function (key, value) {
        console.log(value);
        text += " <li class='treeview'>";
        text += "<a href='#'>";
        text += "<i class='fa fa-dashboard'></i>";
        text += "<span>" + value.descricao + "</span>";
        text += "<i class='fa fa-angle-left pull-right'></i>";
        text += "</a>";
//                getSubmenu(value)+
        "</li>";
    });
};

$(document).ready(function () {

//    initMenu();

    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            $(".msg").html('');
        },
        error: function () {
            $('.msg').html('');
        },
        success: function (data) {
//            getMenuTest(data);
            getMenu(data);
            console.log(Object.values(data).length);
            for (var x = 0; x < data.left; x++) {}
            $('#menutext').html(text);
        }
    });
});