// For Add or Remove Flight Multi City Option Start
$(document).ready(function () {
    $("#addMulticityRow").on('click', (function () {
        let a = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
        let l = document.querySelectorAll('.multi_city_form').length;
        let fromID = 'id = "multi_city_from'+l+'"';
        let toID = 'id = "multi_city_to'+l+'"';
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
            <div class="col-lg-4">
                <div class="flight_Search_boxed">
                    <p>From</p>
                    <select class="from_airport" `+fromID+` style="width: 100%" name="multi_city_from"></select>
                    <span>DAC, Hazrat Shahajalal
                        International...</span>
                    <div class="plan_icon_posation">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="flight_Search_boxed">
                    <p>To</p>
                    <select class="to_airport" `+fromID+` style="width: 100%" name="multi_city_to"></select>
                    <span>CXB, London  Airport</span>
                    <div class="plan_icon_posation">
                        <i class="fas fa-plane-arrival"></i>
                    </div>
                    <div class="range_plan">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form_search_date">
                    <div
                        class="flight_Search_boxed date_flex_area">
                        <div class="Journey_date">
                            <p>Journey date</p>
                            <input type="text" class="date" value="2022-05-18">
                            <span>Thursday</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        `);

        loadContries('.from_airport','');
        loadContries('.to_airport','');
    }))
    // Remove Button Click
    $(document).on('click', (function (e) {
        if (e.target.id === "remove_multi_city") {
            $(e.target).parent().closest('.multi_city_form').remove()
        }
    })

    )

});




