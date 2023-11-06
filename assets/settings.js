jQuery(document).ready(function ($) {
    const buttonContainer = $('#lbb-button');
    const button = $('#lbb-button a');
    const text = $('#lbb-text p');
    const exampleArea = $('#lease-boat-example-area');

    $('.lease-boot-general-example-bg').wpColorPicker({
        change: function (event, ui) {
            let color = ui.color.toString();
            exampleArea.css('background-color', color);
        }
    });
    $('.lease-boot-style-bg-color').wpColorPicker({
        change: function (event, ui) {
            let color = ui.color.toString();
            button.css('background-color', color);
        },
    });
    $('.lease-boot-style-text-color').wpColorPicker({
        change: function (event, ui) {
            let color = ui.color.toString();
            button.css('color', color);
        },
    });
    $('.lease-boot-style-border-color').wpColorPicker({
        change: function (event, ui) {
            let color = ui.color.toString();
            button.css('border-color', color);
        },
    });

    $('.lease-boot-text-style-color').wpColorPicker({
        change: function (event, ui) {
            let color = ui.color.toString();
            text.css('color', color);
        }
    });

    $("input[name='lease-boot-style-classes']").on('keyup', function () {
        button.removeClass();
        button.addClass(this.value);
    });

    $("select[name='lease-boot-style-alignment']").on('change', function () {
        buttonContainer.css('justify-content', this.value);
    });

    $("input[name='lease-boot-style-font-size']").on('keyup', function () {
        button.css('font-size', this.value);
    });

    $("input[name='lease-boot-style-font-weight']").on('keyup', function () {
        button.css('font-weight', this.value);
    });

    $("input[name='lease-boot-style-border-thickness']").on('keyup', function () {
        button.css('border-width', this.value);
    });

    $("input[name='lease-boot-style-border-radius']").on('keyup', function () {
        button.css('border-radius', this.value);
    });

    $("input[name='lease-boot-style-padding-x']").on('keyup', function () {
        button.css('padding-left', this.value);
        button.css('padding-right', this.value);
    });

    $("input[name='lease-boot-style-padding-y']").on('keyup', function () {
        button.css('padding-top', this.value);
        button.css('padding-bottom', this.value);
    });

    $("input[name='lease-boot-text-deactivate']").on('click', function () {
        if (this.checked) {
            text.hide();
        } else {
            text.show();
        }
    });

    $("input[name='lease-boot-text-style-classes']").on('keyup', function () {
        text.removeClass();
        text.addClass(this.value);
    });

    $("select[name='lease-boot-text-style-alignment']").on('change', function () {
        text.css('text-align', this.value);
    });

    $("input[name='lease-boot-text-style-font-size']").on('keyup', function () {
        text.css('font-size', this.value);
    });

    $("input[name='lease-boot-text-style-font-weight']").on('keyup', function () {
        text.css('font-weight', this.value);
    });

    $("input[name='lease-boot-text-style-padding-x']").on('keyup', function () {
        text.css('padding-left', this.value);
        text.css('padding-right', this.value);
    });

    $("input[name='lease-boot-text-style-padding-y']").on('keyup', function () {
        text.css('padding-top', this.value);
        text.css('padding-bottom', this.value);
    });
});
