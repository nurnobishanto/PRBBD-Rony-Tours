// For Add or Remove Flight Multi City Option Start
$(document).ready(function () {
    $("#addMulticityRow").on('click', (function () {
        let a = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);

        if (document.querySelectorAll('.multi_city_form').length === 5) {
            alert("Max Citry Limit Reached!!")
            return;
        }
        $(".multi_city_form_wrapper").append(`

        <div class="multi_city_form">
        <div class="row">
            <div class="col-lg-12">
                <div class="multi_form_remove">
                    <button type="button"
                        id="remove_multi_city">Remove</button>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="flight_Search_boxed">
                    <p>From</p>
                    <input type="text" value="New York">
                    <span>DAC, Hazrat Shahajalal
                        International...</span>
                    <div class="plan_icon_posation">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="flight_Search_boxed">
                    <p>To</p>
                    <input type="text" value="London ">
                    <span>CXB, London  Airport</span>
                    <div class="plan_icon_posation">
                        <i class="fas fa-plane-arrival"></i>
                    </div>
                    <div class="range_plan">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
        `);

    }))
    // Remove Button Click
    $(document).on('click', (function (e) {
        if (e.target.id === "remove_multi_city") {
            $(e.target).parent().closest('.multi_city_form').remove()
        }
    })

    )

});
