"use strict";

$(".page-dashboard").each(function() {
    
    var $page = $(this);

    $page.find(".btn-delete").click(function() {

        var id = $(this).data("id");
        var url = $(this).data("url");

        if (id && url) {

            bootbox.dialog({
				title: "Atenção!",
				message: "Tem certeza que deseja remover este produto?",
				buttons: {
					cancel: { label: "Cancelar", className: "btn-light" },
				    confirm: { label: "Ok", className: "btn-danger", callback: function() {

                        var form = `
                        <form method="post" action="${url}">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" value="${window.Laravel.csrf}" />
                            <input type="hidden" name="id" value="${id}" />
                        </form>`;

                        var $f = $(form);
                        $("body").append($f);
                        $f.submit();

                    }}
				}
			});
        }

    });

    $page.find(".card-header form .form-control").change(function() {
        console.log("abc");
        $(this).closest("form").submit();
    });

});