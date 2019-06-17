function goToUrl(url) {
	window.location.href=url;
}

function isEmpty(property) {
	return (property === null || property === "" || typeof property === "undefined");
}

function reload() {
	location.reload();
}

function empty(val) {
	return val == null || val == undefined || val == "" || val == 0 || val == false || val.length == 0;
}

function clone(obj) {
	return JSON.parse(JSON.stringify(obj));
}

var DateHelper = {

	displayDateFr: function(dt)
	{
		if (dt == null || dt == "0000-00-00") {
			return ': non-renseignée';
		}

		date = new Date(dt);

		var jour = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		if(month < 10) {
			var month = "0" + month;
		}

		return jour + "/" + month + "/" + year;
	},

	displayDateEn: function(dt)
	{
		if (dt == null || dt == "0000-00-00") {
			return ': non-renseignée';
		}

		date = new Date(dt);

		var jour = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		if(month < 10) {
			var month = "0" + month;
		}

		return year + "-" + month + "-" + jour;
	},

	displayCurrentDateSql: function()
	{
		date = new Date();

		var jour = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		if(month < 10) {
			var month = "0" + month;
		}
		if (jour < 10) {
			var jour = "0" + jour;
		}
		
		return year + "-" + month + "-" + jour;
	},

	convertDateFrInSql: function(dt)
	{
		if (dt == null || dt.length < 10) {
			return "0000-00-00";
		}

		// Exemple 1/10/2018
		let dates = dt.split("/");
		let d = parseInt(dates[0]);
		let m = parseInt(dates[1]);
		let y = parseInt(dates[2]);

		return y+"-"+m+"-"+d;
	}

}
