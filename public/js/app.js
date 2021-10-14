$(document).ready(function () {
    $('#createOrder').submit(function (e) {
        e.preventDefault();
        const getUrl = Routing.generate('orders_new');

        $.ajax({
            type: $(this).attr('method'),
            url: getUrl,
            data: $(this).serialize(),
            success: function (response) {
                console.log("Success!");
                $('#table-output').load(document.URL +  ' #table-output');
            },
            error: function (response) {
                console.log("Error: " + response);
            }
        });
    });
    $("#orderModal").on('show.bs.modal', function (event) {
        const elements = $(event.relatedTarget).find("td");
        let html = "";
        $(elements).each(function () {
            if(this.id.length){
                html = html + "<p><b>"+ this.id+"</b>: "+this.innerHTML + "</p>";
            }
        })
        $(event.target).find("#orderDetails").html(html);
    })
});