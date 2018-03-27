<?
CJSCore::Init(array("jquery"));
$str = "window.location.href = '/calculator/index.php'";
?>
<script>
    $(function () {
        $(".crm-items-table-top-bar > span:first-child").append('' +
            '<span id="new_lead_product_editor_add_product_button" class="webform-small-button">' +
            '<span class="webform-small-button-left"></span>' +
            '<a class="webform-small-button-text" href="/calculator/index.php" >Перейти к формированию товара в калькуляторе</a>' +
            '<span class="webform-small-button-right"></span></span>');
    });

</script>