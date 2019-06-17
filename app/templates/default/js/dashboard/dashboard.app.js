var _app = {
    el:"#app",

    data : {
        rencontres : [],
    },

    mounted : function(){
        this.getInfos();
    },

    methods : {
        getInfos : function () {
            var self = this;
            var form = {
                action : "get-all-rencontre",
            };

            $.post(ajaxUrl , form , function (data) {

                if(data.status != 200){
                    alert(window.error);
                }

                self.rencontres = data.rencontres;

            },"json");
        },
    },
}

$(document).ready(function () {
    var app = new Vue(_app);
});