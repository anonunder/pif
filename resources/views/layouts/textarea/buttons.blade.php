
<script>
var productFormula = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Formula',
        tooltip: 'Kod formule',
        container: false,
        click: function () {
            context.invoke('editor.insertText', '{product_formula}');
        }
    });
    return button.render();
}  
var productCategory = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Kategorija',
        tooltip: 'Kategorija proizvoda',
        container: false,
        click: function () {
            context.invoke('editor.insertText', '{product_category}');
        }
    });
    return button.render();
}
var productName = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Naziv',
        tooltip: 'Naziv proizvoda',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{product_name}');
        }
    });
    return button.render();
}
var productVersion = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Verzija',
        tooltip: 'Verzija proizvoda',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{product_version}');
        }
    });
    return button.render();
}

var formula = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Formula',
        tooltip: 'Formula',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{formula}');
        }
    });
    return button.render();
}

var koncentracija = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Koncentracija',
        tooltip: 'koncentracija',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{koncentracija}');
        }
    });
    return button.render();
}
var noael = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Noael',
        tooltip: 'Noael',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{product_version}');
        }
    });
    return button.render();
}
var sed = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'SED',
        tooltip: 'SED',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{sed}');
        }
    });
    return button.render();
}
var mos = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'MoS',
        tooltip: 'MoS',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{mos}');
        }
    });
    return button.render();
}
var mos_text = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'MoS',
        tooltip: 'MoS Text',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{mos_text}');
        }
    });
    return button.render();
}
var dermalna_apsorpcija = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'DA',
        tooltip: 'DA',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{da}');
        }
    });
    return button.render();
}
var dermalna_apsorpcija_procenti = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'Daa',
        tooltip: 'DAa',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{daa}');
        }
    });
    return button.render();
}
var a = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'a',
        tooltip: 'a',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{a}');
        }
    });
    return button.render();
}
var ssa = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'ssa',
        tooltip: 'ssa',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{ssa}');
        }
    });
    return button.render();
}
var fappl = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: 'fappl',
        tooltip: 'fappl',
        container: false,
        click: function () {
        context.invoke('editor.insertText', '{fappl}');
        }
    });
    return button.render();
}
</script>