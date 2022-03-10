const baseUrl = 'https://api.covid19api.com'
var covid = {}
covid.information = {
    global: {
        total: 0,
        death: 0,
        recovered: 0,
    },
    vn: {
        total: 0,
        death: 0,
        recovered: 0,
    }
}

covid.init = function () {
    covid.getTotalCovid()
}

covid.getTotalCovid = function () {
    $.ajax({
        type: "GET",
        url: `${baseUrl}/summary`,
        dataType: 'json',
        success: function (result) {
            if (result.Date) {
                if (result.Countries.length > 0) {
                   for (let country of result.Countries) {
                       if (country.CountryCode === 'VN'){
                           console.log('212', country);
                           covid.information.vn.total = country.TotalConfirmed;
                           covid.information.vn.recovered = country.TotalRecovered;
                           covid.information.vn.death = country.TotalDeaths;
                       }
                   }
                } 
                if (result.Global) {
                    covid.information.global.total = result.Global.TotalConfirmed;
                    covid.information.global.recovered = result.Global.TotalRecovered;
                    covid.information.global.death = result.Global.TotalDeaths;
                }
            }
            $('#covid_vn_total').val(covid.information.vn.total.toLocaleString("en-GB"));
            $('#covid_vn_death').val(covid.information.vn.death.toLocaleString("en-GB"));
            $('#covid_vn_recovered').val(covid.information.vn.recovered.toLocaleString("en-GB"));
            $('#covid_global_total').val(covid.information.global.total.toLocaleString("en-GB"));
            $('#covid_global_death').val(covid.information.global.death.toLocaleString("en-GB"));
            $('#covid_global_recovered').val(covid.information.global.recovered.toLocaleString("en-GB"));
        }
    }).fail(function(error) {
        

    });
}

$(document).ready(function () {
    covid.init();
})
